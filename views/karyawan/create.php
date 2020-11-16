<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Karyawan */

$this->title = 'Tambah Karyawan';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen'];
$this->params['breadcrumbs'][] = ['label' => 'Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="karyawan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
