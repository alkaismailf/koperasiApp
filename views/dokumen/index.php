<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DokumenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dokumen';
$this->params['breadcrumbs'][] = ['label' => 'Tentang Kami'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dokumen-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
          if(Yii::$app->user->identity->roletype=='System Admin') {
        ?>
            <?= Html::a('Upload Dokumen', ['create'], ['class' => 'btn btn-success']) ?>
        <?php
          }
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_dokumen',
            'nama_file',
            //'file',
            'keterangan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
