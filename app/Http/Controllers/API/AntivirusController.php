<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Antivirus;
use App\Http\Resources\AntivirusResource;

class AntivirusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Antivirus::latest()->get();
        return response()->json([AntivirusResource::collection($data), 'Antivirus fetched.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'antivirus' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $antivirus = Antivirus::create([
            'antivirus' => $request->antivirus
         ]);
        
        return response()->json([' Antivirus created successfully.', new AntivirusResource($antivirus)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $antivirus = Antivirus::find($id);
        if (is_null($antivirus)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new AntivirusResource($antivirus)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Antivirus $antivirus)
    {
        $validator = Validator::make($request->all(),[
            'antivirus' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $antivirus->antivirus = $request->antivirus;
        $antivirus->save();
        
        return response()->json([' Antivirus updated successfully.', new AntivirusResource($antivirus)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Antivirus $antivirus)
    {
        $antivirus->delete();

        return response()->json('Antivirus deleted successfully');
    }
}
