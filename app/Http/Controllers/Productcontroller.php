<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class Productcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return view('product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'name'=> 'required|min:5|max:20',
            'price'=> 'required|numeric'
        ],
        [
            'name.required' => 'Jangan lupa isi nama ya',
            'name.min' => 'Nama produk minimal 5 huruf',
        ]
        );

    // perintah menyimpan data
    // return $request;
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);
        return redirect('/product')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
            // return $request;
            $request->validate([
                'name'=> 'required|min:5|max:20',
                'price'=> 'required|numeric'
            ],
            [
                'name.required' => 'Jangan lupa isi nama ya',
                'name.min' => 'Nama makanan minimal 5 huruf',
            ]);
    
            Product::where('id',$product->id)->update([
                'name' => $request->name,
                'price' => $request->price,
            ]);
    
            return redirect('/product')->with('edit', 'Data berhasil diedit');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        return redirect('/product')->with('delete', 'Data berhasil dihapus');
    }
}
