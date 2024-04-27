@extends('frontend.master')
@section('content')

<form action="{{ route('verifyOtp') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="otp">Enter OTP:</label>
        <input type="text" id="otp" name="otp" class="form-control" placeholder="Enter OTP">
        @error('otp')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Verify OTP</button>
</form>

@endsection
