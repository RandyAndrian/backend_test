<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'payment_id', 'customer_address_id'];

    protected $primaryKey = 'id';

    protected $table = 'orders';

    public function product()
    {
        return $this->hasMany('App\Model\Product', 'id', 'product_id');
    }

    public function payment()
    {
        return $this->hasMany('App\Model\Payment', 'id', 'payment_id');
    }

    public function customerAddress()
    {
        return $this->hasMany('App\Model\CustomerAddress', 'id', 'customer_address_id');
    }
}
