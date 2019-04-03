<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $user->posts = $user->posts()->paginate(10);

        return view('profile.show')->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'profile_picture' => 'required'
        ]);

        if (auth()->user()->id !== $user->id) {
            return redirect("/profile/$id")->with('error', 'Unauthorized Edit');
        }

        $allowedProfilePicture = array_map(function($src){
            return "https://i.imgur.com/$src";
        },['UU8DI2g.jpg', 'l0o31Tn.png', '6a0LF3N.jpg', 'caHQ0Ht.png','OqJb76V.jpg', 'qWouajd.jpg', 'cyWrrAA.jpg']);

        if (in_array($request->input('profile-picture'), $allowedProfilePicture)){
            return redirect("/profile/$id")->with('error', 'Unauthorized Profile Picture');
        }

        $user->name = $request->input('name');
        $user->profile_picture = $request->input('profile_picture');
        $user->save();

        return redirect("/profile/$id")->with('success', 'Profile Edited');
    }
}
