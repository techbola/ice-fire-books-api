<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class Book extends Model
{
    protected $guarded = [];

    public static function allBooks()
    {
        return app(Pipeline::class)
            ->send(Book::query())
            ->through([
                \App\BookFilters\NameSearch::class,
                \App\BookFilters\CountrySearch::class,
                \App\BookFilters\PublisherSearch::class,
                \App\BookFilters\ReleaseDateSearch::class,
            ])
            ->thenReturn();
    }
}
