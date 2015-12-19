<?php

class Book extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
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
            'author_id' => 'int',
        ]);
    }

    public function relations()
    {
        return array(
            'author'=>array(self::BELONGS_TO, 'Author', 'author_id'),
        );
    }
}