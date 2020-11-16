<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_ambil".
 *
 * @property string $no_ambil
 * @property string $id_anggota
 * @property int $jml_ambil
 * @property string $tgl_ambil
 * @property string $id_karyawan
 *
 * @property TbAnggota $anggota
 * @property TbKaryawan $karyawan
 */
class Ambil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_ambil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_ambil', 'id_anggota', 'jml_ambil', 'tgl_ambil', 'id_karyawan'], 'required'],
            [['jml_ambil'], 'integer'],
            [['tgl_ambil'], 'safe'],
            [['no_ambil', 'id_anggota', 'id_karyawan'], 'string', 'max' => 100],
            [['no_ambil'], 'unique'],
            [['id_anggota'], 'exist', 'skipOnError' => true, 'targetClass' => Anggota::className(), 'targetAttribute' => ['id_anggota' => 'id_anggota']],
            [['id_karyawan'], 'exist', 'skipOnError' => true, 'targetClass' => Karyawan::className(), 'targetAttribute' => ['id_karyawan' => 'id_karyawan']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'no_ambil' => 'No. Ambil',
            'id_anggota' => 'ID Anggota',
            'jml_ambil' => 'Jumlah Ambil (Rp.)',
            'tgl_ambil' => 'Tanggal Ambil ',
            'id_karyawan' => 'ID Karyawan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnggota()
    {
        return $this->hasOne(Anggota::className(), ['id_anggota' => 'id_anggota']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKaryawan()
    {
        return $this->hasOne(Karyawan::className(), ['id_karyawan' => 'id_karyawan']);
    }

    public static function getTotal($provider, $jml_ambil)
    {
        $totalambil = 0;
        foreach ($provider as $item) {
          $totalambil += $item[$jml_ambil];
      }
      return $totalambil;  
    }
}
