<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerAddressResource;
use App\Models\Customer;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;

class CustomerAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = CustomerAddress::get();

        foreach ($customers as $customer) {
            $customer_name = Customer::where('id', $customer->customer_id)->first();

            $data[] = [
                'id' => $customer->id,
                'customer' => $customer_name->customer_name ?? null,
                'address' => $customer->address,
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
            'customer_id' => 'required',
            'address' => 'required'
        ]);

        $customer = new CustomerAddress();

        $customer->customer_id = $request->customer_id;
        $customer->address = $request->address;

        $customer->save();

        return new CustomerAddressResource($customer);
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
        $customer = CustomerAddress::find($id);

        $customer->customer_id = $request->customer_id;
        $customer->address = $request->address;

        $customer->save();

        return new CustomerAddressResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = CustomerAddress::find($id);

        $customer->delete();

        return response()->json(["message" => "Data customer address telah di hapus"]);
    }
}
