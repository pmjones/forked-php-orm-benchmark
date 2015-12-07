<?php

class Author extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'Author';
    }

    public static function createTable()
    {
        static::$db->createCommand()->createTable('Author', [
            'id' => 'pk',
            'firstName' => 'string(128) NOT NULL',
            'lastName' => 'string(128) NOT NULL',
            'email' => 'string(128)',
        ]);
    }
}