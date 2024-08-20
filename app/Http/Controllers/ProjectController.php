<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectCreateRequest;
use App\Http\Requests\ProjectUpdateRequest;
use Illuminate\Http\Request;

use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects =  Project::paginate(10);
        return view('project.index',['projects'=>$projects])->with('success',"Project successfully updated.");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectCreateRequest $request)
    {
        Project::create($request->safe()->all());
        return redirect("/project")->with('success','Project saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        return view("project.edit",['project'=>$project]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectUpdateRequest $request, string $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->safe()->all());
        $project->save();
        return redirect("/project")->with('success','Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $tasks = $project->tasks;
        foreach ($tasks as $task)
        {
            $task->delete();
        }
        $project->delete();
        return redirect('/project')->with('success','Project Deleted successfully!');
    }
}
