<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\Backend\AdminNotif;
use Illuminate\Notifications\Notifiable;

class AdminNotification extends Model
{
    use Notifiable;

    protected $table = 'admin_notifications';
    protected $primary_key = 'id';
    
    protected $guarded = [];
    
}
