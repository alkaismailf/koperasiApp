<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KaryawanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Karyawan';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="karyawan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
          if(Yii::$app->user->identity->roletype=='System Admin') {
        ?>
            <?= Html::a('Tambah Karyawan', ['create'], ['class' => 'btn btn-success']) ?>
        <?php
          }
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_karyawan',
            'nama',
            'jekel',
            'ttl',
            'email:email',
            'no_telp',
            //'tgl_masuk_kerja',
            [
                'attribute' => 'tgl_masuk_kerja',
                'value'     => 'tgl_masuk_kerja',
                'filter'    => array("ID1" => "Januari",
                                     "ID2" => "Februari",
                                     "ID3"  => "Maret",
                                     "ID4"  => "April",
                                     "ID5"  => "Mei",
                                     "ID6"  => "Juni",
                                     "ID7"  => "Juli",
                                     "ID8"  => "Agustus",
                                     "ID9"  => "September",
                                     "ID10"  => "Oktober",
                                     "ID11"  => "November",
                                     "ID12"  => "Desember",                                    
                                   ),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
