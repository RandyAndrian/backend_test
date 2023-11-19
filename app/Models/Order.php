<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'payment_method_id','customer_address_id'];

    protected $primaryKey = 'id';

    protected $table = 'orders';

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getProductData()
    {
        $productData = [];

        foreach ($this->products as $product) {
            $productData[] = [
                'name' => $product->name,
                'price' => $product->price,
            ];
        }

        return $productData;
    }

    public function payment_methods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function getPaymentMethodData()
    {
        $paymentMethodData = [];

        foreach ($this->payment_methods as $payment) {
            $paymentMethodData[] = [
                'name' => $payment->name,
                'is_active' => $payment->is_active,
            ];
        }

        return $paymentMethodData;
    }
}
