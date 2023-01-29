<?php

namespace app\src\models;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property Book[] $books
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
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
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Author::class, ['id' => 'book_id'])->viaTable(
            'book_author', ['author_id' => 'id']
        );
    }
}
