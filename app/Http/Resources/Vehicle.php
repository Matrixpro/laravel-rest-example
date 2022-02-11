<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Vehicle extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        
        return [
            'id' => $this->vehicle_id,
            'type' => $this->type,
            'msrp' => $this->msrp,
            'year' => $this->year,
            'make' => $this->make,
            'model' => $this->model,
            'miles' => $this->miles,
            'vin' => $this->vin,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
