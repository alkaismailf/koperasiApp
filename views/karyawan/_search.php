<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KaryawanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="karyawan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_karyawan') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'jekel') ?>

    <?= $form->field($model, 'ttl') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'no_telp') ?>

    <?= $form->field($model, 'tgl_masuk_kerja') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
