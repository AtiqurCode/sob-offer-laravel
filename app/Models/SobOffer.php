<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;
use Spatie\Tags\HasTags;

class SobOffer extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasTags;

    protected $fillable = [
        'uuid', 'title', 'description', 'offer_start_date', 'end_date',
        'category_id', 'terms_conditions', 'special_note'
    ];

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
                    ->width(400)
                    ->height(400)
                    ->nonQueued(); // Ensures conversion happens immediately
            });
    }

    public function getCountdownAttribute()
    {
        $endDate = \Carbon\Carbon::parse($this->end_date);
        return $endDate->diffForHumans();
    }
}
