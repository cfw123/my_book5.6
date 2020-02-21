<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $guarded =[];

    public function pdtcont()
    {
        return $this->hasOne(PdtContent::class);
    }

    public function pdtimages()
    {
        return $this->hasMany('App\Models\Entity\PdtImages');
    }
}
