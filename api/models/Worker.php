<?php

namespace app\api\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "worker".
 *
 * @property int $id
 * @property string $login
 * @property string $password_hash
 * @property string|null $auth_key
 * @property string $name
 * @property string $middle_name
 * @property string $last_name
 * @property int $position_id
 *
 * @property Position $position
 */
class Worker extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'worker';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password_hash', 'name', 'middle_name', 'last_name', 'position_id'], 'required'],
            [['position_id'], 'integer'],
            [['login', 'password_hash', 'auth_key', 'name', 'middle_name', 'last_name'], 'string', 'max' => 255],
            [['login'], 'unique'],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => Position::class, 'targetAttribute' => ['position_id' => 'id']],
        ];
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;
        return $this;
    }

    public function setPasswordHash(string $password_hash): self
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password_hash);
        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setMiddleName(string $middle_name): self
    {
        $this->middle_name = $middle_name;
        return $this;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;
        return $this;
    }

    public function setPositionId(int $position_id): self
    {
        $this->position_id = $position_id;
        return $this;
    }

    /**
     * Gets query for [[Position]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Position::class, ['id' => 'position_id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        $this->generateAuthKey();
        $this->save();
        return $this->auth_key;
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString(60);
    }

    public function validateAuthKey($authKey)
    {
        
    }

    public function removeAuthKey(){
        $this->auth_key = null;
        $this->save();
    }
}
