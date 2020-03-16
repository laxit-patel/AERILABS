<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    const Alias = "INVC";
    const PK = "invoice_id";
    protected $fillable = ['created_at', 'updated_at'];

    public function inwards()
    {
        return $this->belongsTo('App\Inwards');
    }

    public function clients()
    {
        return $this->hasOneThrough('App\Clients', 'App\Inwards');
    }


}
