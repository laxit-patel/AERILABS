<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inwards extends Model
{
    const Alias = "INWD";
    const PK = "inward_id";
    const Ref = "inward_reference";
    protected $fillable = ['created_at', 'updated_at']; 

    public function clients()
    {
        //return $this->belongsTo('App\Clients');
        return $this->belongsTo('App\Clients', 'clients_id', 'inward_clients');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
