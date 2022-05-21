<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index')->with('categories',$categories);
    }
    public function create()
    {
        $categories = Category::all();
        return view('categories.create')->with('categories',$categories);
    }

    public function store(Request $request){
        $category = new Category();
        $category->name=$request->name;
        $category->description=$request->description;
        $category->slug=Str::slug($request->name);
        $category->parent_id=$request->parent_id;
        $category->save();
        return redirect('/categories')->with('success','Category Added');
    }
}
