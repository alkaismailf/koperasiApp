<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_berita".
 *
 * @property int $id_berita
 * @property string $judul
 * @property string $konten
 * @property string $penulis
 * @property string $tgl_buat
 */
class Berita extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_berita';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['judul', 'konten', 'penulis', 'tgl_buat'], 'required'],
            [['konten'], 'string'],
            [['tgl_buat'], 'safe'],
            [['judul', 'penulis'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_berita' => 'ID Berita',
            'judul' => 'Judul',
            'konten' => 'Isi Konten',
            'penulis' => 'Nama Penulis',
            'tgl_buat' => 'Tanggal dibuat ',
        ];
    }
}
