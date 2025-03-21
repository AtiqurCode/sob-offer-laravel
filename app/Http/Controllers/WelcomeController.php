<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SobOffer;

class WelcomeController extends Controller
{
    public function index()
    {
        $offers = SobOffer::with(['category:id,name'])
            ->select('id', 'uuid', 'title', 'offer_start_date', 'end_date', 'category_id')
            ->latest()
            ->get();


        $offers = $offers->map(function ($offer) {
            $offer->featured_image_url = $offer->getFirstMediaUrl('featured_image', 'thumb') ?? asset('images/default.png'); // Get image URL

            return $offer;
        });

        return view('welcome', compact('offers'));
    }

    public function show($uuid)
    {
        $offer = SobOffer::with(['category:id,name', 'tags:id,name'])->where('uuid',$uuid)->first(); // Use findOrFail to handle invalid IDs
        return view('offer-details', compact('offer'));
    }
}
