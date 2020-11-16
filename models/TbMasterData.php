<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_masterdata".
 *
 * @property int $id
 * @property string $username
 * @property string $namauser
 * @property string $emailuser
 * @property string $nohpuser
 * @property string $password
 * @property string $token
 * @property string $roletype
 */
class TbMasterData extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_masterdata';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'namauser', 'emailuser', 'nohpuser', 'password', 'roletype'], 'required'],
            [['roletype'], 'string'],
            [['username', 'namauser', 'emailuser', 'nohpuser', 'password', 'token', 'auth_key'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'namauser' => 'Namauser',
            'emailuser' => 'Emailuser',
            'nohpuser' => 'Nohpuser',
            'password' => 'Password',
            'token' => 'Token',
            'roletype' => 'Roletype',
            'auth_key' => 'Authentication Key',
        ];
    }

     public function getAuthKey()
    {
        //throw new \yii\base\NotSupportedException();
        return $this->auth_key;
    }

    public function getId()
    {
       return $this->id;
    }

    public function validateAuthKey($authKey)
    {
        //throw new \yii\base\NotSupportedException();
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new \yii\base\NotSupportedException();

        //return static::findOne(['access_token' => $token]);
    }

    public static function findByUsername($username)
    {
        return self::findOne(['username'=>$username]);
    }

    public static function findByEmail($emailuser)
    {
        //return self::find()->where(['emailuser'=>$emailuser])->one();

        return self::findOne(['emailuser'=>$emailuser]);
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = Yii::$app->getSecurity()->generateRandomString();
            }
            return true;
        }
        return false;
    }
}
