<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Customer extends Authenticatable
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
}
