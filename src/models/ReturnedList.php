<?php

namespace app\src\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "returned_list".
 * @property int $id
 * @property string|null $date_returned
 * @property int $book_id
 * @property int $worker_id
 * @property int $client_id
 * @property string|null $condition
 *
 * @property Book $book
 * @property Client $client
 * @property Worker $worker
 */
class ReturnedList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'returned_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_returned'], 'safe'],
            [['book_id', 'worker_id', 'client_id'], 'required'],
            [['book_id', 'worker_id', 'client_id'], 'integer'],
            [['condition'], 'string', 'max' => 255],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['book_id' => 'id']],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['client_id' => 'id']],
            [['worker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Worker::class, 'targetAttribute' => ['worker_id' => 'id']],
        ];
    }



    public function setDateReturned(?string $date_returned): self
    {
        if($date_returned === null){
            $this->date_returned = (new Expression('NOW()'))->expression;
        }else{
            $this->date_returned = $date_returned;
        }

        return $this;
    }

    public function setBookId(int $book_id): self
    {
        $this->book_id = $book_id;
        return $this;
    }

    public function setWorkerId(int $worker_id): self
    {
        $this->worker_id = $worker_id;
        return $this;
    }

    public function setClientId(int $client_id): self
    {
        $this->client_id = $client_id;
        return $this;
    }

    public function setCondition(?string $condition): self
    {
        $this->condition = $condition;
        return $this;
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::class, ['id' => 'client_id']);
    }

    /**
     * Gets query for [[Worker]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorker()
    {
        return $this->hasOne(Worker::class, ['id' => 'worker_id']);
    }

    public function fields()
    {
        $fields = parent::fields();
        unset($fields['worker_id'], $fields['client_id'], $fields['book_id']);
        $fields['worker'] = function (){
            return $this->worker;
        };
        $fields['client'] = function (){
            return $this->client;
        };
        $fields['book'] = function (){
            return $this->book;
        };
        return $fields;
    }
}
