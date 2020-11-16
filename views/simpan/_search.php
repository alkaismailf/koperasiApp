<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SimpanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="simpan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'no_simpan') ?>

    <?= $form->field($model, 'id_anggota') ?>

    <?= $form->field($model, 'jml_simpan') ?>

    <?= $form->field($model, 'tgl_simpan') ?>

    <?= $form->field($model, 'id_karyawan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
