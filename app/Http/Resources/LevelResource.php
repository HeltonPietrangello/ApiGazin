<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DeveloperResource;

class LevelResource extends JsonResource
{
    
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'level' => $this->level,
            'developers' => DeveloperResource::collection($this->whenLoaded('developers'))
        ];
    }
}
