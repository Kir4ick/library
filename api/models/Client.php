<?php

namespace app\api\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string $name
 * @property string $middle_name
 * @property string $last_name
 * @property string $passport_series
 * @property string $passport_number
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'middle_name', 'last_name', 'passport_series', 'passport_number'], 'required'],
            [['name', 'middle_name', 'last_name'], 'string', 'max' => 255],
            [['passport_series'], 'string', 'max' => 4],
            [['passport_number'], 'string', 'max' => 6],
        ];
    }

    /**
     * @param string $name
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $middle_name
     */
    public function setMiddleName(string $middle_name): self
    {
        $this->middle_name = $middle_name;
        return $this;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * @param string $passport_series
     */
    public function setPassportSeries(string $passport_series): self
    {
        $this->passport_series = $passport_series;
        return $this;
    }

    /**
     * @param string $passport_number
     */
    public function setPassportNumber(string $passport_number): self
    {
        $this->passport_number = $passport_number;
        return $this;
    }

}
