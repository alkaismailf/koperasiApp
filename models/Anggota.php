<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_anggota".
 *
 * @property string $id_anggota
 * @property string $nik
 * @property string $nama
 * @property string $jekel
 * @property string $ttl
 * @property string $email
 * @property string $no_telp
 *
 * @property TbAmbil[] $tbAmbils
 * @property TbPinjam[] $tbPinjams
 * @property TbSimpan[] $tbSimpans
 */
class Anggota extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_anggota';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_anggota', 'nik', 'nama', 'jekel', 'ttl', 'email', 'no_telp', 'status'], 'required'],
            [['jekel', 'status'], 'string'],
            [['id_anggota', 'nik', 'nama', 'ttl', 'email', 'no_telp'], 'string', 'max' => 100],
            [['id_anggota'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_anggota' => 'ID Anggota',
            'nik' => 'NIK',
            'nama' => 'Nama',
            'jekel' => 'Jenis kelamin',
            'ttl' => 'Tempat, Tanggal Lahir',
            'email' => 'Email',
            'no_telp' => 'No. Telp',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbAmbils()
    {
        return $this->hasMany(TbAmbil::className(), ['id_anggota' => 'id_anggota']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbPinjams()
    {
        return $this->hasMany(TbPinjam::className(), ['id_anggota' => 'id_anggota']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbSimpans()
    {
        return $this->hasMany(TbSimpan::className(), ['id_anggota' => 'id_anggota']);
    }
}
