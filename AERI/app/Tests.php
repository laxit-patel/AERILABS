<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
    const Alias = "TEST";
    const PK = "test_id";

    

    public function materials()
    {
        return $this->belongsTo('App\Materials');
    }
}
