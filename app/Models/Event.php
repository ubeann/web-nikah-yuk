<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
    ];

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
     * Get the event's photos.
     */
    // public function photos() {
    //     return $this->hasMany(Photo::class);
    // }
}
