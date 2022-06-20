<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Lokasi;
use App\Http\Resources\LokasiResource;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Lokasi::latest()->get();
        return response()->json([LokasiResource::collection($data), 'Lokasi fetched.']);
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

        $lokasi = Lokasi::create([
            'code' => $request->code,
            'location' => $request->location
         ]);
        
        return response()->json([' Lokasi created successfully.', new LokasiResource($lokasi)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lokasi = Lokasi::find($id);
        if (is_null($lokasi)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new LokasiResource($lokasi)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lokasi $lokasi)
    {
        $validator = Validator::make($request->all(),[
            'code' => 'required|string|max:255',
            'location' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $lokasi->code = $request->code;
        $lokasi->location = $request->location;
        $lokasi->save();
        
        return response()->json([' Lokasi updated successfully.', new LokasiResource($lokasi)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lokasi $lokasi)
    {
        $lokasi->delete();

        return response()->json(' Lokasi deleted successfully');
    }
}
