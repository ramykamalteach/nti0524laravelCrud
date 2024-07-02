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
        $products = Product::orderBy('id')->paginate(3);
        
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 3);

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
        if($request->isActive == null){
            $product->isActive = 0;
        }
        else{
            $product->isActive = 1;
        }        


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
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        $request->validate([
            'productName' => 'required',
            'price' => 'required',
            'photo' => 'mimes:png,jpg,bmp',
        ], [
            'productName.required' => 'We need your product name من فضلك ادخل اسم المنتج',
            'price.required' => 'Please tell us price.',
        ]
        );

        $product->productName = $request->productName;
        $product->price = $request->price;
        if($request->isActive == null){
            $product->isActive = 0;
        }
        else{
            $product->isActive = 1;
        }

        if($request->photo != null){
            //not empty
            unlink(public_path('XproductImage') . '/' . $product->photo);
            $image = $request->file('photo');
            $imageName = time() . $request->photo->getClientOriginalName();
                        
            $image->move(public_path('XproductImage'), $imageName);
            $product->photo = $imageName;
        }

        $product->update();

        return redirect()->route('products.index')
                        ->with('success','Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        unlink(public_path('XproductImage') . '/' . $product->photo);
        $product->delete();

        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');

    }

    /* ----------------------------------------------------------------------------------- */

    public function isActive(Product $product)
    {
        if($product->isActive == 0){
            $product->isActive = 1;
        }
        else{
            $product->isActive = 0;
        }
        
        $product->save();    
        return redirect()->route('products.index')
                        ->with('success','Product Active Status Changed successfully');
    }

}
