<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class HomePageController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function catalog()
    {
        $category = Category::all();

        return view('home.catalog', [
            'categories' => $category
        ]);
    }

    public function subCatalog($id)
    {
        $category = Category::find($id);

        return view('home.subcatalog', [
            'categories' => $category
        ]);
    }
}
