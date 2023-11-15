<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::get();

        foreach ($orders as $order) {
            $customer_address = CustomerAddress::where('id', $order->customer_address_id)->first();
            $customer = Customer::where('id', $customer_address->customer_id)->first();
            $product = Product::where('id', $order->product_id)->first();
            $payment = PaymentMethod::where('id', $order->payment_id)->first();

            $data[] = [
                'id' => $order->id,
                'customer' => $customer->customer_name ?? null,
                'product' => $product->name ?? null,
                'payment_method' => $payment->name ?? null,
                'customer_address' => $customer_address->address ?? null,
            ];
        }

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $validated = $request->validate([
        'product_id' => 'required',
          'payment_id' => 'required',
          'customer_address_id' => 'required'
       ]);

       $order = new Order();

       $order->product_id = $request->product_id;

       $order->payment_id = $request->payment_id;

       $order->customer_address_id = $request->customer_address_id;

       $order->save();

       return new OrderResource($order);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        $order->product_id = $request->product_id;

        $order->payment_id = $request->payment_id;

        $order->customer_address_id = $request->customer_address_id;

        $order->save();

        return new OrderResource($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        $order->delete();

        return response()->json(["message" => "Data order telah di hapus"]);
    }
}
