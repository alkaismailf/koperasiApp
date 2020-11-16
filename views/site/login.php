<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$this->registerJs("jQuery('#reveal-password').change(function(){jQuery('#loginform-password').attr('type',this.checked?'text':'password');})");
?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;
        <?= Html::checkbox('reveal-password', false, ['id' => 'reveal-password']) ?> <?= Html::label('Show password', 'reveal-password') ?>
        
        <p>______________________________________________________</p>
       
        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

        <!--<div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <p>atau Login dengan akun di bawah ini : </p>
                <?= yii\authclient\widgets\AuthChoice::widget(['baseAuthUrl' => ['site/auth']]) ?>
            </div>
        </div>-->

    <?php ActiveForm::end(); ?>

    <br>
    <!--<a href="http://localhost/koperasi/web/index.php?r=site%2Fforgot" class="text-center">Lupa Password ?</a> <br>-->
    <a href="http://localhost/koperasi/web/index.php?r=site%2Fsignup" class="text-center"> Sign Up disini !!</a>

    <!--<div class="col-lg-offset-1" style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>-->
</div>