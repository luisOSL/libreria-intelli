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
        });
    }
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
