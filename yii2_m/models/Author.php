<?php

namespace app\models;

class Author extends \yii\db\ActiveRecord
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
        return 'Author';
    }

    public static function createTable()
    {
        static::$db->createCommand()->createTable('Author', [
            'id' => 'pk',
            'firstName' => 'string(128) NOT NULL',
            'lastName' => 'string(128) NOT NULL',
            'email' => 'string(128)',
        ])->execute();
    }
}