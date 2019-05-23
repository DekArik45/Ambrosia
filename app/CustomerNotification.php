<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Notifications\Backend\UserNotif;
use Illuminate\Notifications\Notifiable;

class CustomerNotification extends Model
{
    protected $table = 'user_notifications';
    protected $primary_key = 'id';

}
