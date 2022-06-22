<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Vendor;
use App\Http\Resources\VendorResource;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Vendor::latest()->get();
        return response()->json([VendorResource::collection($data), 'Vendor fetched.']);
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
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $vendor = Vendor::create([
            'name' => $request->name,
            'address' => $request->address,
            'contact' => $request->contact
         ]);
        
        return response()->json([' Vendor created successfully.', new VendorResource($vendor)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendor = Vendor::find($id);
        if (is_null($vendor)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new VendorResource($vendor)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $vendor->code = $request->code;
        $vendor->location = $request->location;
        $vendor->save();
        
        return response()->json([' Vendor updated successfully.', new VendorResource($vendor)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();

        return response()->json(' Vendor deleted successfully');
    }
}
