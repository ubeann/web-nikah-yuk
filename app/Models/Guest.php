<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event_id',
        'name',
        'phone',
        'address',
    ];

    /**
     * Get the event that owns the guest.
     */
    public function event() {
        return $this->belongsTo(Event::class);
    }
}
