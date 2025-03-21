<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function privacyPolicy()
    {
        return view('sob-offers.privacy');
    }
}
