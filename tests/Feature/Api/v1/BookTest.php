<?php

namespace Tests\Feature\Api\v1;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class BookTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Returns data from external api.
     *
     * @return void
     */
    /** @test */
    public function it_returns_data_from_External_api()
    {
        $query = "A Game of Thrones";
        $response = $this->getJson("/api/external-books/?name=$query");
        $response->assertStatus(JsonResponse::HTTP_OK);

    }

    /**
     * Returns success when creating a book.
     *
     * @return void
     */
    /** @test */
    public function it_returns_success_when_creating_a_book()
    {
        $data = [
            'name' => 'Bola',
            'isbn' => '123-456',
            'authors' => 'Ade, Bola',
            'number_of_pages' => 10,
            'publisher' => 'Bola Publisher',
            'country' => 'Nigeria',
            'release_date' => '2020-08-25',
        ];

        $response = $this->postJson('/api/v1/books', $data);
        $response->assertStatus(JsonResponse::HTTP_CREATED)
            ->assertJson(["status_code" => JsonResponse::HTTP_CREATED]);
    }

    /**
     * Returns success when creating a book.
     *
     * @return void
     */
    /** @test */
    public function it_does_not_create_when_validation_fails()
    {
        $data = [];

        $response = $this->postJson('/api/v1/books', $data);
        $response->assertStatus(JsonResponse::HTTP_BAD_REQUEST);
    }

    /**
     * Returns success when fetching all books.
     *
     * @return void
     */
    /** @test */
    public function it_returns_success_when_getting_all_books()
    {
        $response = $this->getJson('/api/v1/books');
        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(["status_code" => JsonResponse::HTTP_OK]);
    }

    /**
     * Returns success when a single book is fetched.
     *
     * @return void
     */
    /** @test */
    public function it_returns_single_book_when_fetched()
    {
        $response = $this->getJson('/api/v1/books/' . $this->book->id);
        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(["status_code" => JsonResponse::HTTP_OK]);
    }

    /**
     * Returns success when a book is updated.
     *
     * @return void
     */
    /** @test */
    public function it_returns_success_when_book_is_updated()
    {
        $data = [
            'name' => 'Bola',
            'isbn' => '123-456',
            'authors' => 'Ade, Bola',
            'number_of_pages' => 10,
            'publisher' => 'Bola Publisher',
            'country' => 'Nigeria',
            'release_date' => '2020-08-25',
        ];

        $response = $this->patchJson('/api/v1/books/' . $this->book->id, $data);
        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(["status_code" => JsonResponse::HTTP_OK]);
    }

}
