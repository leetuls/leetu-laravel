<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingAttendee extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'name',
        'join_at',
        'attend_date',
        'attend_key'
    ];
}
