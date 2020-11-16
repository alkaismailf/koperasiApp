<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_karyawan".
 *
 * @property string $id_karyawan
 * @property string $nama
 * @property string $jekel
 * @property string $ttl
 * @property string $email
 * @property string $no_telp
 */
class Karyawan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_karyawan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_karyawan', 'nama', 'jekel', 'ttl', 'email', 'no_telp', 'tgl_masuk_kerja'], 'required'],
            [['jekel'], 'string'],
            [['tgl_masuk_kerja'], 'safe'],
            [['id_karyawan', 'nama', 'ttl', 'email', 'no_telp'], 'string', 'max' => 100],
            [['id_karyawan'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_karyawan' => 'ID Karyawan',
            'nama' => 'Nama',
            'jekel' => 'Jenis kelamin',
            'ttl' => 'Tempat, Tanggal Lahir',
            'email' => 'Email',
            'no_telp' => 'No. Telp',
            'tgl_masuk_kerja' => 'Tgl Masuk Kerja',
        ];
    }
}
