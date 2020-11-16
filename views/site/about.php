<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = ['label' => 'Tentang Kami'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Program koperasi simpan pinjam ini berbasis web dan dibuat dengan menggunakan framework Yii2.
    </p>

    <code><?= __FILE__ ?></code>
</div>
