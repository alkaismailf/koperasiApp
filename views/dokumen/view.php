<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Dokumen */

$this->title = $model->nama_file;
$this->params['breadcrumbs'][] = ['label' => 'Tentang Kami'];
$this->params['breadcrumbs'][] = ['label' => 'Dokumen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dokumen-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_dokumen], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_dokumen], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Kembali'), ['index'], ['class' => 'btn btn-warning']) ?>
        &emsp;&emsp;&emsp;&emsp;
        <?php
          if(Yii::$app->user->identity->roletype=='System Admin') {
        ?>
            <?= Html::a('Download File', ['download', 'id' => $model->id_dokumen], ['class' => 'btn btn-default']) ?> 
        <?php
          } else if(Yii::$app->user->identity->roletype=='Karyawan') {
        ?> 
                <?= Html::a('Download File', ['download', 'id' => $model->id_dokumen], ['class' => 'btn btn-default']) ?>
        <?php
          } else if(Yii::$app->user->identity->roletype=='Manajemen dan Pengurus') {
        ?>
                <?= Html::a('Download File', ['download', 'id' => $model->id_dokumen], ['class' => 'btn btn-default']) ?>
        <?php
          }
        ?> 
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_dokumen',
            'nama_file',
            'file',
            'keterangan',
        ],
    ]) ?>

</div>
