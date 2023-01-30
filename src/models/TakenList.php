<?php

namespace app\src\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "taken_list".
 *
 * @property int $id
 * @property string|null $date_taken
 * @property int $book_id
 * @property int $worker_id
 * @property int $client_id
 * @property string $time_returned
 *
 * @property Book $book
 * @property Client $client
 * @property Worker $worker
 */
class TakenList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taken_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_taken'], 'safe'],
            [['book_id', 'worker_id', 'client_id'], 'required'],
            [['book_id', 'worker_id', 'client_id'], 'integer'],
            ];
    }



    /**
     * @param string|null $date_taken
     */
    public function setDateTaken(): self
    {
        $this->date_taken = new Expression('NOW()');
        return $this;
    }

    /**
     * @param int $book_id
     */
    public function setBookId(int $book_id): self
    {
        $this->book_id = $book_id;
        return $this;
    }

    /**
     * @param int $worker_id
     */
    public function setWorkerId(int $worker_id): self
    {
        $this->worker_id = $worker_id;
        return $this;
    }

    /**
     * @param int $client_id
     */
    public function setClientId(int $client_id): self
    {
        $this->client_id = $client_id;
        return $this;
    }

    /**
     * @param string $time_returned
     */
    public function setTimeReturned(string $days): self
    {
        $this->time_returned = new Expression("NOW() + $days");
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
}
