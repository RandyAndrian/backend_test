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
        $product = Product::where('id', $this->product_id)->first();
        $payment = PaymentMethod::where('id', $this->payment_id)->first();
        $customer_address = CustomerAddress::where('id', $this->customer_address_id)->first();
        $customer = Customer::where('id', $customer_address->customer_id)->first();

        return [
            'id' => $this->id,
            'customer' => $customer->name ?? null,
            'product' => $product->name ?? null,
            'payment' => $payment->name ?? null,
            'customer_address' => $customer_address->address ?? null,
        ];
    }
}
