<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        $order = Order::all();
        return view('order.index', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'invoice'=> 'required',
            'customer_name'=> 'required',
            'total'=> 'required',
            'status_order'=> 'required',
        ],
        [
            'customer_name.required' => 'Jangan lupa isi nama ya',
            'customer_name.min' => 'Nama minimal 5 huruf',
        ]
        );

    // perintah menyimpan data
    // return $request;
        Order::create([
            'invoice' => $request->invoice,
            'customer_name' => $request->customer_name,
            'total' => $request->total,
            'status_order' => $request->status_order,
        ]);
        return redirect('/order')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('order.edit',compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        Order::where('id',$order->id)->update([
            'invoice' => $request->invoice,
            'customer_name' => $request->customer_name,
            'total' => $request->total,
            'status_order' => $request->status_order,
        ]);

        return redirect('/order')->with('edit', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        Order::destroy($order->id);
        return redirect('/order')->with('delete', 'Data berhasil dihapus');
    }
}
