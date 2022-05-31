<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();
        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $product = new Product();
        return view('products.create', ['categories' => $categories
            , 'product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate($this->rules());
        $image = $request->file('image');
        $data = $request->all();
        if ($image->isValid()) {
//           $imageName = $image->getClientOriginalName();
//           $imageExt = $image->getClientOriginalExtension();
//           $image->storeAs('products','mm.png','public');
            $image_url = $image->store('products', 'public');
            $data['image'] = $image_url;
        }
        Product::create($data);
        return redirect()->route('products.index')
            ->with('success', 'Product Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        $categories=Category::all();
        //
        return view('products.edit',['categories'=>$categories,'product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $request->validate($this->rules());
        $data = $request->all();
        $image = $request->file('image');
        if ($image->hasFile()) {
             $image_url = $image->store('products', 'public');
             $data['image'] = $image_url;
             Storage::disk('public')->delete($product->image);
             }
               //       $imageName = $image->getClientOriginalName();
            //      $imageExt = $image->getClientOriginalExtension();
            //       $image->storeAs('products','mm.png','public');
             $product->update($data);
             return redirect()->route('products.index')
            ->with('success', 'Product Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        Storage::disk('public')->delete($product->image);
        return redirect()->route('products.index')
        ->with('success', 'Product Deleted');
    }

    protected function rules()
    {
        return [
            'title' => ['required', 'max:200'],
            'description' => ['required', 'string'],
            'image' => 'nullable|mimes:jpg,bmp,png',
            'category_id' => 'required|exists:categories,id',
            'cost' => 'required|numeric',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
        ];
    }
}
