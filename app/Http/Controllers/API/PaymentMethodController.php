<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMethodResource;
use App\Models\PaymentMethod;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = PaymentMethod::get();

        foreach ($payments as $payment) {
            $data[] = [
                'id' => $payment->id,
                'name' => $payment->name,
                'is_active' => $payment->is_active,
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
            'name' => 'required',
            'is_active' => 'required'
        ]);

        $payment = new PaymentMethod();

        $payment->name = $request->name;
        $payment->is_active = $request->is_active;

        $payment->save();

        return new PaymentMethodResource($payment);
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
        $payment = PaymentMethod::find($id);

        $validated = $request->validate([
            'name' => 'required',
            'is_active' => 'required'
        ]);

        $payment->name = $request->name;
        $payment->is_active = $request->is_active;

        $payment->save();

        return new PaymentMethodResource($payment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = PaymentMethod::find($id);

        $payment->delete();

        return response()->json(["message" => "Data metode pembayaran telah di hapus"]);
    }
}
