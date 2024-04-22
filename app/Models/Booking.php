<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }
    public function scopeSearch($query)
    {
        if (auth('api')->check()) {

            if (auth()->user()->type == 2) {
                $query->where('trainer_id',  auth('api')->id());
            } else {
                $query->where('client_id',  auth('api')->id());
            }
        }
        return $query;
    }
}
