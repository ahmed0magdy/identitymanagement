<?php

namespace App\Http\Controllers;

use App\Enums\Datatype;
use Illuminate\Http\Request;
use App\Models\IdentifierDefinition;

class IdentifierDefinitionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $IdDef = IdentifierDefinition::all();

        // return response()->json($IdDef);
        return Datatype::cases();
        ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request['fields']);
        // $idDef =IdentifierDefinition::with('fields')->create($input);
        $idDef =IdentifierDefinition::create([
            'internalKey' => $request->input('internalKey'),
            'sysClassLevelCdVUID' => $request->input('sysClassLevelCdVUID'),
            'shortName'=> $request->input('shortName'),
            'weight'=> $request->input('weight'),
        ]);

        if(isset($request['fields'])) {
            foreach($request['fields'] as $key => $value) {
                $idDef->fields()->create([
                    'label'=> $value['label'],
                    'dataType'=> $value['dataType'],
                    'Regex'=> $value['Regex'],
                    'isRequired'=> $value['isRequired']
                ]);

            }
        }
        return response()->json($idDef);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IdentifierDefinition  $identifierDefinition
     * @return \Illuminate\Http\Response
     */
    public function show(IdentifierDefinition $identifierDefinition)
    {
        $identifierDefinition->load('fields');
        return $identifierDefinition;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IdentifierDefinition  $identifierDefinition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IdentifierDefinition $identifierDefinition)
    {
        $identifierDefinition->update([
            'sysClassLevelCdVUID' => $request->input('sysClassLevelCdVUID') ?? $identifierDefinition->sysClassLevelCdVUID,
            'shortName'=> $request->input('shortName')?? $identifierDefinition->shortName,
            'weight'=> $request->input('weight') ?? $identifierDefinition->weight,
        ]);

        if(isset($request['fields'])) {
            foreach($request['fields'] as $key => $value) {
                $identifierDefinition->fields()->updateOrCreate(
                    ['label'=> $value['label']],
                    [
                    'dataType'=> $value['dataType'],
                    'Regex'=> $value['Regex'],
                    'isRequired'=> $value['isRequired']
                    ]
                );
            }
        }
        return response()->json($identifierDefinition->load('fields'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IdentifierDefinition  $identifierDefinition
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdentifierDefinition $identifierDefinition)
    {
        $identifierDefinition->delete();
    }
}
