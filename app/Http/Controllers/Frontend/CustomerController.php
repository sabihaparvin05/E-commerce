<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Mail\sendOtp;
use App\Models\Customer;
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
        $user=Auth::guard('customerGuard')->user();
        return view('frontend.pages.customer.profile',compact ('user'));
    }

    public function profileEdit($userId)
    {
        $users = User::find($userId);
        return view('frontend.pages.customer.profileEdit', compact('users'));
    }

    public function profileUpdate(Request $request, $userId)
    {
        $users = User::find($userId);
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
            'password' => bcrypt($request->password),
            'image' => $fileName,
        ]);


        notify()->success('Updated successfully.');
        return redirect()->route('frontend.home');
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
            $customer->save();  // Save the changes to the database
    
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
}
