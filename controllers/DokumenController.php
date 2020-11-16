<?php

namespace app\controllers;

use Yii;
use app\models\Dokumen;
use app\models\DokumenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * DokumenController implements the CRUD actions for Dokumen model.
 */
class DokumenController extends Controller
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
                        'actions'=>['index', 'create', 'update', 'delete', 'view', 'download'],
                        'allow'=>true,
                        'matchCallback'=>function(){
                            return (
                                Yii::$app->user->identity->roletype=='System Admin'
                            );
                        }
                    ],
                    [
                        'actions'=>['index', 'view', 'download'],
                        'allow'=>true,
                        'matchCallback'=>function(){
                            return (
                                Yii::$app->user->identity->roletype=='Anggota'
                            );
                        }
                    ],
                    [
                        'actions'=>['index', 'view', 'download'],
                        'allow'=>true,
                        'matchCallback'=>function(){
                            return (
                                Yii::$app->user->identity->roletype=='Karyawan'
                            );
                        }
                    ],
                    [
                        'actions'=>['index', 'view', 'download'],
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
     * Lists all Dokumen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DokumenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dokumen model.
     * @param integer $id
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
     * Creates a new Dokumen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dokumen();

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_dokumen]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);*/

        if ($model->load(Yii::$app->request->post())) {
 
            $upload_file = $model->uploadFile();
 
            var_dump($model->validate());
            if ($model->validate()) {   
                if($model->save()) {
 
                    if ($upload_file !== false) {
                        $path = $model->getUploadedFile();
                        $upload_file->saveAs($path);
                    }
 
                    return $this->redirect(['index', 'id' => $model->id_dokumen]);
                }
 
            }
        }
 
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Dokumen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_dokumen]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Dokumen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dokumen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dokumen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dokumen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDownload($id)
    {
        $model = $this->findModel($id);

        header('Content-Type:'.pathinfo($model->file, PATHINFO_EXTENSION));
        header('Content-Disposition: attachment; filename='.$model->nama_file);

        return readFile('uploads/'.$model->file);
    }
}
