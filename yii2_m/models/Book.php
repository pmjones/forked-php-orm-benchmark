<?php

namespace app\models;

class Book extends \yii\db\ActiveRecord
{
    /**
     * @var \yii\db\Connection
     */
    public static $db;

    public static function getDb()
    {
        return static::$db;
    }

    public static function tableName()
    {
        return 'Book';
    }

    public static function createTable()
    {
        static::$db->createCommand()->createTable('Book', [
            'id' => 'pk',
            'title' => 'string NOT NULL',
            'isbn' => 'string(24) NOT NULL',
            'price' => 'decimal NOT NULL',
            'author_id' => 'int NOT NULL',
            'FOREIGN KEY (author_id) REFERENCES Author(id)'
        ])->execute();
    }


    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }
}