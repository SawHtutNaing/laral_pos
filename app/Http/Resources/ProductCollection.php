<?php

namespace App\Http\Resources;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($this->collection);
        // dd(
        //     $this->collection

        // );
        try {
            return [
                'products' => $this->collection,
            ];
        } catch (Exception $e) {
            return $e;
        }
    }
}
