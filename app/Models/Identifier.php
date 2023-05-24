<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Identifier extends MorphPivot
{
    use HasFactory;

    public function fieldValues(){
        return $this->hasMany(fieldValues::class);
    }



}
