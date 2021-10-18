<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EbooksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'author' => $this->author,
            'page' => $this->page,
             'description' => $this->description,
            'image' => asset('assets/img/book_images').'/'.$this->image,
            'category_id' => $this->category_id,
        ];
    }
}
