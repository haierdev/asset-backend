<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Kategori;
use App\Http\Resources\KategoriResource;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kategori::latest()->get();
        return response()->json([KategoriResource::collection($data), 'Kategori fetched.']);
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
            'category' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $kategori = Kategori::create([
            'code' => $request->code,
            'category' => $request->category
         ]);
        
        return response()->json([' Kategori created successfully.', new KategoriResource($kategori)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategori = Kategori::find($id);
        if (is_null($kategori)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new KategoriResource($kategori)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lokasi $kategori)
    {
        $validator = Validator::make($request->all(),[
            'code' => 'required|string|max:255',
            'category' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $kategori->code = $request->code;
        $kategori->category = $request->category;
        $kategori->save();
        
        return response()->json([' Lokasi updated successfully.', new LokasiResource($kategori)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lokasi $kategori)
    {
        $kategori->delete();

        return response()->json('Kategori deleted successfully');
    }
}
