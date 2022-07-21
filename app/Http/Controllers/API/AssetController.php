<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Asset;
use App\Http\Resources\AssetResource;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Asset::latest()->get();
        return response()->json(
            ['status' => '200',
            'message' => 'Asset fetched',
            'result' => AssetResource::collection($data)], 200);
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
            'asset_type' => 'required',
            'asset_code' => 'required',
            'id_category' => 'required',
            'asset_name' => 'required',
            'specification' => 'required',
            'capitalization' => 'required',
            'sap_code' => 'required',
            'id_employee' => 'required',
            'id_location' => 'required',
            'id_condition' => 'required',
            'asset_cordinate' => 'required',
            'id_cost' => 'required',
            'acquisition_value' => 'required',
            'useful_life' => 'required',
            'depreciation_value' => 'required',
            'depreciation' => 'required',
            'value_book' => 'required',
            'id_vendor' => 'required',
            'budget' => 'required',
            'notes' => 'required',
            'pict' => 'required|mimes:png,jpg,jpeg|max:2048',
            'edvidace' => 'required|mimes:doc,docx,pdf,txt,csv|max:2048',
            'status' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        if ($file = $request->file('edividace')) {
            $path = $file->store('public/files');
            //store your file into directory and db
            $save = new Asset();
            $save->edvidace = $path;
            $save->save();
        }

        if ($file = $request->file('pict')) {
            $path = $file->store('public/images');
            //store your file into directory and db
            $save = new Asset();
            $save->pict = $path;
            $save->save();
        }

        $asset = Asset::create([
            'asset_type' => $request->asset_type,
            'asset_code' => $request->asset_code,
            'id_category' => $request->id_category,
            'asset_name' => $request->asset_name,
            'specification' => $request->specification,
            'capitalization' => $request->capitalization,
            'sap_code' => $request->sap_code,
            'id_employee' => $request->id_employee,
            'id_location' => $request->id_location,
            'id_condition' => $request->id_condition,
            'asset_cordinate' => $request->asset_cordinate,
            'id_cost' => $request->id_cost,
            'acquisition_value' => $request->acquisition_value,
            'useful_life' => $request->useful_life,
            'depreciation_value' => $request->depreciation_value,
            'depreciation' => $request->depreciation,
            'value_book' => $request->value_book,
            'id_vendor' => $request->id_vendor,
            'eproc' => $request->eproc,
            'budget' => $request->budget,
            'device' => $request->device,
            'type' => $request->type,
            'brand' => $request->brand,
            'monitor_inch' => $request->monitor_inch,
            'model_brand' => $request->model_brand,
            'mac_address' => $request->mac_address,
            'warranty' => $request->warranty,
            'computer_name' => $request->computer_name,
            'dlp' => $request->dlp,
            'soc' => $request->soc,
            'snnbpc' => $request->snnbpc,
            'processor' => $request->processor,
            'hardware' => $request->hardware,
            'windows_os' => $request->windows_os,
            'sn_windows' => $request->sn_windows,
            'ms_office' => $request->ms_office,
            'antivirus' => $request->antivirus,
            'notes' => $request->notes,
            'pict' => $request->pict,
            'edvidace' => $request->edvidace,
            'status' => $request->status,
         ]);
        
         return response()->json(
            ['status' => '200',
            'message' => 'Asset created successfully.',
            'result' => new AssetResource($asset)], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asset = Asset::find($id);
        if (is_null($asset)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new AssetResource($asset)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $asset)
    {
        $validator = Validator::make($request->all(),[
            'asset_type' => 'required',
            'asset_code' => 'required',
            'id_category' => 'required',
            'asset_name' => 'required',
            'specification' => 'required',
            'capitalization' => 'required',
            'sap_code' => 'required',
            'id_employee' => 'required',
            'id_location' => 'required',
            'id_condition' => 'required',
            'asset_cordinate' => 'required',
            'id_cost' => 'required',
            'acquisition_value' => 'required',
            'useful_life' => 'required',
            'depreciation_value' => 'required',
            'depreciation' => 'required',
            'value_book' => 'required',
            'id_vendor' => 'required',
            'budget' => 'required',
            'notes' => 'required',
            'pict' => 'required',
            'edvidace' => 'required',
            'status' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $asset->asset_type = $request->asset_type;
        $asset->asset_code = $request->asset_code;
        $asset->id_category = $request->id_category;
        $asset->asset_name = $request->asset_name;
        $asset->specification = $request->specification;
        $asset->capitalization = $request->capitalization;
        $asset->sap_code = $request->sap_code;
        $asset->id_employee = $request->id_employee;
        $asset->id_location = $request->id_location;
        $asset->id_condition = $request->id_condition;
        $asset->asset_cordinate = $request->asset_cordinate;
        $asset->id_cost = $request->id_cost;
        $asset->acquisition_value = $request->acquisition_value;
        $asset->useful_life = $request->useful_life;
        $asset->depreciation_value = $request->depreciation_value;
        $asset->depreciation = $request->depreciation;
        $asset->value_book = $request->value_book;
        $asset->id_vendor = $request->id_vendor;
        $asset->eproc = $request->eproc;
        $asset->budget = $request->budget;
        $asset->device = $request->device;
        $asset->type = $request->type;
        $asset->brand = $request->brand;
        $asset->monitor_inch = $request->monitor_inch;
        $asset->model_brand = $request->model_brand;
        $asset->mac_address = $request->mac_address;
        $asset->warranty = $request->warranty;
        $asset->computer_name = $request->computer_name;
        $asset->dlp = $request->dlp;
        $asset->soc = $request->soc;
        $asset->snnbpc = $request->snnbpc;
        $asset->processor = $request->processor;
        $asset->hardware = $request->hardware;
        $asset->windows_os = $request->windows_os;
        $asset->sn_windows = $request->sn_windows;
        $asset->ms_office = $request->ms_office;
        $asset->antivirus = $request->antivirus;
        $asset->notes = $request->notes;
        $asset->pict = $request->pict;
        $asset->edvidace = $request->edvidace;
        $asset->status = $request->status;
        $asset->save();

        return response()->json([' Asset updated successfully.', new AssetResource($asset)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asset $asset)
    {
        $asset->delete();
        return response()->json(['Asset deleted successfully.']);
    }
    
    public function getAssetByCategory($id)
    {
        $asset = Asset::where('id_category', $id)->get();
        return response()->json([new AssetResource($asset)]);
    }

    public function getAssetByEmployee($id)
    {
        $asset = Asset::where('id_employee', $id)->get();
        return response()->json([new AssetResource($asset)]);
    }

    public function getAssetByLocation($id)
    {
        $asset = Asset::where('id_location', $id)->get();
        return response()->json([new AssetResource($asset)]);
    }

    public function getAssetByCondition($id)
    {
        $asset = Asset::where('id_condition', $id)->get();
        return response()->json([new AssetResource($asset)]);
    }

    public function getAssetByCost($id)
    {
        $asset = Asset::where('id_cost', $id)->get();
        return response()->json([new AssetResource($asset)]);
    }

    public function getAssetByVendor($id)
    {
        $asset = Asset::where('id_vendor', $id)->get();
        return response()->json([new AssetResource($asset)]);
    }

    public function getAssetByStatus($id)
    {
        $asset = Asset::where('status', $id)->get();
        return response()->json([new AssetResource($asset)]);
    }

    public function getAssetByType($id)
    {
        $asset = Asset::where('asset_type', $id)->get();
        return response()->json([new AssetResource($asset)]);
    }

    
}
