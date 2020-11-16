<?php

namespace app\controllers;

use Yii;
use app\models\Ambil;
use app\models\AmbilSearch;
use app\models\Anggota;
use app\models\Karyawan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * AmbilController implements the CRUD actions for Ambil model.
 */
class AmbilController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'actions'=>['index', 'create', 'view', 'exportpdfambil'],
                        'allow'=>true,
                        'matchCallback'=>function(){
                            return (
                                Yii::$app->user->identity->roletype=='System Admin'
                            );
                        }
                    ],
                    [
                        'actions'=>['index', 'view'],
                        'allow'=>true,
                        'matchCallback'=>function(){
                            return (
                                Yii::$app->user->identity->roletype=='Anggota'
                            );
                        }
                    ],
                    [
                        'actions'=>['index', 'create', 'update', 'delete', 'view'],
                        'allow'=>true,
                        'matchCallback'=>function(){
                            return (
                                Yii::$app->user->identity->roletype=='Karyawan'
                            );
                        }
                    ],
                    [
                        'actions'=>['index', 'view'],
                        'allow'=>true,
                        'matchCallback'=>function(){
                            return (
                                Yii::$app->user->identity->roletype=='Manajemen dan Pengurus'
                            );
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Ambil models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AmbilSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //$anggota = new Anggota();
        $anggota = Anggota::find()->all();
        $anggota = ArrayHelper::map($anggota,'id_anggota','nama');

        //$karyawan = new Karyawan();
        $karyawan = Karyawan::find()->all();
        $karyawan = ArrayHelper::map($karyawan,'id_karyawan','nama');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'anggota' => $anggota,
            'karyawan' => $karyawan,
        ]);
    }

    /**
     * Displays a single Ambil model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Ambil model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ambil();

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->no_ambil]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);*/

        if ($model->load(Yii::$app->request->post())) {
            try{
                if($model->save()){
                    Yii::$app->getSession()->setFlash(
                        'success','Data saved!'
                    );
                    return $this->redirect(['index']);
                }
            }catch(Exception $e){
                Yii::$app->getSession()->setFlash(
                    'error',"{$e->getMessage()}"
                );
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Ambil model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->no_ambil]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Ambil model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ambil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Ambil the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ambil::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionExportpdfambil() 
    {
        $this->layout='main1';
        $model = Ambil::find()->All();

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($this->renderPartial('template_ambil',['model'=>$model]));
        $mpdf->Output('Data Ambil Koperasi.pdf', 'D');
        exit;
    }
}