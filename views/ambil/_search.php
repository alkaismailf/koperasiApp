<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AmbilSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ambil-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'no_ambil') ?>

    <?= $form->field($model, 'id_anggota') ?>

    <?= $form->field($model, 'jml_ambil') ?>

    <?= $form->field($model, 'tgl_ambil') ?>

    <?= $form->field($model, 'id_karyawan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
