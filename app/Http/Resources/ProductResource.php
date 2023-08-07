<?php

namespace App\Http\Resources;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        // return "dd";
        return [
            'new_product_info' =>  parent::toArray($request)['model1'],
            'new_created_stock_info' =>  parent::toArray($request)['model2']

        ];
    }
};
