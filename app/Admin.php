<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use App\AdminNotification;

use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    use Notifiable;
// The authentication guard for admin
    protected $guard = 'admin';
    protected $table = 'admins';
    protected $fillable = [
        'username','password','name','profile_image','phone',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function response_admin()
    {
        return $this->hasMany(Response::class, 'admin_id');
    }

    public function notifications()
    {
        return $this->morphMany(AdminNotification::class, 'notifiable')
                    ->orderBy('created_at', 'desc');
    }
}
