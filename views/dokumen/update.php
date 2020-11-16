<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dokumen */

$this->title = 'Update Dokumen : ';
$this->params['breadcrumbs'][] = ['label' => 'Tentang Kami'];
$this->params['breadcrumbs'][] = ['label' => 'Dokumen', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_dokumen, 'url' => ['view', 'id' => $model->id_dokumen]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dokumen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
