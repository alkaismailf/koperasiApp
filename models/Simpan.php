<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_simpan".
 *
 * @property string $no_simpan
 * @property string $id_anggota
 * @property int $jml_simpan
 * @property string $tgl_simpan
 * @property string $id_karyawan
 *
 * @property TbAnggota $anggota
 * @property TbKaryawan $karyawan
 */
class Simpan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_simpan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_simpan', 'id_anggota', 'jml_simpan', 'tgl_simpan', 'id_karyawan'], 'required'],
            [['jml_simpan'], 'integer'],
            [['tgl_simpan'], 'safe'],
            [['no_simpan', 'id_anggota', 'id_karyawan'], 'string', 'max' => 100],
            [['no_simpan'], 'unique'],
            [['id_anggota'], 'exist', 'skipOnError' => true, 'targetClass' => Anggota::className(), 'targetAttribute' => ['id_anggota' => 'id_anggota']],
            [['id_karyawan'], 'exist', 'skipOnError' => true, 'targetClass' => Karyawan::className(), 'targetAttribute' => ['id_karyawan' => 'id_karyawan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'no_simpan' => 'No. Simpan',
            'id_anggota' => 'ID Anggota',
            'jml_simpan' => 'Jumlah Simpan (Rp.)',
            'tgl_simpan' => 'Tanggal Simpan',
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

    public static function getTotal($provider, $jml_simpan)
    {
        $totalsimpan = 0;
        foreach ($provider as $item) {
          $totalsimpan += $item[$jml_simpan];
      }
      return $totalsimpan;  
    }
}