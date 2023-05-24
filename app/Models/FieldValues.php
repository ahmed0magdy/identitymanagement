<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldValues extends Model
{
    use HasFactory;

    protected $fillable = [
        'labelValue',
        'identifier_id',
        'fields_id'
    ];

    public function fields()
    {
        return $this->belongsTo(Field::class, 'fields_id');
    }

    public function identifiers(){
        return $this->belongsTo(Identifier::class);
    }

}
