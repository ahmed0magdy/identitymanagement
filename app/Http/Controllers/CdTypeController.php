<?php

namespace App\Http\Controllers;

use App\Models\CdType;
use Illuminate\Http\Request;

class CdTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllCdTypes()
    {
       return CdType::paginate(15);
    }


    public function getCdTypeById(CdType $cdType)
    {
        return $cdType;
    }

}
