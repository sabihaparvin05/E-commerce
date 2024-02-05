<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function list()
    {
        $users = User::with('role')->get();
        return view('admin.pages.users.list', compact('users'));
    }

    public function create()
    {
        return view('admin.pages.users.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validate = Validator::make($request->all(), [
            'user_name' => 'required',
            'role' => 'required',
            'user_email' => 'required|email',
            'phone' => 'required|max:11',
            'address' => 'required',
            'user_password' => 'required|min:6',
        ]);

        if ($validate->fails()) {
            notify()->error('Give the Valid information.');
            return redirect()->back();
        }

        $fileName = null;
        if ($request->hasFile('user_image')) {
            // dd($request->all());
            $file = $request->file('user_image');
            $fileName = date('Ymdhis') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('/uploads', $fileName);
        }


        User::create([
            'name' => $request->user_name,
            'role_id'=>$request->role,
            'image' => $fileName,
            'phone' => $request->phone,
            'email' => $request->user_email,
            'address' => $request->address,
            'password' => bcrypt($request->user_password),
        ]);
        
        notify()->success('User created Successful.');
        return redirect()->route('users.list');
    }

    public function loginForm()
    {
        return view('admin.pages.loginForm');
    }

    public function loginPost(Request $request)
    {
        // dd($request->all());
        $validate = Validator::make($request->all(),[

            'email'=>'required|email',
            'password'=>'required|min:6',
        ]);

        if($validate->fails())
        {
            notify()->error('Invalid Credentials.');
            return redirect()->back();
        }

        $credentials=$request->except('_token');

        $login=auth()->attempt($credentials);
        if($login)
        {   
            notify()->success('Login Successful.');
            return redirect()->route('dashboard');
        }

        notify()->error('Invalid user email or password.');
        return redirect()->back();
    }

    public function logOut()
    {
        auth()->logout();
        return redirect()->route('admin.login');
    }
}
