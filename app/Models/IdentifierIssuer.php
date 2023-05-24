<?php

namespace App\Models;

use App\Models\Application;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IdentifierIssuer extends Model
{
    use HasFactory;

    protected $fillable = [
        'idDefUID',
        'organizationUID',
        'applicationUID'
    ];


    public function identifierDefinition(){
        return $this->belongsTo(identifierDefinition::class, 'idDefUID');
    }

    public function organizations(){

        return $this->belongsTo(Organization::class, 'organizationUID');

    }
    public function applications(){

        return $this->belongsTo(Application::class, 'applicationUID');
    }

    // public function payors(){
    //     return $this->morphedByMany(User::class,'identifiers');
    // }

    public function organization(){
        return $this->morphedByMany(Organization::class,'identifiers')->using(Identifier::class)->withPivot('id');
    }
    protected $hidden = ['created_at', 'updated_at','deleted_at','rwStatusCd'];

}
