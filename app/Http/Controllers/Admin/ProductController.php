<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $products = Product::with('category')->get();
        return view(
            'products.index',
            ['products' => $products]
        );
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
        $tags = Tag::all();
        return view('products.create', [
            'categories' => $categories,
            'product' => $product,
            'tags' => $tags
        ]);
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
        if ($request->hasFile('image')) {
            //           $imageName = $image->getClientOriginalName();
            //           $imageExt = $image->getClientOriginalExtension();
            //           $image->storeAs('products','mm.png','public');
            $image_url = $image->store('products', 'public');
            $data['image'] = $image_url;
        }
        $product = Product::create($data);


        //multiple images
        $images = $request->file('images');
        foreach ($images as $image) {
            if ($image->isValid()) {
                $imageUrl = $image->store('products', 'public');
                $product->images()->create([
                    'path_image' => $imageUrl
                ]);
            }
        }



        if ($request->tags) {
            $tags = explode(',', $request->tags);
            foreach ($tags as $item) {
                $tag = Tag::where('name', $item)->first();
                if (!$tag) {
                    $tag = Tag::create([
                        'name' => $item,
                        'slug' => Str::slug($item)
                    ]);
                }
                DB::table('product_tag')->insert(
                    [
                        'product_id' => $product->id,
                        'tag_id' => $tag->id
                    ]
                );
            }
        }
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
        $categories = Category::all();

        $tags = Tag::all();
        return view(
            'products.edit',
            [
                'categories' => $categories,
                'product' => $product,
                'tags' => $tags
            ]
        );
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
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

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
