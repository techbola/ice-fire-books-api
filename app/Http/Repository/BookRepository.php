<?php


namespace App\Http\Repository;
use App\Book;
use Illuminate\Support\Facades\Http;

class BookRepository
{

    // Get external book with name supplied
    public function getExternalBookDetails($bookName)
    {
        $response = Http::get('https://www.anapioficeandfire.com/api/books', [
            'name' => $bookName
        ]);

        return $response->json();
    }

    // Save new book in local database operation
    public function saveBook($bookData)
    {
        return Book::create($bookData);
    }

    // Get all books from local database operation
    public function getBooks()
    {
        return Book::all();
    }

    // Update a Book record in the local database operation
    public function updateBook($bookData, $id)
    {
        $book = Book::findOrFail($id);
        if ($book->update($bookData)){
            return $book;
        }
    }

    // Delete a Book record in the local database operation
    public function deleteBook($id)
    {
        $book = Book::findOrFail($id);
        return $book->delete();
    }

    // show a Book record in the local database operation
    public function showBook($id)
    {
        return Book::findOrFail($id);
    }

}