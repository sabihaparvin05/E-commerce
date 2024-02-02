<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function registration()
    {
        return view('frontend.pages.customer.registration');
    }

    public function profile()
    {
        return view('frontend.pages.customer.profile');
    }


    public function store(Request $request)
    {

    //dd($request->all());
    User::Create([
        'name'=>$request->name,
        'email'=>$request->email,
        'role'=>'customer',
        'phone'=>$request->phone,
        'password'=>bcrypt($request->password),
    ]);

    notify()->success('Customer Registration successful.');
    return redirect()->back();
    }  
    

    public function login()
    {
        return view('frontend.pages.customer.login');
    }


    public function loginPost(Request $request){

        $val=Validator::make($request->all(),[
            'email'=>'required',
            'password'=>'required',
        ]);

        if($val->fails())
        {
            notify()->error($val->getMessageBag());
            return redirect()->back();
        }

        $credentials=$request->except('_token');
        // dd($credentials);

        if(auth()->attempt($credentials))
        {
            notify()->success('Login Successfull.');
            return redirect()->route('frontend.home');
        }

        notify()->error('Invalid Credentials.');
            return redirect()->back();


    }


    public function logout()
    {
        auth()->logout();
        notify()->success('Logout Successfull.');    
        return redirect()->route('frontend.home');
    } 
}
