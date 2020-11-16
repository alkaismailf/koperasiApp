<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Reset Password';
$this->params['breadcrumbs'][] = ['label' => 'Login', 'url' => ['login']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="forgot">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Isi kolom di bawah ini</p><br>

    <div class="row">
        <div class="col-lg-5">

        <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'username')->label('User ID :')->textInput(['autofocus' => true]) ?>
            
            <?= $form->field($model, 'emailuser')->label('Email :')->hint('reset password akan dikirimkan ke email ini')->input('emailuser') ?>
        
            <div class="form-group">
                <?= Html::submitButton('Proses', ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Kembali'), ['login'], ['class' => 'btn btn-warning']) ?>
            </div>
        <?php ActiveForm::end(); ?>

        </div>
    </div>
</div><!-- signup -->


<!--<?php if(yii::$app->user->hasFlash('forgot')): ?>

<div class="flash-success">
	<?php yii::$app->user->getFlash('forgot'); ?>
</div>

<?php else: ?>

<div class="form">

	<?php $form=$this->beginWidget(
		'ActiveForm', array(
			'id'=>'forgot-form',
	        'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)
	); ?>

		<div class="row">
	            Email : <input name="Lupa[email]" id="ContactForm_email" type="email">
		</div>

		<div class="row buttons">
			<?php Html::submitButton('Submit'); ?>
		</div>

	<?php $this->endWidget(); ?>

</div>

<?php endif; ?>-->