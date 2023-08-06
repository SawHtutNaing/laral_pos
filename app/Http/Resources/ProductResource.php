<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return [
        //     'name' => $this->name,
        //     'branch_id' => $this->branch_id,
        //     'actually_price' => $this->actually_price,
        //     'sales_price' => $this->sales_price,
        //     'total_stock' => $this->total_stock,
        //     'unit' => $this->unit,
        //     'more_information' => $this->more_information,
        //     'user_id' => $this->user_id,
        //     'photo' => $this->photo,

        // ];
        return parent::toArray($request);
    }
}
