<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'asset_type' => $this->asset_type,
            'asset_code' => $this->asset_code,
            'id_category' => $this->id_category,
            'asset_name' => $this->asset_name,
            'specification' => $this->specification,
            'capitalization' => $this->capitalization,
            'sap_code' => $this->sap_code,
            'id_employee' => $this->id_employee,
            'id_location' => $this->id_location,
            'id_condition' => $this->id_condition,
            'asset_cordinate' => $this->asset_cordinate,
            'id_cost' => $this->id_cost,
            'acquisition_value' => $this->acquisition_value,
            'useful_life' => $this->useful_life,
            'depreciation_value' => $this->depreciation_value,
            'depreciation' => $this->depreciation,
            'value_book' => $this->value_book,
            'id_vendor' => $this->id_vendor,
            'eproc' => $this->eproc,
            'budget' => $this->budget,
            'device' => $this->device,
            'type' => $this->type,
            'brand' => $this->brand,
            'monitor_inch' => $this->monitor_inch,
            'model_brand' => $this->model_brand,
            'mac_address' => $this->mac_address,
            'warranty' => $this->warranty,
            'computer_name' => $this->computer_name,
            'dlp' => $this->dlp,
            'soc' => $this->soc,
            'snnbpc' => $this->snnbpc,
            'processor' => $this->processor,
            'hardware' => $this->hardware,
            'windows_os' => $this->windows_os,
            'sn_windows' => $this->sn_windows,
            'ms_office' => $this->ms_office,
            'antivirus' => $this->antivirus,
            'notes' => $this->notes,
            'pict' => $this->pict,
            'edvidace' => $this->edvidace,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
