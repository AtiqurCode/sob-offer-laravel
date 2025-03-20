<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SobOffer;

class WelcomeController extends Controller
{
    public function index()
    {
        $offers = SobOffer::with(['category:id,name', 'tags:id,name'])->latest()->get();

        return view('welcome', compact('offers'));
    }

    public function show($uuid)
    {
        $offer = SobOffer::with(['category:id,name', 'tags:id,name'])->where('uuid',$uuid)->first(); // Use findOrFail to handle invalid IDs
        return view('offer-details', compact('offer'));
    }
}
