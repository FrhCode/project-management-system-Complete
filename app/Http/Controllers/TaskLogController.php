<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskLog;
use Illuminate\Http\Request;

class TaskLogController extends Controller
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
    public function store(Request $request, Task $task)
    {

        $task->log()->create($request->all());

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TaskLog  $taskLog
     * @return \Illuminate\Http\Response
     */
    public function show(TaskLog $taskLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TaskLog  $taskLog
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskLog $taskLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaskLog  $taskLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskLog $taskLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaskLog  $taskLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskLog $taskLog)
    {
        //
    }
}
