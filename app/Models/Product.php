<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'price'];

    protected $primaryKey = 'id';

    protected $table = 'products';

    public function order()
    {
        return $this->belongsTo(Order::class, 'product_id', 'id');
    }

}
