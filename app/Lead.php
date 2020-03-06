<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    //
    protected $casts = [
        'created_at' => 'datetime'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
