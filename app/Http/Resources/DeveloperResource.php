<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeveloperResource extends JsonResource
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
            'name' => $this->name,
            'sex' => $this->sex,
            'level_id' => $this->level_id,
            'level' => $this->level['level'],
            'birth' => $this->birth,
            'age' => $this->age,
            'hobby' => $this->hobby,
        ];
    }
}
