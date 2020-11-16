<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pinjam */

$this->title = 'Update Peminjaman Uang :';
$this->params['breadcrumbs'][] = ['label' => 'Transaksi'];
$this->params['breadcrumbs'][] = ['label' => 'Peminjaman Uang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_pinjam, 'url' => ['view', 'id' => $model->no_pinjam]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pinjam-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
