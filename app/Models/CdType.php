<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CdType extends Model
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
    ];

    public function cdValues()
    {
        return $this->hasMany(CdValue::class, 'cdTypeUID');
    }
}
