<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($data) {
            return $this->transformData($data);
        })->toArray();
    }

    private function transformData($data)
    {
        return [
            'name' => $data['name'],
            'isbn' => $data['isbn'],
            'authors' => $this->formatAuthor($data['authors']),
            'number_of_pages' => $data['numberOfPages'],
            'publisher' => $data['publisher'],
            'country' => $data['country'],
            'release_date' => self::formatStringToDate($data['released']),
        ];
    }

    public function formatStringToDate($date)
    {
        return date('Y-m-d', strtotime($date));
    }

    public function formatAuthor($authors)
    {
        if (!empty($authors)) {
            $book_authors = explode(',', $authors);
            $new_authors = [];
            foreach ($book_authors as $book_author){
                array_push($new_authors, $book_author);
            }
        } else {
            $new_authors = [];
        }
        return $new_authors;
    }
}
