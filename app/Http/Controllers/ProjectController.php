<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class ProjectController extends Controller
{
    /**
     * Show the form to create a new blog post.
     *
     * @return Response
     */
    public function display($project_id)
    {
        $projects = DB::table('projects')
            ->join('users', 'users.id', '=', 'projects.creator_id')
            ->where('projects.id', '=', $project_id)
            ->select('projects.*', 'users.name AS creator_name', 'users.id AS creator_id')
            ->get();
        $contributions = DB::table('contributions')
            ->join('users', 'users.id', '=', 'contributions.contributor_id')
            ->join('access_levels', 'access_levels.id', '=', 'contributions.access_id')
            ->where('contributions.project_id', '=', $projects[0]->id)
            ->select('users.id AS contributor_id', 'users.name AS contributor', 'access_levels.access AS access')
            ->get();
        $jobs = DB::table('jobs')->where('project_id', '=', $project_id)->get();
        return view('project', [
            'project' => $projects[0],
            'contribs' => $contributions,
            'jobs' => $jobs
        ]);
    }
    public function create()
    {
        return view('project-edit');
    }
    public function edit($project_id)
    {
        $projects = DB::table('projects')->where('id', '=', $project_id)->get();
        return view('project-edit', [
            'project' => $projects[0]
        ]);
    }
    public function edit_finish(Request $request, $project_id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'deadline' => 'required|after:today',
        ]);
        DB::table('projects')->where('id', '=', $project_id)->update([
            'name' => $validatedData['title'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'deadline' => $validatedData['deadline']
        ]);
        return redirect('project/' . $project_id);
    }
    public function add_user($project_id)
    {
        /*
        $currentContributors = DB::table('contributions')
            ->where('contributions.project_id', '=', $project_id)
            ->select('contributions.contributor_id AS id')
            ->get('id')->toArray();
        $imploded = implode(",", (array) $currentContributors);*/
        $users = DB::table('users')
            ->whereNotIn('id', function($query) use($project_id) {
                $query->select('contributions.contributor_id')
                ->from('contributions')
                ->whereRaw('contributions.project_id = ' . $project_id);
            })
            ->select('users.id AS id', 'users.name AS name')
            ->distinct()
            ->get();
        $projects = DB::table('projects')->where('id', '=', $project_id)->get();
        return view('users', [
            'users' => $users,
            'project' => $projects[0]
        ]);
    }
    public function add_user_post(Request $request, $project_id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'project_id' => 'required'
        ]);
        DB::table('contributions')->insert([
            'contributor_id' => $validatedData['user_id'],
            'project_id' => $validatedData['project_id'],
            'access_id' => 2
        ]);
        return redirect('project/' . $project_id);
    }
    public function set_task(Request $request, $project_id)
    {
        $validatedData = $request->validate([
            'task_id' => 'required',
            'set_to' => 'required'
        ]);
        if ($validatedData['set_to'] == 1) {
            DB::table('jobs')
                ->where('jobs.id', '=', $validatedData['task_id'])
                ->update([
                    'completed_at' => Carbon::now()
                ]);
        } else {
            DB::table('jobs')
                ->where('jobs.id', '=', $validatedData['task_id'])
                ->update([
                    'completed_at' => null
                ]);
        }
        return redirect('project/' . $project_id);
    }
    public function add_task(Request $request, $project_id)
    {
        $validatedData = $request->validate([
            'new_task' => 'required'
        ]);
        DB::table('jobs')->insert([
            'name' => $validatedData['new_task'],
            'creator_id' => Auth::id(),
            'project_id' => $project_id
        ]);
        return redirect('project/' . $project_id);
    }

    /**
     * Store a new blog post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'deadline' => 'required|after:today',
        ]);
        $id = DB::table('projects')->insertGetId([
            'name' => $validatedData['title'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'deadline' => $validatedData['deadline'],
            'creator_id' => Auth::id(),
            'created_at' => Carbon::now()
        ]);
        DB::table('contributions')->insert([
            'contributor_id' => Auth::id(),
            'project_id' => $id,
            'access_id' => 3 
        ]);
        return redirect('project/' . $id);
    }
}
