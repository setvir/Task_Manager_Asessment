<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     *
     *  Display a listing of the resource.
     */
    public function index(Request $request)
    {

        //used to keep status of project filter
        $project_id = "";
        $page = request()->get('page', 1);

        $tasks =  Task::query();
        $tasks =  $tasks->with('project');
        if($request->has("project_id") && $request->project_id){
            $tasks =  $tasks->where('project_id',$request->project_id);
            $project_id = $request->project_id;
        }
        $tasks = $tasks->paginate(10, ['*'], 'page', $page);

        // Check if the current page has any records
        if ($tasks->isEmpty() && $page > 1) {
            // Redirect to the previous page
            return redirect()->route('task.index', ['page' => $page - 1]);
        }
        $projects=Project::all();
        return view('task.index',['tasks'=>$tasks, 'projects'=>$projects, "project_id"=>$project_id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        return view('task.create',['projects'=>$projects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskCreateRequest $request)
    {
        Task::create($request->safe()->all());
        return redirect("/task")->with('success','Task created successfully!');;
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
        $task=Task::findOrFail($id);
        $projects = Project::all();
        return view('task.edit',["task" => $task, 'projects' => $projects]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, string $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->safe()->all());
        return redirect("/task")->with('success','Task updated successfully!');;
    }

     /**
     * Update the Priority in storage.
     */
    public function updatePriority(TaskUpdateRequest $request, string $id)
    {
        $task = Task::findOrFail($id);
        return $task->update($request->safe()->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task=Task::findOrFail($id);
        $task->delete();
        return redirect('/task')->with('success','Task deleted successfully!');
    }
}