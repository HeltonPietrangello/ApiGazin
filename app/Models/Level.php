<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class Level extends Model
{
    use HasFactory, ApiTrait;

    const MASCULINE = 'M';
    const FEMININE = 'F';

    protected $fillable = ['level'];
    protected $allowIncluded = ['developers'];
    protected $allowFilter = ['id', 'level'];
    protected $allowSort = ['id', 'level'];

    public function developers()
    {
        return $this->hasMany(Developer::class);
    }

    
}
