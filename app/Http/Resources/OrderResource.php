<?php

namespace App\Http\Resources;

use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\PaymentMethod;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $customer_address = CustomerAddress::where('id', $this->customer_address_id)->first();
        $customer_name = Customer::where('id', $customer_address->customer_id)->first();

        return [
            'id' => $this->id,
            'customer_name' => $customer_name->customer_name,
            'customer_address' => $customer_address->address,
            'product' => $this->getProductData(),
            'payment_method' => $this->getPaymentMethodData(),
        ];
    }
}
