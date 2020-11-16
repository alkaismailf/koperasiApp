<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BeritaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Beritas';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="berita-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <h1 align="center"> 
        Sekilas Berita
    </h1><br>

    <p>
        <?php
          if(Yii::$app->user->identity->roletype=='System Admin') {
        ?>
            <?= Html::a('Tulis Berita', ['create'], ['class' => 'btn btn-success']) ?>
        <?php
          }
        ?>
    </p>

    <!-- <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_berita',
            'judul',
            'konten:ntext',
            'penulis',
            'tgl_buat',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?> -->

    <?php
        $con = \yii::$app->db;
        $sql = $con->createCommand("select * from tb_berita order by tgl_buat desc");
        $posts = $sql->query();

        if(!$posts)
            echo '<h2> Tidak ada Berita ! </h2>';
        else 
            foreach ($posts as $post) :
        ?>

            <hr>
            <h2> 
                <?php echo $post['judul']; ?> 
            </h2>
            <p>
                Penulis : <b><?php echo $post['penulis']; ?></b> &emsp;
                Tanggal : <b><?php echo date('d/m/Y', strtotime($post['tgl_buat'])); ?></b>
            </p>
            <p>
                <?php echo $post['konten']; ?>
            </p>

            <?php
              if(Yii::$app->user->identity->roletype=='System Admin') {
            ?>
                <?= Html::a('Update', ['update', 'id' =>$post['id_berita']], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('View', ['view', 'id' =>$post['id_berita']], ['class' => 'btn btn-info']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $post['id_berita']], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Yakin akan menghapus berita ini ?',
                        'method' => 'post',
                    ],
                ]) ?>
            <?php
              }
            ?>
            
        <?php endforeach;?>
</div>