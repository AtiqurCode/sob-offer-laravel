<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;
use Spatie\Tags\HasTags;
use Spatie\Image\Enums\Fit;
// use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SobOffer extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasTags;

    protected $fillable = [
        'uuid', 'title', 'description', 'offer_start_date', 'end_date',
        'category_id', 'terms_conditions', 'special_note'
    ];

    // protected $appends = ['countdown'];

    protected $dates = ['offer_start_date', 'end_date'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($offer) {
            $offer->uuid = Str::uuid();
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->registerMediaConversions(function () {
                $this->addMediaConversion('thumb')
                    ->fit(fit: Fit::FillMax, desiredWidth:  497,  desiredHeight: 290, backgroundColor: '#ffffff')
                // ->background('ffffff') // Set background to white
                    ->nonQueued(); // Ensures conversion happens immediately
            });
    }



    public function featuredImage()
    {
        return $this->morphOne(Media::class, 'media', 'model_type', 'model_id')
            ->where('collection_name', 'featured_image');
    }

    public function getCountdownAttribute()
    {
        $endDate = \Carbon\Carbon::parse($this->end_date);
        return $endDate->diffForHumans();
    }
}
