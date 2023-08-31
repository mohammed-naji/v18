<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    function users() {
        // Eager Load
        $users = User::with('profile')->get();
        // dd($users);

        // Lazy Load
        // $user = User::find(1);

        // $user->load('profile');
        return view('relations.users',compact('users'));
    }

    function profile($id) {
        $profile = Profile::with('user')->find($id);

        dd($profile->user->name);
    }
}
