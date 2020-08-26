<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ExternalBookResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
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
            'authors' => $data['authors'],
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
}
