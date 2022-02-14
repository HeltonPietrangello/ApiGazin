<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeveloperResource;
use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $developer = Developer::included()
            ->filter()
            ->sort()
            ->getOrPaginate();

        return DeveloperResource::collection($developer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'sex' => 'required|max:255',
            'level_id' => 'required|exists:levels,id'
        ]);

        $developer = Developer::create($request->all());

        return DeveloperResource::make($developer);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $developer = Developer::included()->findOrFail($id);

        return DeveloperResource::make($developer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Developer $developer)
    {
        $developer->delete();

        return DeveloperResource::make($developer);
    }
}
