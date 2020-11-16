<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Dokumen */

$this->title = 'Upload Dokumen';
$this->params['breadcrumbs'][] = ['label' => 'Tentang Kami'];
$this->params['breadcrumbs'][] = ['label' => 'Dokumen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dokumen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
