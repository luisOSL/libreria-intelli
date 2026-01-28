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

        // 2. When updated: Handle author reassignment
        static::updating(function ($book) {
            // Check if the author_id was actually changed
            if ($book->isDirty('author_id')) {
                $oldAuthorId = $book->getOriginal('author_id');
                $newAuthorId = $book->author_id;

                // Decrement the old author
                \App\Author::where('id', $oldAuthorId)->decrement('books_count');

                // Increment the new author
                \App\Author::where('id', $newAuthorId)->increment('books_count');
            }
        });

        // When a book is deleted, decrement the author's count
        static::deleted(function ($book) {
            $book->author()->decrement('books_count');
        });
    }
}
