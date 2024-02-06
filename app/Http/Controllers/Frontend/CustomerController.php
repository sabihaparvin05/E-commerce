<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Role;
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

    public function profileEdit($userId)
    {
        $users=User::find($userId);
        return view('frontend.pages.customer.profileEdit',compact('users'));
    }

    public function profileUpdate(Request $request, $userId)
    {
        $users=User::find($userId);
        // dd($request->all());

        if($users)
        {
            $fileName=$users->image;

            if($request->hasFile('image'))
            {
              $file=$request->file('image');
              $fileName=date('Ymdhis').'.'.$file->getClientOriginalExtension();
              $file->storeAs('/uploads',$fileName);

            }
        }
        $users->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>bcrypt($request->password),
            'image'=>$fileName,
        ]);

     notify()->success('Updated successfully.');
    return redirect()->route('frontend.home');

    }
    public function store(Request $request)
    {
        $role = Role::where('name', 'customer')->first();
    //dd($request->all());
    User::Create([
        'name'=>$request->name,
        'email'=>$request->email,
        'role_id'=>$role->id,
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
