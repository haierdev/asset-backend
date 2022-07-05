<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Condition;
use App\Http\Resources\ConditionResource;

class ConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Condition::latest()->get();
        return response()->json(
            ['status' => '200',
            'message' => 'Condition fetched',
            'result' => ConditionResource::collection($data)], 200);
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
            'condition' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $condition = Condition::create([
            'condition' => $request->condition
         ]);
        
        return response()->json(
            ['status' => '200',
            'message' => 'Condition Successful Created',
            // 'user_created' => auth()->guard('api')->user()->name,
            'result' => new ConditionResource($condition)], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $condition = Condition::find($id);
        if (is_null($condition)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new ConditionResource($condition)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Condition $condition)
    {
        $validator = Validator::make($request->all(),[
            'condition' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $condition->condition = $request->condition;
        $condition->save();
        
        return response()->json([' Condition updated successfully.', new ConditionResource($condition)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Condition $condition)
    {
        $condition->delete();

        return response()->json('Condition deleted successfully');
    }
}
