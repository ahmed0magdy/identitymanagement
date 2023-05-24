<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'internalKey',
        'ParentId',
        'displayName',
        'description',
        'manufacOrganizationUID',
        'AppTypeCdVUID',
        'weight',
    ];

    public function identifierIssuers(){
        return $this->hasMany(IdentifierIssuer::class, 'applicationUID');
    }

    // public function definitions()
    // {
    //     return $this->belongsToMany(Definition::class, 'issuer')->withPivot('organization_id');
    // }
    protected $hidden = ['created_at', 'updated_at','deleted_at','rwStatusCd'];
}
