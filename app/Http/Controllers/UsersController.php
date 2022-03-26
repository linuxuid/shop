<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function show($id)
    {
        $users = User::find($id);

        return view('admin.users.edit', [
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', Rule::unique('users', 'username')],
            'email' => ['required', 'email'],
        ]);

        $users = User::whereId($id)->update($attributes);

        if($users){
            return redirect('/control/users/1')->with('success', 'account has been changed');
        }
    }

}
