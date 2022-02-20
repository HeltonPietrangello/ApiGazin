<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class Developer extends Model
{
    use HasFactory, ApiTrait;

    protected $fillable = ['name', 'sex', 'level_id', 'birth', 'age', 'hobby']; 
    
    protected $allowFilter = ['id', 'name'];
    protected $allowSort = ['id', 'name'];


    public function level(){
        return $this->belongsTo(Level::class);
    }
}
