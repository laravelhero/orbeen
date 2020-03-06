<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    public function final_leads()
    {
        return $this->belongsToMany(FinalLead::class);
    }
}
