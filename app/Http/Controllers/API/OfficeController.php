<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Office;
use App\Http\Resources\OfficeResource;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Office::latest()->get();
        return response()->json([OfficeResource::collection($data), 'Office fetched.']);
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
            'office' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $office = Office::create([
            'office' => $request->office
         ]);
        
        return response()->json([' Office created successfully.', new OfficeResource($office)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $office = Office::find($id);
        if (is_null($office)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new OfficeResource($office)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Office $office)
    {
        $validator = Validator::make($request->all(),[
            'office' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $office->office = $request->office;
        $office->save();
        
        return response()->json([' Office updated successfully.', new OfficeResource($office)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        $office->delete();

        return response()->json('office deleted successfully');
    }
}
