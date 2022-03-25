<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function create()
    {
        return view('admin.product.index');        
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'slug' => ['required', 'max:255', 'min:10'],
            'title' => ['required', 'max:255', 'min:10'],
            'price' => 'required',
            'body' => ['required', 'max:300', 'min:10'],
            'category_id' => 'required'
        ]);

        $product = Product::create($attributes);

        if($product){
            return redirect()->route('admin.product.create')->with('success', 'your category has been changed');
        }

    }

    public function show()
    {

    }

    public function edit($id)
    {
        $products = Product::find($id);

        return view('admin.product.edit', [
            'products' => $products
        ]);
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->validate([
            'slug' => ['required', Rule::unique('products', 'slug')],
            'title' => ['required'],
            'price' => ['required'],
            'body' => ['required'],
            'category_id' => 'required'
        ]);

        $products = Product::whereId($id)->update($attributes);

        if($products){
            return redirect()->route('admin.product.edit', ['id' => 1])->with('success', 'your category has been changed');
        }
    }

}
