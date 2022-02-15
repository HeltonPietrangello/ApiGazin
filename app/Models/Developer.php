<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class Developer extends Model
{
    use HasFactory, ApiTrait;

    protected $fillable = ['name', 'sex', 'level_id', 'birth', 'age', 'hobby']; 

    public function level(){
        return $this->belongsTo(Level::class);
    }
}
