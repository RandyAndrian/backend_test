<?php

namespace App\Http\Resources;

use App\Models\Customer;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $customer_name = Customer::where('id', $this->customer_id)->first();

        return [
            'id' => $this->id,
            'customer_id' => $customer_name->customer_name,
            'address' => $this->address,
        ];
    }
}
