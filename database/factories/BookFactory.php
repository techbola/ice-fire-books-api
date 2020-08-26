<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Book;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'name' => 'Bola',
        'isbn' => '123-456',
        'authors' => 'Ade, Bola',
        'number_of_pages' => 10,
        'publisher' => 'Bola Publisher',
        'country' => 'Nigeria',
        'release_date' => '2020-08-25',
    ];
});