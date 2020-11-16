<?php

namespace app\controllers;

use Yii;
use app\models\Simpan;
use app\models\SimpanSearch;
use app\models\Ambil;
use app\models\AmbilSearch;
use app\models\Anggota;
use app\models\Karyawan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use Mpdf\Mpdf;
use kartik\mpdf\Pdf;
use yii\data\ActiveDataProvider;

/**
 * SimpanController implements the CRUD actions for Simpan model.
 */
class SimpanController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
             'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'actions'=>['index', 'create', 'view', 'exportpdfsimpan', 'exportpdfsimpan2'],
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
     * Lists all Simpan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SimpanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchModel2 = new AmbilSearch();
        $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams);

        //$anggota = new Anggota();
        $anggota = Anggota::find()->all();
        $anggota = ArrayHelper::map($anggota,'id_anggota','nama');

        //$karyawan = new Karyawan();
        $karyawan = Karyawan::find()->all();
        $karyawan = ArrayHelper::map($karyawan,'id_karyawan','nama');

        /*$session = Yii::$app->session;
        // check if a session is already open
        if (!$session->isActive){
            $session->open();// open a session
        } 
        // save query here
        $session['tgl_simpan'] = Yii::$app->request->queryParams;*/

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'anggota' => $anggota,
            'karyawan' => $karyawan,
            'searchModel2' => $searchModel2,
            'dataProvider2' => $dataProvider2,
        ]);
    }

    /**
     * Displays a single Simpan model.
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
     * Creates a new Simpan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Simpan();

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->no_simpan]);
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
     * Updates an existing Simpan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->no_simpan]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Simpan model.
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
     * Finds the Simpan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Simpan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Simpan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionExportpdfsimpan() 
    {
        //$tgl = $this->tgl_simpan;

        $this->layout='main1';
        $model = Simpan::find()->All();

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($this->renderPartial('template_simpan',['model' => $model]));
        $mpdf->Output('Data Simpan Koperasi.pdf', 'D');
        exit;
    }

    public function actionExportpdfsimpan2()
    {
        // trying to get the sales_id post value
        $request = Yii::$app->request;
        $tgl = $request->post('tgl_simpan');
        $model = new Simpan();

        // Your SQL query filter here
        $dataProvider = new ActiveDataProvider([
            'query' => Simpan::find()
                ->where(['tgl_simpan' => $tgl])
                ->orderBy(['no_simpan' => SORT_ASC])
        ]);

        $content = $this->renderPartial('index', ['model', 'dataProvider' => $dataProvider]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Cetak Laporan Piutang Menurut Customer'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>['Laporan Piutang - NAMA TOKO / PERUSAHAAN / CV'],
                'SetFooter'=>['Powered by PFSOFT | {PAGENO}'],
            ]
        ]);

        /*------------------------------------*/
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/pdf');
        /*------------------------------------*/

        // return the pdf output as per the destination setting
        return $pdf->render();
    }
}
