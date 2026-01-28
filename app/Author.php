<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //

    protected $fillable = ['name'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($author) {
            // This ensures that when an author is deleted, 
            // we could perform additional logic if needed.
            // The database handles the physical delete of books,
            // but the author's record is gone anyway, so the count doesn't matter.
        });
    }
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
