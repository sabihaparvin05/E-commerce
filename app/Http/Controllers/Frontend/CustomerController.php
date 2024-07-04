<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Mail\sendOtp;
use App\Models\Order;
use App\Mail\resetLink;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function registration()
    {
        return view('frontend.pages.customer.registration');
    }

    public function profile()
    {
        $user = Auth::guard('customerGuard')->user();
        $orders=Order::all();
        return view('frontend.pages.customer.profile', compact('user','orders'));
    }

    public function profileEdit($userId)
    {
        $users = Customer::find($userId);
        return view('frontend.pages.customer.profileEdit', compact('users'));
    }

    public function profileUpdate(Request $request, $userId)
    {
        $users = Customer::find($userId);
        // dd($request->all());

        if ($users) {
            $fileName = $users->image;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = date('Ymdhis') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('/uploads', $fileName);
            }
        }
        $users->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' =>$request->address,
            'image' => $fileName,
        ]);


        notify()->success('Updated successfully.');
        return redirect()->back();
    }
    public function store(Request $request)
    {
        $role = Role::where('name', 'customer')->first();
        //dd($request->all());
        $otp = rand(10000, 99999);
        Customer::Create([
            'name' => $request->name,
            'email' => $request->email,
            //'role'=>'customer',
            //'phone'=>$request->phone,
            'password' => bcrypt($request->password),
            'otp' => $otp,
            'otp_expired_at' => Carbon::now()->addMinutes(5)
        ]);

        Mail::to($request->email)->send(new sendOtp($otp));

        notify()->success('Customer Registration successful.');
        return redirect()->route('showOtp.VerificationForm');
    }

    public function showOtpVerificationForm()
    {
        return view('frontend.pages.customer.otpForm');
    }

    public function verifyOtp(Request $request)
    {

        $request->validate([
            'otp' => 'required|numeric',
        ]);
        $code = $request->otp;
        $customer = Customer::where('otp', $code)->first();

        if ($customer) {
            // Check if OTP is expired
            if (Carbon::now()->gt($customer->otp_expired_at)) {
                // OTP expired
                return redirect()->back()->with('error', 'OTP has expired. Please try again.');
            }

            // OTP is valid and not expired
            $customer->is_verified = true;
            $customer->save();

            notify()->success('OTP verified successfully. You can now log in.');
            return redirect()->route('customer.login');
        } else {
            // Invalid OTP
            return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
        }
    }

    public function login()
    {
        return view('frontend.pages.customer.login');
    }

    public function loginPost(Request $request)
    {

        $val = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($val->fails()) {
            notify()->error($val->getMessageBag());
            return redirect()->back();
        }

        $credentials = $request->except('_token');
        // dd($credentials);

        if (auth('customerGuard')->attempt($credentials)) {
            $user = auth('customerGuard')->user();
            // dd($user);
            if ($user->is_verified) {

                notify()->success('Logged in Successfully');
                return redirect()->route('frontend.home');
            } else {
                auth('customerGuard')->logout();
                notify()->error('User not verified');
                return redirect()->route('customer.login');
            }
        }
        notify()->error('Invalid Credentials');
        return redirect()->back();
    }

    public function logout()
    {
        auth('customerGuard')->logout();
        notify()->success('Logout Successful');
        return redirect()->route('customer.login');
    }

    public function forgetPassword()
    {
        return view('frontend.pages.customer.resetEmailForm');
    }

    public function resetLink(Request $request)
    {
    
        $customer=Customer::where('email',$request->email)->first();
        $resetLink=Str::random(128);
        if($customer){
            Mail::to($request->email)->send(new resetLink($resetLink));
            return ('Reset link is sent to your mail');
        }else{
            notify()->error('Email not found');
            return redirect()->back();
        }

    }
    public function resetPasswordForm()
    {
        return view('frontend.pages.customer.resetPasswordForm');
    }
    public function updatePassword(Request $request, $token )
    {
        $validate= Validator::make($request->all(),[
            'new_password'=>'required|string|min:6|confirmed'
        ]);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate);
        }

        $customer=Customer::where('remember_token',$token)->first();

        if(!$customer){
            notify()->error('Invalid token');
            return redirect()->back();
        }
        $customer->update([
            'password' => bcrypt($request->new_password)
        ]);
        $customer->remember_token = null;
        $customer->save();

        return redirect()->route('customer.login')->with('success','Password updated successfully');
    }

}
