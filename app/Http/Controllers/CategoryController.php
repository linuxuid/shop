<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', Rule::unique('categories', 'name')],
            'slug' => ['required', Rule::unique('categories', 'slug')]
        ]);

        Category::create($attributes);

        return redirect()->route('admin.create')->with('success', 'your category has been added');
    }

    public function show()
    {

    }

    public function edit($id)
    {
        $categories = Category::find($id);

        return view('admin.edit', [
            'categories' => $categories
        ]);
    }

    public function editStore(Request $request, $id)
    {
        $attributes = $request->validate([
            'name' => ['required', 'min:5', 'max:255', Rule::unique('categories', 'name')],
            'slug' => ['required', 'min:5', 'max:255', Rule::unique('categories', 'slug')]
        ]);
        
        $categories = Category::whereId($id)->update($attributes);

        if($categories){
            return redirect()->route('admin.show', ['id' => 1])->with('success', 'your category has been changed');
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();

        return redirect()->route('admin.index')->with('success', 'category has been deleted');
    }
}
