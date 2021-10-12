<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Log;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Session;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::where('status', 'on Progress')->get();
        // $project = Project::where('id', 1)->with('task')->first();
        // return $project->start_date;
        // $project = Project::where('id', 1)->with('task')->first();
        // $quarters = Helper::get_quarters($project->start_date, $project->end_date);
        $user = User::whereHas('division', function ($query) {
            return $query->where('name', '!=', 'admin');
        })->get();

        $location = 'Buat Project Baru';
        return view('staff.project-create', compact('projects', 'user', 'location'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // return $request->all();
        $input = [
            'user_id'       => auth()->user()->id,
            'name'          => $request->project_name,
            'target'        => $request->project_target,
            'description'   => strip_tags($request->project_description),
            'start_date'    => Carbon::now()->format('Y-m-d'),
            'end_date'      => Carbon::createFromFormat('d/F/Y', $request->project_end_date)->format('Y-m-d'),
        ];

        $project = Project::create($input);

        if ($request->has('task_name')) {
            $input = array();
            foreach ($request->task_name as $key => $value) {
                array_push($input, [
                    'signer_id'   => auth()->user()->id,
                    'name'      => $request->task_name[$key],
                    'user_id'   => $request->task_user_id[$key],
                    'deadline'  => Carbon::createFromFormat('d/F/Y', $request->task_end_date[$key])->format('Y-m-d'),
                    'detail'    => strip_tags($request->task_description[$key]),
                ]);
            }

            $tasks = $project->task()->createMany($input);
            if ($request->has('task_attached_file')) {
                // return 'hello wolrd';
                // return $request->all();
                // dd('ada');
                $jmlFile = 0;
                foreach ($tasks as $key => $task) {
                    $input = array();
                    for ($i = 0; $i < $request->task_jumlah_file[$key]; $i++) {
                        // $images_name = uniqid() . $$request->task_attached_file[$jmlFile]->getClientOriginalName();
                        $fileName = uniqid() . $request->task_attached_file[$jmlFile]->getClientOriginalName();
                        array_push($input, [
                            'name' => $fileName,
                            // 'task_id' => 1,
                            'title' => $request->task_attached_file[$jmlFile]->getClientOriginalName(),
                            'size' => $request->task_attached_file[$jmlFile]->getSize(),
                            'extension' => $request->task_attached_file[$jmlFile]->getClientOriginalExtension(),
                        ]);
                        // dd($input);
                        $request->task_attached_file[$jmlFile]->move(public_path('file'), $fileName);
                        $jmlFile++;
                    }
                    $task->file()->createMany($input);
                }
            }
            // dd('gagal');
        }
        Session::flash('success', 'Data Berhasil di Simpan!');
        return $project->id;
        // return $project->load('task');
        // return redirect('/project/create')->with('success', 'Project Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, $status = null)
    {
        // return $project->log;
        $projects = Project::where('status', 'on Progress')->get();
        $project->load(['task.user.division', 'task.file', 'task.log', 'log.user']);
        // return $project;
        // $project = Project::where('id', 1)->with('task')->first();
        $user = User::whereHas('division', function ($query) {
            return $query->where('name', '!=', 'admin');
        })->get();
        $quarters = Helper::get_quarters($project->start_date, $project->end_date);



        if (!count($project->task))
            $minDateForProject = Carbon::now()->addDays(1)->format('d/F/Y');
        else
            $minDateForProject =  $project->task->max('deadline')->format('d/F/Y');
        // $quarters = Helper::get_quarters($project->start_date, $project->start_date);
        // return $quarters;
        // return Log::where('project_id')
        // return $project->task()->where('id', 21)->with('file')->get();

        $location = 'Project Detail';
        return view('staff.project-detail', compact('project', 'quarters', 'projects', 'user', 'minDateForProject', 'location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        // return $project;
        $projects = Project::where('status', 'on Progress')->get();
        return view('staff.project-edit', compact('projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        // return $request->all();
        $input = [
            'name'          => $request->project_name,
            'tercapai'      => $request->tercapai,
            'target'        => $request->target,
            'description'   => strip_tags($request->project_description),
            'end_date'      => Carbon::createFromFormat('d/F/Y', $request->project_end_date)->format('Y-m-d'),
        ];

        $project->update($input);

        return redirect('/project/' . $project->id)->with('success', 'data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $file =  $project->file()->get()->pluck('name');
        Helper::deleteFile($file);

        $project->delete();

        return redirect('/home')->with('success', 'Data Berhasil di Hapus');
    }
}
