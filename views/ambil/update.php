<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ambil */

$this->title = 'Update Pengambilan Uang : ' . $model->no_ambil;
$this->params['breadcrumbs'][] = ['label' => 'Transaksi'];
$this->params['breadcrumbs'][] = ['label' => 'Pengambilan Uang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_ambil, 'url' => ['view', 'id' => $model->no_ambil]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ambil-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
