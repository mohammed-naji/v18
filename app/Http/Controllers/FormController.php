<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsMail;
use App\Mail\TestMail;
use App\Rules\CheckWordsCount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    function form1() {
        return view('forms.form1');
    }

    function form1_data(Request $request) {
        // dd($_POST);
        dd($request->all());
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

    function form4() {
        return view('forms.form4');
    }

    function form4_data(Request $request) {
        $request->validate([
            'name' => 'required',
            'image' => ['required']
        ]);

        // dd($request->all());
        // mkdir()
        // $imgname = rand().time(). $request->file('image')->getClientOriginalName();
        $foledername = date('Y').'/'.date('m');
        foreach($request->image as $img) {
            $ex = $img->getClientOriginalExtension();
            $imgname = rand(0000000, 9999999).rand().'_'.rand().rand().rand().'_'.rand().'.'.$ex;
            $img->move(public_path('images/'.$foledername), $imgname);
        }
    }

    function contact() {
        return view('forms.contact');
    }

    function contact_data(Request $request) {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'image' => 'nullable|image|mimes:png,jpg',
            'message' => 'required',
        ]);

        $data = $request->except('_token', 'image');

        if ($request->hasFile('image')){
            $imgname = rand().time().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imgname);
            $data['image'] = $imgname;
        }

        // dd($data);

        Mail::to('mustafa.diouck2004@gmail.com')->send(new ContactUsMail($data));
    }
}


// domain => mohamednaji.com
// subdomain => test.mohamednaji.com
// subfolder => mohamednaji.com/test

//


// abc.png

// explode('.', 'abc.ddfds.rewr.png')
// $path = ['abc', 'png'];
// // $ex = $path[ count($path) - 1 ];
// $ex = end($path);

// mail();
// smtp

// gmail.com

// mailtrap

//
