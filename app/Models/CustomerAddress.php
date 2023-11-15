<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'address'];

    protected $primaryKey = 'id';

    protected $table = 'customer_addresses';

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
