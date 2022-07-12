<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Location;
use App\Http\Resources\LocationResource;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Location::latest()->get();
        $data = DB::table('vlocations')->get();
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
            'code' => 'required|string|max:6',
            'location' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $location = Location::create([
            'code' => $request->code,
            'location' => $request->location,
            'parent_location' => $request->parent_location
         ]);
         return response()->json(
            ['status' => '200',
            'message' => 'Location created successfully.',
            'result' => new LocationResource($location)], 201);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $code
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::find($id);
        if (is_null($location)) {
            $location = DB::table('locations')->where('code', 'like', $id)->get();

            if (is_null($location)) {
                return response()->json('Data not found', 404); 
            }
        }
        return response()->json([new LocationResource($location)], 200);
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
            return response()->json($validator->errors(). 405);       
        }

        $location->code = $request->code;
        $location->location = $request->location;
        $location->parent_location = $request->parent_location;
        $location->save();
        
        return response()->json([' Location updated successfully.', new LocationResource($location)], 200);
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

        return response()->json(' Location deleted successfully', 200);
    }
}
