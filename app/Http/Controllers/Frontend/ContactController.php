<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\myEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendEmail()
    {
        Mail::to('sabihajui10@gmail.com')->send(new myEmail());
        return "Email sent successfully!";
    }
}
