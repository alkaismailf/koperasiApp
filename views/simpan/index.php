<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Simpan;
use app\models\SimpanSearch;
use app\models\Ambil;
use app\models\AmbilSearch;
use dosamigos\datepicker\DatePicker;
use kartik\mpdf\Pdf;
//use jino5577\daterangepicker\DateRangePicker;
//use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SimpanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penyimpanan Uang';
$this->params['breadcrumbs'][] = ['label' => 'Transaksi'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simpan-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?php
        if(Yii::$app->user->identity->roletype=='Anggota') {
            $akun = Yii::$app->user->identity->username;
            
            $totalSimpan = 0;
            foreach ($dataProvider->models as $item) {
                $totalSimpan += $item['jml_simpan'];
            }

            $ambil = Ambil::find()->where(['id_anggota' => $akun])->all();
            $totalAmbil = 0;
            foreach ($ambil as $item) {
                $totalAmbil += $item['jml_ambil'];
            }

            $totalSaldo = $totalSimpan-$totalAmbil;
    ?>      
            <h1>Data Penyimpanan Uang</h1>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'showFooter' => true,
                'footerRowOptions'=>['style'=>'font-weight:bold;text-align:right;'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'no_simpan',
                    //'id_anggota',
                    [
                       'class' => 'yii\grid\DataColumn',
                       'header' => 'Nama Anggota',
                       'value' => 'anggota.nama',
                       'filter' => Html::activeDropDownList($searchModel, 'id_anggota', $anggota, ['class'=>'form-control', 'prompt'=>'--Pilih--'])
                    ],
                    //'jml_simpan',
                    [
                        'attribute' => 'jml_simpan',
                        'contentOptions' => ['style' => 'text-align:right'],
                        'format'=>['decimal',0],
                        'footer' => 'Total : '.number_format(Simpan::getTotal($dataProvider->models, 'jml_simpan'), 0, ".", ",")
                    ],
                    //'tgl_simpan',
                    [
                        'attribute' => 'tgl_simpan',
                        'value'     => 'tgl_simpan',
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
            
            <h1>Data Pengambilan Uang</h1>
            <?= GridView::widget([
                'dataProvider' => $dataProvider2,
                'filterModel' => $searchModel2,
                'showFooter' => true,
                'footerRowOptions'=>['style'=>'font-weight:bold;text-align:right;'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'no_ambil',
                    //'id_anggota',
                    [
                       'class' => 'yii\grid\DataColumn',
                       'header' => 'Nama Anggota',
                       'value' => 'anggota.nama',
                       'filter' => Html::activeDropDownList($searchModel2, 'id_anggota', $anggota, ['class'=>'form-control', 'prompt'=>'--Pilih--'])
                    ],
                    //'jml_ambil',
                    [
                        'attribute' => 'jml_ambil',
                        'contentOptions' => ['style' => 'text-align:right'],
                        'format'=>['decimal',0],
                        'footer' => 'Total : '.number_format(Ambil::getTotal($dataProvider2->models, 'jml_ambil'), 0, ".", ",")
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
                       'filter' => Html::activeDropDownList($searchModel2, 'id_karyawan', $karyawan, ['class'=>'form-control', 'prompt'=>'--Pilih--'])
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            
            <h3> Saldo Tersisa (Rp.) :
                <?= Html::textInput('id_anggota', $totalSaldo, ['class' => 'form-control', 'readOnly' => true]); ?>
            </h3>
    <?php    
        } else {
    ?>
        <h1><?= Html::encode($this->title) ?></h1>
        <p>        
            <?php
              if(Yii::$app->user->identity->roletype=='System Admin') {
            ?>
                <?= Html::a('Buat Data Simpan Uang', ['create'], ['class' => 'btn btn-success']) ?>

                <?= Html::a('Export ke PDF', ['exportpdfsimpan'], ['class' => 'btn btn-default']) ?>
            <?php
              } 
              else if(Yii::$app->user->identity->roletype=='Karyawan') {
            ?>
                <?= Html::a('Buat Data Simpan Uang', ['create'], ['class' => 'btn btn-success']) ?>
            <?php
              }
            ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'showFooter' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'no_simpan',
                //'id_anggota',
                [
                   'class' => 'yii\grid\DataColumn',
                   'header' => 'Nama Anggota',
                   'value' => 'anggota.nama',
                   'filter' => Html::activeDropDownList($searchModel, 'id_anggota', $anggota, ['class'=>'form-control', 'prompt'=>'--Pilih--'])
                ],
                //'jml_simpan',
                [
                    'attribute' => 'jml_simpan',
                    'contentOptions' => ['style' => 'text-align:right'],
                    'format'=>['decimal',0]
                ],
                //'tgl_simpan',
                [
                    'attribute' => 'tgl_simpan',
                    'value'     => 'tgl_simpan',
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
    <?php    
        }
    ?>
</div>