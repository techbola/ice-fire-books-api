<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'isbn' => $this->isbn,
            'authors' => $this->formatAuthor($this->authors),
            'country' => $this->country,
            'number_of_pages' => $this->number_of_pages,
            'publisher' => $this->publisher,
            'release_date' => $this->release_date,
        ];
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
