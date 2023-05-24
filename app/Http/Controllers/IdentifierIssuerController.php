<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Identifier;
use App\Models\Application;
use App\Models\FieldValues;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\IdentifierIssuer;
use App\Models\IdentifierDefinition;

class IdentifierIssuerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $IdIssuer = IdentifierIssuer::get();
        return response()->json($IdIssuer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $org = Organization::findOrFail($request->organizationUID);
        // $app = Application::findOrFail($request->applicationUID);
        // $IdDef = IdentifierDefinition::findOrFail($request->idDefUID);
        // $org = Organization::where('internalKey', $request->org_internalKey)->firstOrFail();
        // $app = Organization::where('internalKey', $request->app_internalKey)->firstOrFail();
        // $IdDef = IdentifierDefinition::where('internalKey', $request->IdDef_internalKey)->firstOrFail();

        // IdentifierIssuer::create([
        //     'organization_id' => $org->id,
        //     'application_id' => $app->id,
        //     'identifier_definition_id' => $IdDef->id,
        // ]);

        IdentifierIssuer::create(request()->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IdentifierIssuer  $identifierIssuer
     * @return \Illuminate\Http\Response
     */
    public function show(IdentifierIssuer $IdentifierIss)
    {
        return response()->json($IdentifierIss);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IdentifierIssuer  $identifierIssuer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IdentifierIssuer $IdentifierIss)
    {
        $identifierIssuer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IdentifierIssuer  $identifierIssuer
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdentifierIssuer $IdentifierIss)
    {
        $identifierIssuer->delete();
    }

    public function showByFilters(Request $request)
    {

        $idIss = IdentifierIssuer::whereHas('IdentifierDefinition.sysClassLevel', function ($query) use ($request) {
            $query->where('tableName', $request->tableName);

        })->when($request->has('idDefUID'), function ($query) use ($request) {
            $query->whereHas('identifierDefinition', function ($query) use ($request) {
                $query->where('idDefUID', $request->idDefUID);
            });
        })->when($request->has('organizationUID'), function ($query) use ($request) {
            $query->whereHas('organizations', function ($query) use ($request) {
                $query->where('organizationUID', $request->organizationUID);
            });
        })->when($request->has('applicationUID'), function ($query) use ($request) {
            $query->whereHas('applications', function ($query) use ($request) {
                $query->where('applicationUID', $request->applicationUID);
            });
        })->with(['IdentifierDefinition','organizations','applications'])
        ->get();

        return $idIss;
    }

public function saveIdentifiers(Request $request)
{

    // $issuerId = $request->idIss;

    // $Type = $request->identifierType;
    // $identifierModel = app("App\\Models\\" . ucfirst($Type));

    // $identifier = $identifierModel::findOrFail($request->identifierId);

    //  $identifier->issuer()->attach($issuerId);


    // $return = $identifier->issuer()->where(['identifier_issuer_id' => $issuerId])->pluck('identifiers.id')->first();


    if(isset($request['fields'])) {
        foreach($request['fields'] as $key => $value) {

            $field = Field::find($value['label_id']);

            $request->validate([
                'fields.*.labelValue' => [$field->dataType, 'regex:'.$field->Regex]
            ]);


            // FieldValues::create([
            //     'fields_id'=> $value['label_id'],
            //     'identifier_id' => $return,
            //     'labelValue' => $value['labelValue']
            // ]);
        }
    }

}

}
