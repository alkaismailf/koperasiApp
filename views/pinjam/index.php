<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PinjamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Peminjaman Uang';
$this->params['breadcrumbs'][] = ['label' => 'Transaksi'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pinjam-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p> 
        <?php
          if(Yii::$app->user->identity->roletype=='System Admin') {
        ?>
            <?= Html::a('Buat Data Pinjam Uang', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Export ke PDF', ['exportpdfpinjam'], ['class' => 'btn btn-default']) ?>
        <?php
          } 
          else if(Yii::$app->user->identity->roletype=='Karyawan') {
        ?>
            <?= Html::a('Buat Data Pinjam Uang', ['create'], ['class' => 'btn btn-success']) ?>
        <?php
          }
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'no_pinjam',
            //'id_anggota',
            [
               'class' => 'yii\grid\DataColumn',
               'header' => 'Nama Anggota',
               'value' => 'anggota.nama',
               'filter' => Html::activeDropDownList($searchModel, 'id_anggota', $anggota, ['class'=>'form-control', 'prompt'=>'--Pilih--'])
            ],
            //'jml_pinjam',
            [
                'attribute' => 'jml_pinjam',
                'contentOptions' => ['style' => 'text-align:right'],
                'format'=>['decimal',0]
            ],
            //'tgl_pinjam',
            [
                'attribute' => 'tgl_pinjam',
                'value'     => 'tgl_pinjam',
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
            //'tenor',
            [
                'attribute' => 'tenor',
                'contentOptions' => ['style' => 'text-align:center'],
            ],
            //'cicilan',
            [
                'attribute' => 'cicilan',
                'contentOptions' => ['style' => 'text-align:right'],
                'format'=>['decimal',0]
            ],
            /*'bayar_cicilan',
            [
                'attribute' => 'bayar_cicilan',
                'contentOptions' => ['style' => 'text-align:right'],
                'format'=>['decimal',0]
            ],*/
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

            $pinjam = 0;
            $cicil = 0;
            foreach ($dataProvider->models as $item) {
                $pinjam += $item['jml_pinjam'];
            }

            foreach ($dataProvider->models as $item) {
                $cicil += ($item['cicilan'] * $item['bayar_cicilan']);
            }

            $sisacicilan = $pinjam - $cicil;
    ?>  
            <h3> Sisa Hutang (Rp.) :
                <?= Html::textInput('id_anggota', $sisacicilan, ['class' => 'form-control', 'readOnly' => true]); ?>
            </h3>
    <?php    
        }
    ?>
</div>
