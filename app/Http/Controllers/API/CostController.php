<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Cost;
use App\Http\Resources\CostResource;

class CostController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Cost::latest()->get();
        return response()->json([CostResource::collection($data), 'Cost fetched.']);
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
            'name' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $cost = Cost::create([
            'code' => $request->code,
            'name' => $request->name
         ]);
        
        return response()->json([' Cost created successfully.', new CostResource($cost)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cost = Cost::find($id);
        if (is_null($cost)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new CostResource($cost)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cost $cost)
    {
        $validator = Validator::make($request->all(),[
            'code' => 'required|string|max:255',
            'name' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $cost->code = $request->code;
        $cost->name = $request->name;
        $cost->save();
        
        return response()->json([' Cost updated successfully.', new CostResource($cost)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cost $cost)
    {
        $cost->delete();

        return response()->json('Cost deleted successfully');
    }
}
