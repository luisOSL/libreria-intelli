<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $fillable = ['title', 'author_id'];
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public static function boot()
    {
        parent::boot();

        // When a book is created, increment the author's count
        static::created(function ($book) {
            $book->author()->increment('books_count');
        });

        // When a book is deleted, decrement the author's count
        static::deleted(function ($book) {
            $book->author()->decrement('books_count');
        });
    }

}
