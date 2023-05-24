<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'internalKey',
        'ParentId',
        'displayName',
        'description',
        'TypeCdVUID',
        'isLocation',
        'startDT',
        'stopDT',
        'weight'
    ];
    public function identifierIssuers(){
        return $this->hasMany(IdentifierIssuer::class, 'organizationUID');
    }
    public function parent()
    {
        return $this->belongsTo(Organization::class, 'ParentId');
    }
    public function children()
    {
        return $this->hasMany(Organization::class, 'ParentId');
    }
    public function codeValue()
    {
        return $this->belongsTo(CdValue::class, 'TypeCdVUID', 'id')-> first();
    }
    public function address()
    {
        return $this->hasMany(LocationAddress::class, 'organization_id');
    }
    // public function applications()
    // {
        //     return $this->hasMany(Applications::class, 'OrganizationUID', 'ID')->get();
        // }
    // public function organizationIds()
    // {
    //     return $this->hasMany(OrganizationId::class, 'organizationUID', 'ID')->get();
    // }

    public function issuer()
    {
        return $this->morphToMany(IdentifierIssuer::class, 'identifiers')->using(Identifier::class)->withPivot('id');
    }

    // public function definitions()
    // {
    //     return $this->belongsToMany(Definition::class, 'issuer')->withPivot('application_id');
    // }


    protected $hidden = ['created_at', 'updated_at','deleted_at','rwStatusCd'];

}

