<?php

namespace Tests;

use App\Book;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $book;

    /**
     *
     * factory model connection for testing
     */
    public function setUp(): void
    {
        parent::setUp();

        \Artisan::call('migrate');

        $books = factory(Book::class)->times(3)->create();
        $this->book = $books[0];
    }

}
