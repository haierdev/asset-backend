<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Processor;
use App\Http\Resources\ProcessorResource;

class ProcessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Processor::latest()->get();
        return response()->json(
            ['status' => '200',
            'message' => 'Processor fetched',
            'result' => ProcessorResource::collection($data)], 200);
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
            'processor' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $processor = Processor::create([
            'processor' => $request->processor
         ]);
         return response()->json(
            ['status' => '200',
            'message' => 'Processor created successfully.',
            'result' => new ProcessorResource($processor)], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $processor = Processor::find($id);
        if (is_null($processor)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new ProcessorResource($processor)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Processor $processor)
    {
        $validator = Validator::make($request->all(),[
            'processor' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $processor->processor = $request->processor;
        $processor->save();
        
        return response()->json([' Processor updated successfully.', new ProcessorResource($processor)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Processor $processor)
    {
        $processor->delete();

        return response()->json('Processor deleted successfully');
    }
}
