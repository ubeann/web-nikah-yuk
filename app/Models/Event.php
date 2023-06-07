<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'service',
        'status',
        'price',
        'date',
        'location',
        'description',
        'guest_url',
        'media'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
    ];

    // Media Library
    public function registerMediaCollections(): void {
        $this->addMediaCollection('event');
    }
    public function registerMediaConversions(Media $media = null): void {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    /**
     * Get the price with Rupiah format.
     */
    public function getPriceAttribute($value) {
        return 'Rp' . number_format($value, 0, ',', '.');
    }

    /**
     * Get the description with "Tidak ada deskripsi" if null.
     */
    public function getDescriptionAttribute($value) {
        return $value ?? 'Tidak ada deskripsi';
    }

    /**
     * Get the user that owns the event.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the event's guests.
     */

    public function guests() {
        return $this->hasMany(Guest::class);
    }

    /**
     * Get the event's photos.
     */
    public function photos() {
        return $this->hasMany(Photo::class);
    }
}
