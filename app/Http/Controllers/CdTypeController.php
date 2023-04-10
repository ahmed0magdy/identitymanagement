<?php

namespace App\Http\Controllers;

use App\Models\CdType;
use App\Models\CdValue;
use Illuminate\Http\Request;

class CdTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     // CdValues endpoints
    public function getAllCdTypes()
    {
        return CdType::paginate(15);
    }


    public function getCdTypeById(CdType $cdType)
    {
         return $cdType;
    }

    // CdValues endpoints
    public function getAllCdValues()
    {
        return CdValue::paginate(15);
    }

    public function getCdValuesById(CdValue $cdValue)
    {
        return $cdValue;
    }
    public function getCdValuesByType(CdType $cdType)
    {
        return $cdType->cdValues;
    }
}
