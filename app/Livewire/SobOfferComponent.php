<?php

namespace App\Http\Livewire;

use App\Models\SobOffer;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;


class SobOfferComponent extends Component

{
    // use WithFileUploads;

    // public $title, $description, $offer_start_date, $end_date, $category_id, $terms_conditions, $special_note;
    // public $featured_image;
    // public $tags;
    // public $offerId;
    // public $offers, $categories;

    // public function mount()
    // {
    //     $this->offers = SobOffer::with('category')->latest()->get();
    //     $this->categories = Category::all();
    // }

    // public function store()
    // {
    //     $validatedData = $this->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required',
    //         'offer_start_date' => 'required|date',
    //         'end_date' => 'required|date|after_or_equal:offer_start_date',
    //         'category_id' => 'required|exists:categories,id',
    //         'terms_conditions' => 'nullable|string',
    //         'special_note' => 'nullable|string',
    //         'featured_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    //         'tags' => 'nullable|string',
    //     ]);

    //     $offer = SobOffer::create($validatedData);

    //     if ($this->featured_image) {
    //         $offer->addMedia($this->featured_image->getRealPath())
    //               ->toMediaCollection('featured_image');
    //     }

    //     if ($this->tags) {
    //         $offer->attachTags(explode(',', $this->tags));
    //     }

    //     session()->flash('message', 'Offer created successfully.');

    //     return redirect()->route('sob-offer.index');
    // }

    // public function edit($id)
    // {
    //     $offer = SobOffer::findOrFail($id);
    //     $this->offerId = $offer->id;
    //     $this->title = $offer->title;
    //     $this->description = $offer->description;
    //     $this->offer_start_date = $offer->offer_start_date;
    //     $this->end_date = $offer->end_date;
    //     $this->category_id = $offer->category_id;
    //     $this->terms_conditions = $offer->terms_conditions;
    //     $this->special_note = $offer->special_note;
    //     $this->tags = implode(',', $offer->tags->pluck('name')->toArray());
    // }

    // public function update()
    // {
    //     $offer = SobOffer::findOrFail($this->offerId);
    //     $offer->update([
    //         'title' => $this->title,
    //         'description' => $this->description,
    //         'offer_start_date' => $this->offer_start_date,
    //         'end_date' => $this->end_date,
    //         'category_id' => $this->category_id,
    //         'terms_conditions' => $this->terms_conditions,
    //         'special_note' => $this->special_note,
    //     ]);

    //     if ($this->featured_image) {
    //         $offer->clearMediaCollection('featured_image');
    //         $offer->addMedia($this->featured_image->getRealPath())
    //               ->toMediaCollection('featured_image');
    //     }

    //     if ($this->tags) {
    //         $offer->syncTags(explode(',', $this->tags));
    //     }

    //     session()->flash('message', 'Offer updated successfully.');
    //     return redirect()->route('sob-offer.index');
    // }

    // public function delete($id)
    // {
    //     SobOffer::findOrFail($id)->delete();
    //     session()->flash('message', 'Offer deleted successfully.');
    //     return redirect()->route('sob-offer.index');
    // }

    // public function render()
    // {
    //     return view('livewire.sob-offer-component', [
    //         'offers' => SobOffer::with('category')->latest()->get(),
    //         'categories' => Category::all(), // ✅ Passing categories explicitly
    //     ]);
    // }
}

