<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Simpan */

$this->title = 'Update Penyimpanan Uang :';
$this->params['breadcrumbs'][] = ['label' => 'Transaksi'];
$this->params['breadcrumbs'][] = ['label' => 'Penyimpanan Uang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_simpan, 'url' => ['view', 'id' => $model->no_simpan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="simpan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
