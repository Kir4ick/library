<?php

namespace app\src\models;

/**
 * This is the model class for table "position".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property Worker[] $workers
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'position';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            ['name', 'required']
        ];
    }

    /**
     * Gets query for [[Workers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkers()
    {
        return $this->hasMany(Worker::class, ['position_id' => 'id']);
    }
}
