<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;

use App\Http\Resources\LevelResource;

class LevelController extends Controller
{
    
    public function index()
    {
        $levels = Level::included()
            ->filter()
            ->sort()
            ->getOrPaginate();

        return LevelResource::collection($levels);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required|max:10|unique:levels'
        ]);

        $level = Level::create($request->all());

        return LevelResource::make($level) ;
    }

   
    public function show($id)
    {
        $level = Level::included()->findOrFail($id);

        return LevelResource::make($level) ;
    }

   
    public function update(Request $request, Level $level)
    {
        $request->validate([
            'level' => 'required|max:255|unique:levels,level,' .  $level->id
        ]);

        $level->update($request->all());

        return LevelResource::make($level);
    }

   
    public function destroy(Level $level)
    {
        $level->delete();

        return LevelResource::make($level);
    }
}
