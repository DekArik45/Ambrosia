<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Notifications\Frontend\UserNotif;
use Illuminate\Notifications\Notifiable;

class CustomerNotification extends Model
{
    use Notifiable;

    protected $table = 'user_notifications';
    protected $primary_key = 'id';

    protected $guarded = [];
}
