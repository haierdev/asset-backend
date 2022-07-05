<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Device;
use App\Http\Resources\DeviceResource;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Device::latest()->get();
        return response()->json(
            ['status' => '200',
            'message' => 'Device fetched',
            'result' => DeviceResource::collection($data)], 200);
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
            'device' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $device = Device::create([
            'device' => $request->device
         ]);
         return response()->json(
            ['status' => '200',
            'message' => 'Device created successfully.',
            'result' => new DeviceResource($device)], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $device = Device::find($id);
        if (is_null($device)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new DeviceResource($device)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        $validator = Validator::make($request->all(),[
            'device' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $device->device = $request->device;
        $device->save();
        
        return response()->json([' Device updated successfully.', new DeviceResource($device)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        $device->delete();

        return response()->json('device deleted successfully');
    }
}
