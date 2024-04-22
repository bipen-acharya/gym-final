<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    public static $roles = [
        1 => 'Admin',
        2 => 'Trainer',
        3 => 'Customer',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'dob',
        'user_role',
        'description',
        'cost_per_month',
        'experience'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = [
        'suscription_details',
        'bookings',
        'photo'
    ];


    public function getSuscriptionDetailsAttribute()
    {
        $data = [];
        $suscription = $this->suscriptions()->latest()->first();
        if ($suscription) {
            $data['total_days'] = Carbon::parse($suscription->valid_from)->diffInDays(Carbon::parse($suscription->valid_till));
            $data['total_remaining_days'] = Carbon::parse($suscription->valid_till)->diffInDays(Carbon::now());
            $data['start_date'] = Carbon::parse($suscription->valid_from)->format('d M Y');
            $data['end_date'] = Carbon::parse($suscription->valid_till)->format('d M Y');
        }
        return $data;
    }


    public function suscriptions()
    {
        return $this->hasMany(Suscription::class);
    }

    public function getBookingsAttribute()
    {
        if ($this->user_role == 2) {
            return Booking::where('trainer_id', $this->getKey())->paginate(20);
        } else if ($this->user_role == 3) {
            return Booking::where('client_id', $this->getKey())->paginate(20);
        } else {
            return Booking::paginate(20);
        }
    }

    public function getPhotoAttribute()
    {
        if ($this->hasMedia()) {
            return $this->getFirstMediaUrl() ?? asset('images/default-product.png');
        }
        return asset('images/default-product.png');
    }
}
