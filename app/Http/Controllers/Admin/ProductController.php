<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('products.index')->with('products',$products);;
    }
}
