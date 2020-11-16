<?php

namespace app\controllers;

use Yii;
use app\models\Pinjam;
use app\models\PinjamSearch;
use app\models\Anggota;
use app\models\Karyawan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * PinjamController implements the CRUD actions for Pinjam model.
 */
class PinjamController extends Controller
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
                        'actions'=>['index', 'create', 'view', 'exportpdfpinjam'],
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
     * Lists all Pinjam models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PinjamSearch();
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
     * Displays a single Pinjam model.
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
     * Creates a new Pinjam model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pinjam();

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->no_pinjam]);
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
     * Updates an existing Pinjam model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->no_pinjam]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pinjam model.
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
     * Finds the Pinjam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Pinjam the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pinjam::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionExportpdfpinjam() 
    {
        $this->layout='main1';
        $model = Pinjam::find()->All();

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($this->renderPartial('template_pinjam',['model'=>$model]));
        $mpdf->Output('Data Pinjam Koperasi.pdf', 'D');
        exit;
    }
}
