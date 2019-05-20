<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $table = 'response';
    protected $primary_key = 'id';
    protected $fillable = [
        'review_id','admin_id','content',
    ];

    public function review()
    {
        return $this->belongsTo(ProductReview::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
