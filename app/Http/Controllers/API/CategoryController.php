<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::latest()->get();
        return response()->json(
            ['status' => '200',
            'message' => 'Category fetched',
            'result' => CategoryResource::collection($data)], 200);
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

        $category = Category::create([
            'code' => $request->code,
            'category' => $request->category
         ]);
         return response()->json(
            ['status' => '200',
            'message' => 'Category created successfully.',
            'result' => new CategoryResource($category)], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        if (is_null($category)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new CategoryResource($category)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(),[
            'code' => 'required|string|max:255',
            'category' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $category->code = $request->code;
        $category->category = $request->category;
        $category->save();
        
        return response()->json([' Category updated successfully.', new CategoryResource($category)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json('Category deleted successfully');
    }
}
