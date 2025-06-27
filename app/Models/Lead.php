<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'date',
        'hotel_id',
        'email',
        'nr_room',
        'question'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
