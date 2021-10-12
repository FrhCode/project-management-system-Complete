<?php

namespace App\Http\Controllers;

use App\File;
use App\Helper\Helper;
use App\Project;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        //
        $request['deadline'] =  Carbon::createFromFormat('d/F/Y', $request->deadline)->format('Y-m-d');
        $request['signer_id'] = Auth::user()->id;
        $task = $project->task()->create($request->all());

        if ($request->has('file')) {
            $input = array();
            foreach ($request->file as $item) {
                $fileName = uniqid() . $item->getClientOriginalName();
                array_push($input, [
                    'name' => $fileName,
                    'title' => $item->getClientOriginalName(),
                    'size' => $item->getSize(),
                    'extension' => $item->getClientOriginalExtension(),
                ]);
                // dd($input);
                $item->move(public_path('file'), $fileName);
            }
            $task->file()->createMany($input);
        }
        // dd('gagal');
        Session::flash('success', 'Data berhasil disimpan');
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        // return $request->all();
        // return $request->all();

        // Kalo edit data lewat project detail
        if ($request->has('name')) {
            // return $request->all();
            $request['deadline'] = Carbon::createFromFormat('d/F/Y', $request->deadline)->format('Y-m-d');

            $task->update($request->all());
            // Kalo ada file lakukan if dibawah
            if ($request->has('file')) {
                $input = array();
                for ($i = 0; $i < count($request->file); $i++) {
                    $OriginalName = $request->file[$i]->getClientOriginalName();

                    $newFileName = uniqid() . $OriginalName;

                    array_push($input, [
                        'name' => $newFileName,
                        // 'task_id' => 1,
                        'title' => $request->file[$i]->getClientOriginalName(),
                        'size' => $request->file[$i]->getSize(),
                        'extension' => $request->file[$i]->getClientOriginalExtension(),
                    ]);
                    $request->file[$i]->move(public_path('file'), $newFileName);
                }
                // Kalo ternyata file yang dikirim file selesai ubah dikit value nya
                if (!strcmp($request->status, 'completed')) {
                    // return $input;
                    $input = array_map(function ($item) {
                        $item['status'] = 'finish';
                        return $item;
                    }, $input);
                }
                $task->file()->createMany($input);
            }

            if ($request->has('deletedFile')) {
                $file = File::whereIn('name', $request->deletedFile)->get();
                $fileName = $file->pluck('name');
                Helper::deleteFile($fileName);
                $file->each->delete();
            }



            return redirect('project/' . $task->project_id)->with('success', 'Data Berhasil Diubah');
        }

        // Kalo update data lewat update progress aja
        return $task->update($request->all());
    }
    public function updatePost(Request $request, Task $task)
    {
        $task->update($request->all());

        $input = array();
        for ($i = 0; $i < count($request->file); $i++) {
            $OriginalName = $request->file[$i]->getClientOriginalName();

            $newFileName = uniqid() . $OriginalName;

            array_push($input, [
                'name' => $newFileName,
                // 'task_id' => 1,
                'title' => $request->file[$i]->getClientOriginalName(),
                'size' => $request->file[$i]->getSize(),
                'extension' => $request->file[$i]->getClientOriginalExtension(),
                'status' => 'finish',
            ]);
            $request->file[$i]->move(public_path('file'), $newFileName);
        }
        Session::flash('success', 'Data Berhasil disimpan');

        $task->file()->createMany($input);
        return true;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
