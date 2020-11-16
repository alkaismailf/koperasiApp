<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Simpan;
use app\models\SimpanSearch;
use app\models\Ambil;
use app\models\AmbilSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AmbilSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengambilan Uang';
$this->params['breadcrumbs'][] = ['label' => 'Transaksi'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ambil-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
          if(Yii::$app->user->identity->roletype=='System Admin') {
        ?>
            <?= Html::a('Buat Data Ambil Uang', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Export ke PDF', ['exportpdfambil'], ['class' => 'btn btn-default']) ?>
        <?php
          } 
          else if(Yii::$app->user->identity->roletype=='Karyawan') {
        ?>
            <?= Html::a('Buat Data Ambil Uang', ['create'], ['class' => 'btn btn-success']) ?>
        <?php
          }
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'no_ambil',
            //'id_anggota',
            [
               'class' => 'yii\grid\DataColumn',
               'header' => 'Nama Anggota',
               'value' => 'anggota.nama',
               'filter' => Html::activeDropDownList($searchModel, 'id_anggota', $anggota, ['class'=>'form-control', 'prompt'=>'--Pilih--'])
            ],
            //'jml_ambil',
            [
                'attribute' => 'jml_ambil',
                'contentOptions' => ['style' => 'text-align:right'],
                'format'=>['decimal',0]
            ],
            //'tgl_ambil',
            [
                'attribute' => 'tgl_ambil',
                'value'     => 'tgl_ambil',
                'contentOptions' => ['style' => 'text-align:center'],
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
            //'id_karyawan',
            [
               'class' => 'yii\grid\DataColumn',
               'header' => 'Nama Karyawan',
               'value' => 'karyawan.nama',
               'filter' => Html::activeDropDownList($searchModel, 'id_karyawan', $karyawan, ['class'=>'form-control', 'prompt'=>'--Pilih--'])
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <br>
    <?php
        if(Yii::$app->user->identity->roletype=='Anggota') {
            $akun = Yii::$app->user->identity->username;

            $simpan = Simpan::find()->where(['id_anggota' => $akun])->all();
            $totalSimpan = 0;
            foreach ($simpan as $item) {
                $totalSimpan += $item['jml_simpan'];
            }

            
            $totalAmbil = 0;
            foreach ($dataProvider->models as $item) {
                $totalAmbil += $item['jml_ambil'];
            }

            $totalSaldo = $totalSimpan-$totalAmbil;
    ?>
    <h3> Total Saldo (Rp.) :
        <?= Html::textInput('id_anggota', $totalSaldo, ['class' => 'form-control', 'readOnly' => true]); ?>
    </h3>
    <?php    
        }
    ?>

</div>
