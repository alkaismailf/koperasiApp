<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TbMasterData */
/* @var $form ActiveForm */

$this->title = 'Daftar User Baru';
$this->params['breadcrumbs'][] = ['label' => 'Login', 'url' => ['login']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Silahkan isi field untuk membuat akun</p><br>

    <div class="row">
        <div class="col-lg-5">

        <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'username')->label('User ID :')->hint('diisi dengan ID yang akan digunakan untuk login')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'namauser')->label('Nama :')->hint('diisi dengan Nama anda') ?>

            <?= $form->field($model, 'emailuser')->label('Email :')->hint('diisi dengan email anda')->input('emailuser') ?>

            <?= $form->field($model, 'nohpuser')->label('No. Handphone :')->hint('diisi dengan nomor hp anda') ?>

            <?= $form->field($model, 'password')->passwordInput()->hint('diharapkan password jangan terlalu mudah')->label('Password :') ?>

            <?= $form->field($model, 'roletype')->label('Hak Akses Sebagai :')->dropDownList(
                ['Anggota' => 'Anggota', 'Karyawan' => 'Karyawan', 'Manajemen dan Pengurus' => 'Manajemen dan Pengurus', 'System Admin' => 'System Admin']
                ); ?>
        
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Kembali'), ['login'], ['class' => 'btn btn-warning']) ?>
            </div>
        <?php ActiveForm::end(); ?>

        </div>
    </div>
</div><!-- signup -->