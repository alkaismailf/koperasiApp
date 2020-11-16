<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\PasswordForm;
use app\models\TbMasterData;
use app\models\Simpan;
use app\models\SimpanSearch;
use app\models\Pinjam;
use app\models\PinjamSearch;
use app\models\Ambil;
use app\models\AmbilSearch;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout','changepassword'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    /*[
                        'actions' => ['resetpassword'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],*/
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public $successUrl = ''; //bikin variabel successUrl
    
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
                'successUrl' => $this->successUrl
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('home');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    /*public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }*/

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    /**
     * Displays signup page.
     *
     * @return string
     */
    public function actionSignup()
    {
        $model = new TbMasterData();

        /*$session = Yii::$app->session;
        if (!empty($session['attributes'])){
            $model->username = $session['attributes']['first_name'];
            $model->email = $session['attributes']['email'];
        }*/

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                Yii::$app->getSession()->setFlash('success','Akun Berhasil Dibuat');
                return $this->goHome();
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Displays gantipassword page.
     *
     * @return string
     */
    public function actionChangepassword()
    {
        $model = new PasswordForm;
        $modeluser = TbMasterData::find()->where([
            'username'=>Yii::$app->user->identity->username
        ])->one();
      
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                try{
                    $modeluser->password = $_POST['PasswordForm']['newpass'];
                    if($modeluser->save()){
                        Yii::$app->getSession()->setFlash(
                            'success','Password changed'
                        );
                        return $this->redirect(['index']);
                    }else{
                        Yii::$app->getSession()->setFlash(
                            'error','Password not changed'
                        );
                        return $this->redirect(['index']);
                    }
                }catch(Exception $e){
                    Yii::$app->getSession()->setFlash(
                        'error',"{$e->getMessage()}"
                    );
                    return $this->render('changepassword',[
                        'model'=>$model
                    ]);
                }
            }else{
                return $this->render('changepassword',[
                    'model'=>$model
                ]);
            }
        }else{
            return $this->render('changepassword',[
                'model'=>$model
            ]);
        }
    }
 
    public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();
        // user login or signup comes here
        /*
        Kalo di die(print_r($attributes));
        maka akan keluar
        Array ( [id] => https://www.google.com/accounts/o8/id?id=AItOawkSN3ecyrQAUOVyy9kuX-2oq-hahagake [namePerson/first] => Hafid [namePerson/last] => Mukhlasin [pref/language] => en [contact/email] => milisstudio@gmail.com [first_name] => Hafid [last_name] => Mukhlasin [email] => milisstudio@gmail.com [language] => en ) 
     
        Nah data ini bisa kita gunakan untuk check apakah si user udah terdaftar ato belum..
        */
        $user_email = $attributes['emails'][0]['value'];
        $user = TbMasterData::find()->where(['emailuser'=>$user_email])->one();
        if(!empty($user)){
            Yii::$app->user->login($user);
        }
        else{
            //Simpen disession attribute user dari Google
            $session = Yii::$app->session;
            $session['attributes']=$attributes;
            // redirect ke form signup, dengan mengset nilai variabell global successUrl
            $this->successUrl = \yii\helpers\Url::to(['signup']);
        }   
    }

    public function getToken($token)
    {
        $model=TbMasterData::$model->findByAttributes(array('token'=>$token));
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
        

    public function actionVerToken($token)
    {
        $model=$this->getToken($token);
        if(isset($_POST['Ganti']))
        {
            if($model->token == $_POST['Ganti']['tokenhid']){
                $model->password = md5($_POST['Ganti']['password']);
                $model->token = "null";
                $model->save();
                Yii::app()->user->setFlash('ganti','<b>Password has been successfully changed! please login</b>');
                $this->redirect('?r=site/login');
                $this->refresh();
            }
        }
        $this->render('verifikasi',array(
            'model'=>$model,
        ));
    }

        
    /*public function actionForgot()
    {
        if(isset($_POST['Lupa']) && isset($_POST['Lupa']['email'])) {
            $getEmail = $_POST['Lupa']['emailuser'];
            $getModel = TbMasterData::$model->findByAttributes(array('emailuser'=>$getEmail));
            if(isset($_POST['Lupa']))
            {
                $getToken=rand(0, 99999);
                $getTime=date("H:i:s");
                $getModel->token=md5($getToken.$getTime);
                $namaPengirim="Owner Jsource Indonesia";
                $emailadmin="fahmi.j@programmer.net";
                $subjek="Reset Password";
                $setpesan="you have successfully reset your password<br/>
                    <a href='http://yourdomain.com/index.php?r=site/vertoken/view&token=".$getModel->token."'>Click Here to Reset Password</a>";
                if($getModel->validate())
                {
                    $name='=?UTF-8?B?'.base64_encode($namaPengirim).'?=';
                    $subject='=?UTF-8?B?'.base64_encode($subjek).'?=';
                    $headers="From: $name <{$emailadmin}>\r\n".
                        "Reply-To: {$emailadmin}\r\n".
                        "MIME-Version: 1.0\r\n".
                        "Content-type: text/html; charset=UTF-8";
                    $getModel->save();
                                    Yii::$app->user->setFlash('forgot','link to reset your password has been sent to your email');
                    mail($getEmail,$subject,$setpesan,$headers);
                    $this->refresh();
                }        
            }
        }
        $this->render('forgot');
    }*/
}