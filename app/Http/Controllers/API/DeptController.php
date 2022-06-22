<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Dept;
use App\Http\Resources\DeptResource;

class DeptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Dept::latest()->get();
        return response()->json([DeptResource::collection($data), 'Dept fetched.']);
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
            'dept' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $dept = Dept::create([
            'dept' => $request->dept
         ]);
        
        return response()->json([' Dept created successfully.', new DeptResource($dept)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dept = Dept::find($id);
        if (is_null($dept)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new DeptResource($dept)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dept $dept)
    {
        $validator = Validator::make($request->all(),[
            'dept' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $dept->dept = $request->dept;
        $dept->save();
        
        return response()->json([' Dept updated successfully.', new DeptResource($dept)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dept $dept)
    {
        $dept->delete();

        return response()->json('Dept deleted successfully');
    }
}
