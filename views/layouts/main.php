<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

require_once('alert.php');

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'KPRS Sejahtera',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $menuItems = [];
    $menuItems2 = [];

    if(Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        if(Yii::$app->user->identity->roletype=='Anggota'){
            $menuItems2[] =  ['label' => 'Berita', 'url' => ['/berita']];

            $menuItems2[] = ['label' => 'Transaksi', 'items'=>[
                ['label' => 'Simpan & Ambil', 'url' => ['/simpan']],
                ['label' => 'Pinjam', 'url' => ['/pinjam']],
                //['label' => 'Ambil', 'url' => ['/ambil']],
            ]];

            $menuItems[] = ['label' => 'Tentang Kami', 'items'=>[
                ['label' => 'About', 'url' => ['/site/about']],
                //['label' => 'Contact', 'url' => ['/site/contact']],
                //['label' => 'Dokumen', 'url' => ['/dokumen']],
            ]];

        } else if(Yii::$app->user->identity->roletype=='Karyawan'){
            $menuItems2[] =  ['label' => 'Berita', 'url' => ['/berita']];

            $menuItems2[] = ['label' => 'Transaksi', 'items'=>[
                ['label' => 'Simpan', 'url' => ['/simpan']],
                ['label' => 'Pinjam', 'url' => ['/pinjam']],
                ['label' => 'Ambil', 'url' => ['/ambil']],
            ]];

            $menuItems[] = ['label' => 'Tentang Kami', 'items'=>[
                ['label' => 'About', 'url' => ['/site/about']],
                //['label' => 'Contact', 'url' => ['/site/contact']],
                ['label' => 'Dokumen', 'url' => ['/dokumen']],
            ]];

        }else if(Yii::$app->user->identity->roletype=='System Admin'){
            $menuItems2[] =  ['label' => 'Berita', 'url' => ['/berita']];

            $menuItems2[] = ['label' => 'Manajemen', 'items'=>[
                ['label' => 'Anggota', 'url' => ['/anggota']],
                ['label' => 'Karyawan', 'url' => ['/karyawan']],
            ]];

            $menuItems2[] = ['label' => 'Transaksi', 'items'=>[
                ['label' => 'Simpan', 'url' => ['/simpan']],
                ['label' => 'Pinjam', 'url' => ['/pinjam']],
                ['label' => 'Ambil', 'url' => ['/ambil']],
            ]];

            $menuItems[] = ['label' => 'Tentang Kami', 'items'=>[
                ['label' => 'About', 'url' => ['/site/about']],
                //['label' => 'Contact', 'url' => ['/site/contact']],
                ['label' => 'Dokumen', 'url' => ['/dokumen']],
            ]];

        } else if(Yii::$app->user->identity->roletype=='Manajemen dan Pengurus'){
            $menuItems2[] =  ['label' => 'Berita', 'url' => ['/berita']];

            $menuItems2[] = ['label' => 'Manajemen', 'items'=>[
                ['label' => 'Anggota', 'url' => ['/anggota']],
                ['label' => 'Karyawan', 'url' => ['/karyawan']],
            ]];

            $menuItems2[] = ['label' => 'Transaksi', 'items'=>[
                ['label' => 'Simpan', 'url' => ['/simpan']],
                ['label' => 'Pinjam', 'url' => ['/pinjam']],
                ['label' => 'Ambil', 'url' => ['/ambil']],
            ]];

            $menuItems[] = ['label' => 'Tentang Kami', 'items'=>[
                ['label' => 'About', 'url' => ['/site/about']],
                //['label' => 'Contact', 'url' => ['/site/contact']],
                ['label' => 'Dokumen', 'url' => ['/dokumen']],
            ]];

        }

        /*$menuItems[] = ['label' => 'Profile', 'items'=>[
            ['label' => 'Ganti Password', 'url'=> ['/site/changepassword']],
            '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->roletype . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
            . '</li>',
            ]];*/

        $menuItems[] = ['label' => 'Profile', 'items'=>[
            ['label' => 'Ganti Password', 'url'=> ['/site/changepassword']],
            [
                'label' => 'Logout'.' (' . Yii::$app->user->identity->username . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ],
            ]];

        /*$menuItems[] = ['label' => 'Ganti Password', 'url'=> ['/site/changepassword']];
         
        $menuItems[] = 
        '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->roletype . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>';*/
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $menuItems2,
    ]);

    /*echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [   

        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->roletype . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);*/
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Koperasi Sejahtera <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
