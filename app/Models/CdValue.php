<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CdValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'internalKey',
        'displayName',
        'description',
        'internalShortCode',
        'rwStatusCd',
        'rwCreatedSessionID',
        'rwCreatedDT',
        'rwModifiedDT',
        'rwModifiedSessionID',
        'tableName',
        'weight'
    ];

    public function cdType(){
        return $this->belongsTo(CdType::class, 'cdTypeUID');
    }
}
