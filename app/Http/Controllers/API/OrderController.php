<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function store(Request $request)
    {
           $order = Order::create([
                'customer_address_id' => $request->input('customer_address_id'),
            ]);

            $products = $request->input('products', []);

            foreach ($products as $product) {
                $order->products()->create([
                    'name' => $product['name'],
                    'price' => $product['price'],
                ]);
            }

            $payment_methods = $request->input('payment_methods', []);

            foreach ($payment_methods as $payment) {
                $order->payment_methods()->create([
                    'name' => $payment['name'],
                    'is_active' => $payment['is_active'],
                ]);
            }

            return new OrderResource($order);
    }

    public function show($id)
    {
    $order = Order::with('products')->find($id);

    if (!$order) {
        return response()->json(['message' => 'Order not found'], 404);
    }

    return new OrderResource($order);
   }

}
