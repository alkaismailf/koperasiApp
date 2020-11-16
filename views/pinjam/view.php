<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pinjam */

$this->title = $model->no_pinjam;
$this->params['breadcrumbs'][] = ['label' => 'Transaksi'];
$this->params['breadcrumbs'][] = ['label' => 'Peminjaman Uang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pinjam-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->no_pinjam], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->no_pinjam], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Kembali'), ['index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'no_pinjam',
            'id_anggota',
            'jml_pinjam',  
            'tgl_pinjam',
            'tenor',
            'cicilan',
            'bayar_cicilan',
            'id_karyawan',
        ],
    ]) ?>

</div>
