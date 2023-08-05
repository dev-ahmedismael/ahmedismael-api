<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Project::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $form_fields = $request->validate([
            'title'=>'required',
            'slug'=>'required',
            'description'=>'required',
            'featured'=>'required',
            'category'=>'required',
            'languages'=>'required',
            'features'=>'required',
            'video'=>'url|required',
            'github'=>'url|required',
            'demo'=>'url|required',
            'img'=> 'required',
            'release_date'=> 'required',
        ]);

        if($request->hasFile('img')) {
            $file = $request->file('img')->store('images/projects', 'images');
            $form_fields['img'] = $file;
        }
        return Project::create($form_fields);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Project::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::find($id);
        $form_fields = $request->validate([
            'title'=>'nullable',
            'slug'=>'nullable',
            'description'=>'nullable',
            'featured'=>'nullable',
            'category'=>'nullable',
            'languages'=>'nullable',
            'features'=>'nullable',
            'video'=>'url|nullable',
            'github'=>'url|nullable',
            'demo'=>'url|nullable',
            'img'=> 'nullable',
            'release_date'=> 'nullable',
        ]);

        if($request->hasFile('img')) {
            !is_null($project->img) && Storage::disk('images')->delete($project->img);
            $file = $request->file('img')->store('images/projects', 'images');
            $form_fields['img'] = $file;
        }
        $project->update($form_fields);
        return $project;
    }

    /**
     * Search for a project
     */
    public function search(string $title)
    {
        return Project::where('title', 'like', '%'.$title.'%')->get();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id);
        !is_null($project->img) && Storage::disk('images')->delete($project->img);
        Project::destroy(($id));
    }
}
