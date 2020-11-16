<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ambil */

$this->title = $model->no_ambil;
$this->params['breadcrumbs'][] = ['label' => 'Transaksi'];
$this->params['breadcrumbs'][] = ['label' => 'Pengambilan Uang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ambil-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->no_ambil], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->no_ambil], [
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
            'no_ambil',
            'id_anggota',
            'jml_ambil',
            'tgl_ambil',
            'id_karyawan',
        ],
    ]) ?>

</div>
