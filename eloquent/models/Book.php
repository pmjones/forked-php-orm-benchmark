<?php

class Book extends Illuminate\Database\Eloquent\Model {

    protected $table = 'book';
    public $timestamps = false;

    public function author()
    {
        return $this->belongsTo('author');
    }
}