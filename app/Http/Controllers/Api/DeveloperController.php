<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeveloperResource;
use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
   
    public function index()
    {
        $developer = Developer::included()
            ->filter()
            ->sort()
            ->getOrPaginate();

        return DeveloperResource::collection($developer);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'sex' => 'required|max:255',
            'level_id' => 'required|exists:levels,id',
            'birth' => 'required|max:255',
            'age' => 'required|max:255',
            'hobby' => 'required|max:255'
        ]);

        $developer = Developer::create($request->all());

        return DeveloperResource::make($developer);
    }

   
    public function show($id)
    {
        $developer = Developer::included()::join('levels', 'developers.level_id', '=', 'levels.id')->select('*')->findOrFail($id);

        return DeveloperResource::make($developer);
    }

    
    public function update(Request $request, Developer $developer)
    {
        $request->validate([
            'name' => 'required|max:255',
            'sex' => 'required|max:255',
            'level_id' => 'required|exists:levels,id',
            'birth' => 'required|max:255'
        ]);

        $developer->update($request->all());

        return DeveloperResource::make($developer);
    }

  
    public function destroy(Developer $developer)
    {
        $developer->delete();

        return DeveloperResource::make($developer);
    }
}
