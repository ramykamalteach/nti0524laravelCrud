<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view("products.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("products.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'productName' => 'required',
            'price' => 'required',
            'photo' => 'required|image',
        ], [
            'productName.required' => 'We need your product name من فضلك ادخل اسم المنتج',
            'price.required' => 'Please tell us price.',
        ]
        );

        //Product::create($request->all());

        $image = $request->file('photo');
        $imageName = time() . $request->photo->getClientOriginalName();
        $request->photo = $imageName;
        
        $image->move(public_path('XproductImage'), $imageName);

        $product = new Product();
        $product->productName = $request->productName;
        $product->price = $request->price;
        $product->photo = $imageName;

        $product->save();

        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
