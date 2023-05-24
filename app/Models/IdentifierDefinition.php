<?php

namespace App\Models;

use App\Models\IdentifierIssuer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IdentifierDefinition extends Model
{
    use HasFactory;

    protected $fillable = [
        'internalKey',
        'sysClassLevelCdVUID',
        'shortName',
        // 'longName',
        // 'Mnemonic',
        'weight',
        // 'description',
        // 'IsPrimary'
    ];

    public function IdentifierIssuers()
    {
        return $this->hasMany(IdentifierIssuer::class, 'idDefUID');
    }

    public function sysClassLevel(){
        return $this->belongsTo('App\Models\CdValue', 'sysClassLevelCdVUID');
    }

    public function fields(){
        return $this->hasMany(Field::class);
    }

    // public function organizations()
    // {
    //     return $this->belongsToMany(Organization::class, 'issuer')->withPivot('application_id');
    // }

    // public function applications()
    // {
    //     return $this->belongsToMany(Application::class, 'issuer')->withPivot('organization_id');
    // }

    protected $hidden = ['created_at', 'updated_at','deleted_at'];
}
