<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event_id',
        'filename',
        'url',
    ];

    /**
     * Get the event that owns the photo.
     */
    public function event() {
        return $this->belongsTo(Event::class);
    }
}
