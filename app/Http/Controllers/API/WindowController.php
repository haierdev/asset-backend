<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Window;
use App\Http\Resources\WindowResource;

class WindowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Window::latest()->get();
        return response()->json([WindowResource::collection($data), 'Window fetched.']);
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
            'windows_os' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $windows_os = Window::create([
            'windows_os' => $request->windows_os
         ]);
        
        return response()->json([' Window created successfully.', new WindowResource($windows_os)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $windows_os = Window::find($id);
        if (is_null($windows_os)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new WindowResource($windows_os)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Window $windows_os)
    {
        $validator = Validator::make($request->all(),[
            'windows_os' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $windows_os->windows_os = $request->windows_os;
        $windows_os->save();
        
        return response()->json([' Window updated successfully.', new WindowResource($windows_os)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Window $windows_os)
    {
        $windows_os->delete();

        return response()->json('windows_os deleted successfully');
    }
}
