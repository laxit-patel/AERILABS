<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    protected $primarykey = 'material_id';
    public $incrementing = false;

    public $fillable = ['material_worksheet', 'material_report'];
    const Alias = "MTRL";
    const PK = "material_id";

    public function tests()
    {
        return $this->hasMany('App\Tests');
    }
}
