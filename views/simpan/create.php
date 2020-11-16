<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Simpan */

$this->title = 'Data Penyimpanan Uang';
$this->params['breadcrumbs'][] = ['label' => 'Transaksi'];
$this->params['breadcrumbs'][] = ['label' => 'Penyimpanan Uang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simpan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
