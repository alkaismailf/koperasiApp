<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnggotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anggota Koperasi';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
          if(Yii::$app->user->identity->roletype=='System Admin') {
        ?>
            <?= Html::a('Tambah Anggota', ['create'], ['class' => 'btn btn-success']) ?>
        <?php
          }
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_anggota',
            'nik',
            'nama',
            'jekel',
            'ttl',
            'email:email',
            'no_telp',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
