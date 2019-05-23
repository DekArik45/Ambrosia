<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\CustomerNotification;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
// The authentication guard for customer
    protected $guard = 'customer';
    protected $table = 'users';
    protected $fillable = [
        'name','email','profile_image','status','email_verified_at','password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function review_customer()
    {
        return $this->hasMany(ProductReview::class, 'user_id');
    }

    public function transaksi_customer()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

    public function notifications()
    {
        return $this->morphMany(CustomerNotification::class, 'notifiable')
                    ->orderBy('created_at', 'desc');
    }
    
}
