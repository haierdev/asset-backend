<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Brand;
use App\Http\Resources\BrandResource;

class BrandController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Brand::latest()->get();
        return response()->json([BrandResource::collection($data), 'Brand fetched.']);
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
            'brand' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $brand = Brand::create([
            'brand' => $request->brand
         ]);
        
        return response()->json([' Brand created successfully.', new BrandResource($brand)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = Brand::find($id);
        if (is_null($brand)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new BrandResource($brand)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $validator = Validator::make($request->all(),[
            'brand' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $brand->brand = $request->brand;
        $brand->save();
        
        return response()->json([' Brand updated successfully.', new BrandResource($brand)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return response()->json('brand deleted successfully');
    }
}
