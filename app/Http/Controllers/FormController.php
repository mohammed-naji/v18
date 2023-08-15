<?php

namespace App\Http\Controllers;

use App\Rules\CheckWordsCount;
use Illuminate\Http\Request;

class FormController extends Controller
{
    function form1() {
        return view('forms.form1');
    }

    function form1_data(Request $request) {
        // dd($_POST);
        // dd($request->all());
        // dd($request->except('_token'));
        // dd($request->only('_token', 'email'));

        $email = $request->email;
        $password = $request->password;

        return "Email : $email, <br> Password : $password";
    }

    function user() {
        return view('forms.user');
    }

    function user_data(Request $request) {
        $name = $request->name;
        $age = $request->age;

        return view('forms.user_data', compact('name', 'age'));
    }


    function form2() {
        return view('forms.form2');
    }

    function form2_data(Request $request) {
        $request->validate([
            'first_name' => 'required|min:3|max:20',
            'last_name' => 'required|min:3|max:20',
            'email' => 'required|ends_with:@gmail.com',
            'password' => 'required|confirmed'
        ]);

        dd($request->all());
    }

    function form3() {
        return view('forms.form3');
    }

    function form3_data(Request $request) {
        // now()->subYears(18)
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'dob' => 'required|before:-18 years',
            'gender' => 'required',
            'education_level' => 'required',
            'hobbies' => 'required',
            'bio' => ['required', new CheckWordsCount(20)],
        ], [
            'name.required' => 'الحقل مطلووووووب'
        ]);

        dd($request->all());
    }

}
