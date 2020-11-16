<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_pinjam".
 *
 * @property string $no_pinjam
 * @property string $id_anggota
 * @property int $jml_pinjam
 * @property string $tenor
 * @property string $tgl_pinjam
 * @property string $id_karyawan
 *
 * @property TbAnggota $anggota
 * @property TbKaryawan $karyawan
 */
class Pinjam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_pinjam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_pinjam', 'id_anggota', 'jml_pinjam', 'tenor', 'tgl_pinjam', 'id_karyawan'], 'required'],
            [['jml_pinjam', 'cicilan', 'bayar_cicilan'], 'integer'],
            [['tenor', 'tgl_pinjam'], 'safe'],
            [['no_pinjam', 'id_anggota', 'id_karyawan'], 'string', 'max' => 100],
            [['no_pinjam'], 'unique'],
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
            'no_pinjam' => 'No. Pinjam',
            'id_anggota' => 'ID Anggota',
            'jml_pinjam' => 'Jumlah Pinjam (Rp.)',
            'tenor' => 'Tanggal Jatuh Tempo',
            'tgl_pinjam' => 'Tanggal Pinjam ',
            'cicilan' => 'Cicilan per Bulan (Rp.)',
            'bayar_cicilan' => 'Pembayaran (berapa kali)',
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
}
