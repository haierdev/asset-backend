<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WindowResource extends JsonResource
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
            'windows_os' => $this->windows_os,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
