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
        return view('categories.index')->with('categories', $categories);
    }
    public function create()
    {
        $categories = Category::all();
        $category = new Category();
        return view('categories.create',
            [
                'category' => $category,
                'categories' => $categories,
            ]);
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());
        //$category = new Category();
        // $category->name=$request->name;
        // $category->description=$request->description;
        // $category->slug=Str::slug($request->name);
        // $category->parent_id=$request->parent_id;
        // $category->save();
        $request['slug'] = Str::slug($request->name);
        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category Added');

    }
    public function edit($id)
    {
        $category   = Category::findOrFail($id);
        $categories = Category::where('id', '<>', $id)->get();
        return view('categories.edit', compact('category', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = Str::slug($request->name);
        $category->parent_id = $request->parent_id;
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Category Updated');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category Deleted');
    }
    protected function rules()
    {
        return [
            'name'=>['required','min:2'],
            'description'=>['required']
        ];

    }

}
