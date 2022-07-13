<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $parentCategories = Category::all();
        $categories = Category::when($request->name, function ($query, $value) {
            $query->where("name", "LIKE", "%$value%");
        })->when($request->parent_id, function ($query, $value) {
            $query->where('parent_id', $value);
        })->with('parent', 'children')->paginate(10);
        return view('categories.index', ['parentCategories' => $parentCategories, 'categories' => $categories]);
    }

    public function show(Category $category)
    {
        //$category = Category::with('children', 'parent');
        $products = $category->products;
        return view(
            'categories.show',
            [
                'category' => $category,
                'products' => $products
            ]
        );
    }

    public function create()
    {
        $categories = Category::all();
        $category = new Category();
        return view(
            'categories.create',
            [
                'category' => $category,
                'categories' => $categories,
            ]
        );
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
            'name' => ['required', 'min:2'],
            'description' => ['required']
        ];
    }
}
