<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Karyawan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="karyawan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_karyawan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jekel')->dropDownList([ 'L' => 'L', 'P' => 'P', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'ttl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_telp')->textInput(['maxlength' => true]) ?>

    <?=
        $form->field($model, 'tgl_masuk_kerja')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Pilih Tanggal ...'],
            'pluginOptions' => [
                'autoclose'=>true,
                'todayHighlight'=>true,
                'format'=>'yyyy-mm-dd'
            ]
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Kembali'), ['index'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
