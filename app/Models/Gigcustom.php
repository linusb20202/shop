<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Gigcustom extends Model
{
    //
    public function Gig(){
        return $this->belongsTo('App\Models\Gig');
    }
}
