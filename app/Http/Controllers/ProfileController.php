<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::all();
        return view('profile.index')->with('profile', $profile);
    }

    public function create()
    {
        return view('profile.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'user_id' => 'in:' . auth()->user()->id,
            'title' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
            'address' => ['required', 'max:255'],
            'comment' => ['required', 'max:255']
        ]);
        // $attributes['user_id'] = auth()->id();

        $profile = Profile::create($attributes);
        
        if($profile){
            return redirect()->route('personal.create')->with('success', 'your profile has been added');
        }
    }

    /** 
     * This show user data in profile
     */
    public function showUserData()
    {
        return view('profile.show');
    }

    /** This update user data in profile
     * @param Request
     */
    public function updateUserData(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|min:5|max:20',
            'username' => ['required'],
            'email' => ['required', Rule::unique('users', 'email')],
            'phone' => 'required',
            'address' => 'required|max:255',
        ]);

        $users = User::whereId(auth()->user()->id)->update($attributes);

        if($users){
            return redirect()->route('personal.show')->with('success', 'your user profile has been changed');
        }
    }

    /** This show profile 
     * @param Profile
     */
    public function showProfile()
    {
        return view('profile.shower');
    }

    /** This update profile data
     * @param Request
     * @param Profile
     */
    public function updateProfileData(Request $request, Profile $profile)
    {
        $request->validate([
            'user_id' => 'in:' . auth()->user()->id,
            'title' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
            'address' => ['required', 'max:255'],
            'comment' => ['required', 'max:255']
        ]);

        $profile->update($request->all());
        return redirect()->route('personal.show.profile')->with('success', 'your user profile has been changed');
    }
}
