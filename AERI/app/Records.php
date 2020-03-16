<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Records extends Model
{
    const Alias = "RCRD";
    const PK = "record_id";
    const Ref = "record_inward";
    protected $fillable = ['created_at', 'updated_at'];

    public function inwards()
    {
        return $this->belongsTo('App\Inwards');
    }

    public function test()
    {
        return $this->belongsTo('App\Tests');
    }



}
