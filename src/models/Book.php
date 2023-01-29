<?php

namespace app\src\models;

use app\src\filters\BookSearch;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string|null $title
 * @property string $article
 * @property string|null $date_receipt
 *
 * @property Author[] $authors
 */
class Book extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'book';
    }


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'create_time',
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    public function rules()
    {
        return [
            [['article'], 'required'],
            [['date_receipt'], 'safe'],
            [['title', 'article'], 'string', 'max' => 255],
            [['article'], 'unique'],
        ];
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setArticle(): self
    {
        $this->article = Yii::$app->security->generateRandomString(30);
        return $this;
    }

    public function setDateReceipt(): self
    {
        $expression = new Expression('NOW()');
        $this->date_receipt = $expression;
        return $this;
    }

    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])->viaTable(
            'book_author', ['book_id' => 'id']
        );
    }

    public function extraFields()
    {
        return [
          'authors'
        ];
    }
}
