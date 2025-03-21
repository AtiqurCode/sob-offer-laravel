<?php

namespace App\Http\Controllers;

use App\Models\SobOffer;
use App\Models\Category;
use Illuminate\Http\Request;

class SobOfferController extends Controller
{
    public function index()
    {
        $offers = SobOffer::with(['category:id,name', 'tags:id,name'])->latest()->get();
        $categories = Category::all();

        return view('sob-offers.index', compact('offers', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'string',
            'offer_start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:offer_start_date',
            'category_id' => 'required|exists:categories,id',
            'terms_conditions' => 'nullable|string',
            'special_note' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            'tags' => 'nullable|string',
        ]);


        $offer = SobOffer::create($validatedData);

        if ($request->hasFile('featured_image')) {
            $offer->addMediaFromRequest('featured_image')
                  ->toMediaCollection('featured_image');
        }

        if ($request->tags) {
            $offer->syncTags(array_map('trim', explode(',', $request->tags)));
        }

        return redirect()->route('sob-offers.index')->with('message', 'Offer created successfully.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'string',
            'offer_start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:offer_start_date',
            'category_id' => 'required|exists:categories,id',
            'terms_conditions' => 'nullable|string',
            'special_note' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'tags' => 'nullable|string',
        ]);

        $offer = SobOffer::findOrFail($id);
        $offer->update($validatedData);

        if ($request->hasFile('featured_image')) {
            $offer->clearMediaCollection('featured_image');
            $offer->addMediaFromRequest('featured_image')
                  ->toMediaCollection('featured_image');
        }

        if ($request->tags) {
            $offer->syncTags(array_map('trim', explode(',', $request->tags)));
        }

        return redirect()->route('sob-offers.index')->with('message', 'Offer updated successfully.');
    }

    public function destroy($id)
    {
        SobOffer::findOrFail($id)->delete();
        return redirect()->route('sob-offers.index')->with('message', 'Offer deleted successfully.');
    }
}
