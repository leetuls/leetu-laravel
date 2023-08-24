<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function getCustomData()
    {
        $query = "select * from wedding_attendees";
        return DB::select($query);
    }
}
