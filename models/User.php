<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $fullname
 * @property string $phone
 * @property string $email
 * @property string $auth_key
 * @property int $role
 *
 * @property Application[] $applications
 */
class User extends ActiveRecord implements IdentityInterface

{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role'], 'default', 'value' => 0],
            [['login', 'password', 'fullname', 'phone', 'email'], 'required'],
            [['role'], 'integer'],
            [['login', 'password', 'fullname', 'email', 'auth_key'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 16],
            [['login'], 'unique'],

            [['phone'], 'match', 'pattern' => '/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/', 'message' => 'Телефон в формате: +7(XXX)-XXX-XX-XX'],

            ['email', 'email'],
            [['password'], 'string', 'min' => 6],

            [['fullname'], 'match', 'pattern' => '/^(([а-яё]+)\s){2}[а-яё\s]+$/ui', 'message' => 'Символы кириллицы и не менее 2 пробелов'],
           // ['rule', 'boolean'],


        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'password' => 'Пароль',
            'fullname' => 'ФИО',
            'phone' => 'Телефон',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'role' => 'Role',
        ];
    }

    /**
     * Gets query for [[Applications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::class, ['user_id' => 'id']);
    }

    public static function findByUsername(string $login): bool|User
    {
    return static:: findOne(['login' =>$login]) ?? false;
    }


    
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }


    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

     public function getIsAdmin(): bool
    {
        return $this-> role ==1;
    }

     public function getIsClient(): bool
    {
        return $this-> role ==0;
    }
}

