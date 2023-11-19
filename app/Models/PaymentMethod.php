<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'is_active'];

    protected $table = 'payment_methods';

    public function order()
    {
        return $this->belongsTo(Order::class, 'payment_method_id', 'id');
    }

}
