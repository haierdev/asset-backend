<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Location;
use App\Http\Resources\LocationResource;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Location::latest()->get();
        return response()->json(
            ['status' => '200',
            'message' => 'Location fetched',
            'result' => LocationResource::collection($data)], 200);
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
            'code' => 'required|string|max:255',
            'location' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $location = Location::create([
            'code' => $request->code,
            'location' => $request->location
         ]);
         return response()->json(
            ['status' => '200',
            'message' => 'Location created successfully.',
            'result' => new LocationResource($location)], 200);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::find($id);
        if (is_null($location)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new LocationResource($location)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $validator = Validator::make($request->all(),[
            'code' => 'required|string|max:255',
            'location' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $location->code = $request->code;
        $location->location = $request->location;
        $location->save();
        
        return response()->json([' Location updated successfully.', new LocationResource($location)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return response()->json(' Location deleted successfully');
    }
}
