<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "tb_dokumen".
 *
 * @property int $id_dokumen
 * @property string $nama_file
 * @property string $file
 * @property string $keterangan
 */
class Dokumen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    /**
     * @var UploadedFile file attribute
     */
    public $upload_file;

    public static function tableName()
    {
        return 'tb_dokumen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_file', 'file', 'keterangan'], 'required'],
            [['nama_file', 'keterangan'], 'string', 'max' => 100],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf, docx, doc, txt'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_dokumen' => 'ID Dokumen',
            'nama_file' => 'Nama File',
            'file' => 'File',
            'upload_file' => 'Upload File',
            'keterangan' => 'Keterangan',
        ];
    }

    public function uploadFile() 
    {
        // get the uploaded file instance
        $docs = UploadedFile::getInstance($this, 'upload_file');
 
        // if no docs was uploaded abort the upload
        if (empty($docs)) {
            return false;
        }
 
        // generate random name for the file
        $this->file = time(). '.' . $docs->extension;
 
        // the uploaded docs instance
        return $docs;
    }
 
    public function getUploadedFile() 
    {
        // return a default image placeholder if your source avatar is not found
        $pic = isset($this->file) ? $this->file : 'default.pdf';

        return Yii::$app->params['fileUploadUrl'] . $pic;
    }
}
