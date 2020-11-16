<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\models\Anggota;
use app\models\Karyawan;

/* @var $this yii\web\View */
/* @var $model app\models\Simpan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="simpan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_simpan')->textInput(['maxlength' => true]) ?>

    <?= 
        $form->field($model, 'id_anggota')->label('Nama Anggota')->dropDownList(
            ArrayHelper::map(Anggota::find()->all(),'id_anggota','nama'),['prompt'=>'- Pilih Anggota -']
        ) 
    ?>

    <?= $form->field($model, 'jml_simpan')->textInput() ?>

    <?=
        $form->field($model, 'tgl_simpan')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Pilih Tanggal ...'],
            'pluginOptions' => [
                'autoclose'=>true,
                'todayHighlight'=>true,
                'format'=>'yyyy-mm-dd'
            ]
        ]);
    ?>

    <?= $form->field($model, 'id_karyawan')->label('Nama Karyawan')->dropDownList(
            ArrayHelper::map(Karyawan::find()->all(),'id_karyawan','nama'),['prompt'=>'- Pilih Karyawan -']
        ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Kembali'), ['index'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
