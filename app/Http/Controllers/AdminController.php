<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket;

class AdminController extends Controller
{
    public function create(Request $request)
    {
        return view('admin.create');
    }
}
