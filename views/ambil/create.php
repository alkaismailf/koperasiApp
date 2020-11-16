<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ambil */

$this->title = 'Data Pengambilan Uang';
$this->params['breadcrumbs'][] = ['label' => 'Transaksi'];
$this->params['breadcrumbs'][] = ['label' => 'Pengambilan Uang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ambil-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
