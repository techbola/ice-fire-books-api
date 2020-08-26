<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Repository\BookRepository;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookResourceCollection;
use App\Http\Resources\ExternalBookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{

    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    // Get books from external ice and fire api, sending a name query
    public function getExternalBook(Request $request)
    {
        $name = $request->name;
        $getBookDetails = $this->bookRepository->getExternalBookDetails($name);

        if (!$getBookDetails) {
            return response()->json([
                "status_code" => 200,
                "status" => "success",
                "data" => []
            ], 200);
        } else {
            return response()->json([
                "status_code" => 200,
                "status" => "success",
                "data" => new ExternalBookResource($getBookDetails)
            ], 200);
        }
    }

    // Create a new book in local database
    public function createBook(Request $request)
    {
        $newBook = $this->bookRepository->saveBook($request->all());

        if ($newBook) {
            return response()->json([
                "status_code" => 201,
                "status" => "success",
                "data" => new BookResource($newBook)
            ], 201);
        } else {
            return response()->json([
                "status" => "success",
                "message" => "Something went wrong."
            ], 400);
        }
    }

    // Get all books from local database
    public function books()
    {
        $books = $this->bookRepository->getBooks();

        if (!$books) {
            return response()->json([
                "status_code" => 200,
                "status" => "success",
                "data" => []
            ], 200);
        } else {
            return response()->json([
                "status_code" => 200,
                "status" => "success",
                "data" => new BookResourceCollection($books)
            ], 200);
        }
    }

    // Update a book from local database
    public function updateBook(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $bookUpdated = $this->bookRepository->updateBook($request->all(), $id);

        if ($bookUpdated) {
            return response()->json([
                "status_code" => 200,
                "status" => "success",
                "message" => "The book $book->name was updated successfully",
                "data" => new BookResource($bookUpdated)
            ], 200);

        } else {
            return response()->json([
                "status" => "success",
                "message" => "Something went wrong."
            ], 400);
        }
    }

    // Delete a book from local database
    public function deleteBook($id)
    {
        $book = Book::find($id);
        $bookDeleted = $this->bookRepository->deleteBook($id);
        if ($bookDeleted) {
            return response()->json([
                "status_code" => 204,
                "status" => "success",
                "message" => "The book $book->name was deleted successfully",
                "data" => []
            ], 204);
        } else {
            return response()->json([
                "status" => "success",
                "message" => "Something went wrong."
            ], 400);
        }
    }

    // show a book from local database
    public function showBook($id)
    {
        $book = $this->bookRepository->showBook($id);

        if ($book) {
            return response()->json([
                "status_code" => 200,
                "status" => "success",
                "data" => new BookResource($book)
            ], 200);

        } else {
            return response()->json([
                "status" => "success",
                "message" => "Something went wrong."
            ], 400);
        }
    }


}
