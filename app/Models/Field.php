<?php

namespace App\Models;

use App\Enums\Datatype;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Field extends Model
{
    use HasFactory;
    protected $fillable = [
        'label',
        'dataType',
        'Regex',
        'isRequired'
    ];

    public function fieldValues()
    {
        return $this->hasMany(FieldValues::class);
    }

    public function identifierDefinitions()
    {
        return $this->belongsTo(Field::class);
    }


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [

        'dataType' => Datatype::class,
    ];

}
