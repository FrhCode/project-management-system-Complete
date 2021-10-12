@extends('layouts.dashboard-master')

@section('content')
{{-- Main Menu --}}
<div class="row bg-white project-container px-3 py-4 "
    style="box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);">
    {{-- Sisi Kiri --}}
    <div class="col-lg-6  pr-lg-3">
        <div class="project-detail">
            <h3 class="text-primary d-flex align-item-center">
                <span class="font-weight-bold">
                    {{ $project->name }}
                </span>
                <small class="badge ml-2 badge-{{ Helper::badgeColorStatus($project->status) }}">
                    {{ $project->status }}
                </small>
            </h3>

            <p class="mb-2" style="font-weight: 500">
                {{-- {{ $project->description }} --}}
                {!! nl2br($project->description) !!}
            </p>
            <div class="row">
                <p class="col" style="font-size: .9rem">
                    <span class="ajax-tercapai">
                        @include('staff.project-detail-tercapai')
                    </span>
                </p>
                <p class="col" style="font-size: .9rem">
                    <span style="font-weight: 600;">
                        Deadline :
                    </span>
                    {{ $project->end_date->format('d-F-Y') }}
                    @if ($project->end_date->isPast())
                    (Terlambat)
                    @else
                    ({{ Helper::customCarbon($project->end_date) }} )
                    @endif
                </p>
            </div>
        </div>

        @php
        $percentage = Helper::percentageTaskComplete($project->task);
        @endphp
        <div class="row align-items-center">
            <h4 class="col-6">
                Project Task
                <span data-toggle="tooltip" data-placement="right"
                    title="{{ Helper::percentageTaskComplete($project->task, 'percentage') }}">
                    ({{ $percentage }})
                </span>
            </h4>
            <div class="form-group has-search col-6">
                <span class="fa fa-search form-control-feedback"></span>
                <input type="text" class="form-control search-task-box" placeholder="Search Task">
            </div>
        </div>

        @if ($project->task->count())
        <div class="project-task">
            <div class="post-container">
                @foreach ($project->task as $item)
                <div class="post">
                    <div class="mb-1 row justify-content-between">
                        <div class="col-10">
                            <span class="d-block">
                                <a href="" class="text-dark search-task-name task-progress--helper"
                                    data-id="{{ $item->id }}"><strong>{{ $item->name }}</strong></a>
                            </span>

                            {{-- Kalo task dah selesai pake warna putih kalo belom pake sesuai yang di helper --}}
                            @if (strcmp($item->status, 'completed') != 0)
                            <span>
                                <span><a href="More"></a></span>
                                <span class="search-task-name-text">
                                    {{ $item->deadline->format('d-F-Y') }}
                                </span>
                                <small class="badge badge-{{ Helper::badgeColorDate($item->deadline) }} ml-2">
                                    <i class="far fa-clock"></i>
                                    <span class="search-task-name-text">
                                        {{-- {{ $item->deadline->diffForHumans() }} --}}
                                        @if ($item->deadline->isPast())
                                        Terlambat
                                        @else
                                        {{ $item->deadline->diffForHumans() }}
                                        @endif
                                    </span>
                                </small>
                            </span>
                            @else
                            <span>
                                <span class="search-task-name-text">
                                    {{ $item->deadline->format('d-F-Y') }}
                                </span>
                                <small class="badge badge-light ml-2">
                                    <i class="far fa-clock"></i>
                                    <span class="search-task-name-text">{{ 'Completed' }}</span></small>
                            </span>
                            @endif

                        </div>

                        <div class="col-2 text-right">
                            <img class="img-circle img-bordered-sm ml-auto" src="{{ asset('img/' . $item->user->img) }}"
                                alt="user image" width="40px" height="40px" data-toggle="tooltip"
                                data-placement="bottom" title="{{ $item->user->name }}">
                        </div>
                    </div>
                    <!-- /.user-block -->
                    <p class="mb-0">
                        {{ $item->detail }}
                    </p>

                    @if ($item->file->count())
                    <div class="d-flex justify-content-between  align-items-center mt-3">
                        <span>
                            @if ($item->file->where('status', '!=', 'finish')->count())
                            <a href="/download/{{ $item->id }}/starter" class="mr-3"><i class=" fas
                                                    fa-link mr-1"></i>
                                Starter File</a>
                            @endif
                            @if ($item->file->where('status', 'finish')->count())
                            <a href="/download/{{ $item->id }}/finish" class=""><i class=" fas
                                                    fa-ambulance mr-1"></i>
                                Finished File</a>
                            @endif

                        </span>
                        <span>
                            @if ($item->user_id == Auth::user()->id)

                            <span href="#" data-id="{{ $item->id }}" class="task-add-progress--btn hover mr-3"
                                data-toggle="modal" data-target="#add-task-progress--modal">Progress <i
                                    class="fas fa-newspaper"></i></span>

                            <a href="#" data-id="{{ $item->id }}" class="task-edit--btn" data-toggle="modal"
                                data-target="#edit-task--modal">Edit <i class="fas fa-edit"></i></a>
                            @endif
                        </span>
                    </div>

                    @else
                    <div class="d-flex flex-lg-row-reverse mt-3">

                        <span>
                            @if ($item->user_id == Auth::user()->id)

                            <span href="#" data-id="{{ $item->id }}" class="task-add-progress--btn hover mr-3"
                                data-toggle="modal" data-target="#add-task-progress--modal">Progress <i
                                    class="fas fa-newspaper"></i></span>

                            <a href="#" data-id="{{ $item->id }}" class="task-edit--btn" data-toggle="modal"
                                data-target="#edit-task--modal">Edit <i class="fas fa-edit"></i></a>
                            @endif
                        </span>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            <div class="blur-scroll scroll--project-task" style="display: none"></div>
        </div>
        @else
        <div class="post d-flex flex-row justify-content-center align-items-center p-5" style="background: #f4f4f4;">
            Belum ada Task
        </div>
        @endif
    </div>

    {{-- Sisi Kanan --}}
    <div class="col-lg-6  pl-lg-3 mt-5 mt-lg-0">
        <div class="d-flex flex-column justify-content-between h-100">
            <div style="position: relative">
                <h4>Recent Activity</h4>
                <div class="recent-activity">
                    @foreach ($project->log as $item)
                    <div class="post pb-0">
                        <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{ asset('img/' . $item->user->img) }}"
                                alt="user image" data-toggle="tooltip" data-placement="bottom"
                                title="{{ $item->user->name }}">
                            <span class="username">
                                <a href="#">{{ $item->user->name }}</a>
                            </span>
                            <span class="description">{{ $item->type }} -
                                {{ $item->created_at->diffForHumans() }}</span>
                        </div>
                        <!-- /.user-block -->
                        <p>
                            @if (strlen($item->text) < 250) {!! nl2br($item->text) !!}
                                @else
                                {!! nl2br(substr($item->text, 0, 250)) !!}

                                <span class="task-detail--dot"><a href="javascript:;">...</a></span>
                                <span style="display: none" class="task-detail--long">{!! substr($item->text, 251,
                                    strlen($item->text)) !!}</span>
                                <span><a href="" class="task-detail--more">Show more</a></span>
                                @endif
                        </p>
                    </div>
                    @endforeach


                </div>
                <div class="blur-scroll scroll--recent-activity" style="display: none"></div>
            </div>

            <div class="d-flex flex-row justify-content-end w-100 mt-3 mr-2">
                @if (Auth::user()->occupation_id == 2)
                <button type="button" class="btn btn-secondary ml-1" data-toggle="modal"
                    data-target="#add-Project-Task--Modal">
                    New Task +
                </button>
                @endif
                <button type="button" class="btn btn-secondary ml-1" data-toggle="modal" data-target="#staticBackdrop">
                    Edit
                </button>
                <button class=" btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal">Hapus</button>
                @if ($percentage == 100)
                <button class="btn btn-success ml-1" data-toggle="modal" data-target="#projectDoneModal">Tandai
                    Sebagai
                    Selesai</button>
                @endif
                {{-- <button class="btn btn-primary" type="button">Text</button> --}}
            </div>
        </div>

        <form action="{{ URL::to('/project/' . $project->id) }}" method="post" class="delete-project--form">
            @csrf
            {{ method_field('DELETE') }}
        </form>

    </div>
    <div class="col-12">

    </div>
</div>

{{-- Project Target && Summary --}}
<div class="row mt-3 project-container" style="box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);">
    <div class="bg-white project-container p-3 w-100">
        <div class="container-fluid">
            <div class=" table-responsive">
                <div>
                    <h4>Project Summary</h4>
                    @php
                    $counter = 0;
                    @endphp
                    <table class="table table-bordered table-hover">
                        <thead class="bg-info">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Todo List</th>
                                @foreach ($quarters as $item)
                                <th>{{ $item->period }}</th>
                                @php
                                $counter++;
                                @endphp
                                @endforeach
                                <th scope="col">Action Plan</th>
                                <th scope="col">Team in Charge</th>
                            </tr>
                        </thead>

                        <tbody id="plp" data-helper="{{ $project->id }}">
                            @if ($project->task->count())
                            @foreach ($project->task as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                @foreach ($quarters as $quarter)
                                {{-- Bandingin apakah item sekarang memiliki deadline pada looping quarter sekarang --}}
                                <th @if (!strcmp($quarter->period,
                                    Helper::get_quarter_for_spesific_date($item->deadline)))
                                    style="background: #d4d0c7"
                                    @endif
                                    ></th>

                                @endforeach
                                <td>{{ $item->detail }}</td>
                                <td>{{ $item->user->division->title }}</td>
                            </tr>
                            @endforeach

                            @else
                            <tr>
                                <td colspan="{{ $counter + 4 }}" style="text-align: center;background: #f4f4f4f4;">
                                    Belum ada data untuk
                                    ditampilkan</td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Pie Chart --}}
<div class="ajax-pie-chart-detailProject">
    @include('staff.project-detail-chart')
</div>

{{-- TimeLine --}}

@endsection

@section('modal')
<!-- Modal Edit Project -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ '/project/' . $project->id }}" method="POST" data-parsley-validate="" id="edit-project--form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit data project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    {{ method_field('PUT') }}
                    {{-- Input nama --}}
                    <div class="form-group">
                        <label for="name">Project Name</label>
                        <input type="text" autocomplete="off" class="form-control" id="name" placeholder="Project Name"
                            name="project_name" data-parsley-required="true" data-parsley-minlength="6"
                            value="{{ $project->name }}">
                        <div class="invalid-feedback bs-callout-warning">
                            Kolom ini wajib diisi
                        </div>
                    </div>

                    {{-- Input pencapaian peserta didik --}}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="project-tercapai">Jumlah peserta terdidik</label>

                            <input type="text" class="form-control" id="project-tercapai"
                                value="{{ number_format($project->tercapai, 0, ',', '.') }}">

                            <input type="text" class="form-control d-none" id="project-tercapai--real"
                                value="{{ $project->tercapai }}" name="tercapai"
                                data-parsley-max="{{ $project->target }}" data-parsley-required="true">

                            <div class="invalid-feedback">
                                Kolom ini wajib diisi
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="project-target">Jumlah target peserta</label>

                            <input type="text" class="form-control" id="project-target"
                                value="{{ number_format($project->target, 0, ',', '.') }}">

                            <input type="text" class="form-control d-none" id="project-target--real"
                                value="{{ $project->target }}" name="target" data-parsley-required="true"
                                data-parsley-min="{{ $project->tercapai }}">

                            <div class="invalid-feedback">
                                Kolom ini wajib diisi
                            </div>
                        </div>
                    </div>

                    {{-- Input Desktipsi --}}
                    <div class="form-group">
                        <label for="add_project_detail">Project Detail</label>
                        <textarea class="form-control" id="add_project_detail" rows="5" name="project_description"
                            data-parsley-required data-parsley-minlength="10"
                            data-parsley-required="true">{{ $project->description }}</textarea>
                        <div class="invalid-feedback">
                            Kolom ini wajib diisi
                        </div>
                    </div>


                    {{-- Deadline --}}
                    <div class="form-group">
                        <label class="" for=" inlineFormInputGroup">Deadline</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"> <i class="fas fa-calendar"></i></div>
                            </div>
                            <input type="text" autocomplete="off" class="form-control" id="project-deadline"
                                placeholder="Deadline" name="project_end_date" readonly
                                value="{{ $project->end_date->format('d/F/Y') }}">
                            <div class="input-group-prepend ">
                                <div class="input-group-text disable project--dateDiff">0 Day</i></div>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Kolom ini wajib diisi
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal edit task --}}
<div class="modal fade" id="edit-task--modal" data-backdrop="static" data-keyboard="true" tabindex="-1"
    aria-labelledby="edit-task--modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/edit" method="POST" data-parsley-validate="" enctype="multipart/form-data"
                id="form-edit-task">
                @csrf
                {{ method_field('PUT') }}
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-taskLabel">Edit data task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-section">
                        {{-- Task Name --}}
                        <div class="form-group">
                            <label for="task_name">Nama Task</label>
                            <input type="text" autocomplete="off" class="form-control" id="task_name"
                                placeholder="Nama Task" name="name" data-parsley-required="true"
                                data-parsley-minlength="6">
                            <div class="invalid-feedback bs-callout-warning">
                                Kolom ini wajib diisi
                            </div>
                        </div>

                        {{-- Task Detail --}}
                        <div class="form-group">
                            <label for="task-detail">Detail Task</label>
                            <textarea class="form-control" id="task-detail" rows="5" name="detail" data-parsley-required
                                data-parsley-minlength="10" data-parsley-required="true"
                                placeholder="Detail Task"></textarea>
                            <div class="invalid-feedback">
                                Kolom ini wajib diisi
                            </div>
                        </div>

                        {{-- Task Deadlie --}}
                        <div class="form-group">
                            <label class="" for=" inlineFormInputGroup">Deadline</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"> <i class="fas fa-calendar"></i></div>
                                </div>
                                <input type="text" autocomplete="off" class="form-control" id="task-deadline"
                                    placeholder="Deadline" name="deadline" readonly>
                                <div class="input-group-prepend ">
                                    <div class="input-group-text disable task--dateDiff">0 Day</i></div>
                                </div>
                            </div>
                            <div class="invalid-feedback">
                                Kolom ini wajib diisi
                            </div>
                        </div>

                        {{-- Task Status --}}
                        <div class="form-group">
                            <p>Project Status</p>
                            <div class="
                                    form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="todo" value="todo">
                                <label class="form-check-label" for="todo">TODO</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="onProgress"
                                    value="on progress">
                                <label class="form-check-label" for="onProgress">ON PROGRESS</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="completed"
                                    value="completed">
                                <label class="form-check-label" for="completed">COMPLETED</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        {{-- <div class="starter-file" style="display: none;"> --}}
                        <p class="m-0 mb-2 font-weight-bold starter-file-text-on-form-edit">Starter File</p>
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="width: 10%">#</th>
                                    <th scope="col" style="width: 80%">File Name</th>
                                    <th scope="col" style="width: 10%">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="3" class="text-center">Tidak ada file yang terlampir</th>
                                </tr>
                            </tbody>
                        </table>

                        <div class="form-group">
                            <label class="btn btn-secondary my-file-selector
                                my-file-selector">
                                <input class="file--file_task" type="file" multiple="multiple" style="display:none"
                                    name='file[]'>
                                Files&hellip;
                            </label>
                            <span class='label label-info' class="upload-file-info"></span>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Add Progress --}}
<div class="modal fade" id="add-task-progress--modal" data-backdrop="static" data-keyboard="true" tabindex="-1"
    aria-labelledby="add-task-progress--modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST" data-parsley-validate="" id="add-task-progress--form">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Project Progress</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Judul dari progress --}}
                    <div class="form-group">
                        <label for="Judul">Title</label>
                        <input type="text" autocomplete="off" class="form-control" id="Judul" placeholder="Judul"
                            name="title" data-parsley-required="true" data-parsley-minlength="6">
                        <div class="invalid-feedback bs-callout-warning">
                            Kolom ini wajib diisi
                        </div>
                    </div>

                    {{-- Pesan Progress --}}
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" id="content" rows="5" name="content" data-parsley-required
                            data-parsley-minlength="10" data-parsley-required="true" placeholder="Content"></textarea>
                        <div class="invalid-feedback">
                            Kolom ini wajib diisi
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal add new task --}}
<div class="modal fade" id="add-Project-Task--Modal" data-backdrop="static" data-keyboard="true" tabindex="-1"
    aria-labelledby="add-Project-Task--ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" id="new-task--form" data-parsley-validate>
                <div class="modal-header">
                    <h5 class="modal-title" id="add-Project-Task--ModalLabel">New Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Input nama --}}
                    <div class="form-group">
                        <label for="name">Task Name</label>
                        <input type="text" autocomplete="off" class="form-control" id="name" placeholder="Project Name"
                            name="name" data-parsley-required="true" data-parsley-minlength="6">
                        <div class="invalid-feedback bs-callout-warning">
                            Kolom ini wajib diisi
                        </div>
                    </div>

                    {{-- PIC dan Deadline --}}
                    <div class="form-row mb-3">
                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <label for="pic">Task PIC</label>
                            <select class="taskPIC" name="user_id" style="width: 100%" data-parsley-required id="pic">
                                <option></option>
                                @foreach ($user as $item)
                                <option value="{{ $item->id }}" data-src="{{ $item->img }}">
                                    {{ Str::limit($item->name, 20) }}
                                </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback ">
                                Kolom ini wajib diisi
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <label for="deadline">Task Deadline</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"> <i class="fas fa-calendar"></i></div>
                                </div>
                                <input type="text" autocomplete="off" class="form-control project-task-deadline"
                                    placeholder="Deadline" name="deadline" readonly id="deadline">
                                <div class="input-group-prepend ">
                                    <div class="input-group-text disable task--dateDiff">0 Day</i></div>
                                </div>
                            </div>
                            <div class="invalid-feedback ">
                                Kolom ini wajib diisi
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="form-group">
                        <label for="name">Task Description</label>
                        {{-- <label for="add_project_detail">Project Detail</label> --}}
                        <textarea name="detail" class="form-control" rows="5" placeholder="Task Description..."
                            data-parsley-required data-parsley-minlength="10"></textarea>
                        <div class="invalid-feedback ">
                            Kolom ini wajib diisi
                        </div>
                    </div>

                    <div class="form-group">
                        <p class="m-0 mb-2 font-weight-bold starter-file-text-on-form-edit">Starter File</p>
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="width: 80%">File Name</th>
                                    <th scope="col" style="width: 10%">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <label class="btn btn-secondary">
                                <input class="file--file_task" type="file" multiple="multiple" style="display:none"
                                    name='file[]'>
                                Files&hellip;
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="outer-timeline-container" style="display: none">
    <div class="timeline-container">
        <span class="timeline--exit-btn"><i class="fas fa-times icon" style="font-size: 30px"></i></span>
        <div class="content-isi">
            <ul>
                <li>
                    <div class="timeline-content">
                        <h3 class="date">20th may, 2010</h3>
                        <h1>Heading 1</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur tempora ab laudantium
                            voluptatibus aut eos placeat laborum, quibusdam exercitationem labore.</p>
                    </div>
                </li>
                <li>
                    <div class="timeline-content">
                        <h3 class="date">20th may, 2010</h3>
                        <h1>Heading 2</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur tempora ab laudantium
                            voluptatibus aut eos placeat laborum, quibusdam exercitationem labore.</p>
                    </div>
                </li>
                <li>
                    <div class="timeline-content">
                        <h3 class="date">20th may, 2010</h3>
                        <h1>Heading 1</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur tempora ab laudantium
                            voluptatibus aut eos placeat laborum, quibusdam exercitationem labore.</p>
                    </div>
                </li>
                <li>
                    <div class="timeline-content">
                        <h3 class="date">20th may, 2010</h3>
                        <h1>Heading 2</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur tempora ab laudantium
                            voluptatibus aut eos placeat laborum, quibusdam exercitationem labore.</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="module">
    import * as daterangepicker from "{!! asset('js/date-range-picker.js') !!}";
        import * as modal from "{!! asset('js/modal.js') !!}";
        import * as search from "{!! asset('js/searchTaskProjectDetail.js') !!}";
        import * as numberInput from "{{ asset('js/numberInput.js') }}"
        import * as func from "{{ asset('js/func.js') }}";
        $(document).ready(function() {
            // Munculin Pie Chart


            // Modal Confirmasi Project Selesai
            modal.confirmationProjectDone();

            // Jika Tombol di click project akan dihapus
            modal.confirmationProjectDelete()

            search.init();

            numberInput.init($('#project-tercapai'), $('#project-tercapai--real'), true);
            numberInput.init($('#project-target'), $('#project-target--real'));

            // let startDate = "{!! $project->end_date->format('d/F/Y') !!}"

            // kalo belum ada task sebelumnya maka hari minimal nya adalah besok

            let startDate = moment().format('DD/MMMM/YYYY')
            let minDate = '{!! $minDateForProject !!}'
            daterangepicker.projectEdit(startDate, minDate);
            // setInterval(() => {
            //     console.log("tercapai = " + $('#project-tercapai--real').val())
            //     console.log("Target = " + $('#project-target--real').val())
            // }, 1000);
        });
    </script>

<script type="module">
    import * as func from "{{ asset('js/func.js') }}";
        import * as numberInput from "{{ asset('js/numberInput.js') }}"
        import * as daterangepicker from "{!! asset('js/date-range-picker.js') !!}";
        $(document).ready(function() {
            let projectTask = {!! $project->task !!}
            let selectedTask;

            // Logic add new Task
            function formatData(data) {
                if (!data.id) {
                    return data.text;
                }
                let imgProfile = $(data.element).data("src");
                var $result = $(
                    `<span class='d-flex d-flex justify-content-between'>${data.text} <img src="/img/${imgProfile}" style="max-height:60px;"> </span>`
                );
                return $result;
            }

            $(".taskPIC")
                .select2({
                    placeholder: "Person in charge(PIC)",
                    allowClear: true,
                    templateResult: formatData,
                    templateSelection: formatData
                });
            $(document).on("select2:close", ".taskPIC", function(e) {
                $(this)
                    .parents(".col-lg-6")
                    .first()
                    .find("img")
                    .addClass("d-none");
            });
            let maxDate = "{!! $project->end_date !!}"
            daterangepicker.taskDeadline(maxDate);
            let start = moment();
            let end = moment(
                $(".project-task-deadline")
                .first()
                .val(),
                "DD/MMMM/YYYY"
            );
            if (end.diff(start, "Hour") > 24) {
                $(".task--dateDiff")
                    .first()
                    .html(end.diff(start, "days") + " Hari");
            } else {
                $(".task--dateDiff")
                    .first()
                    .html(end.diff(start, "Hour") + " Jam");
            }

            let fileList = [];
            let fistTime = true;

            $('#new-task--form input[type=file]').change(function(e) {
                let file = $(this).prop('files')

                $.each(file, function(indexInArray, valueOfElement) {
                    if (fistTime) {
                        $('tbody').empty()
                        fistTime = false
                    }
                    fileList.push(valueOfElement)

                    let content =
                        `<tr>
                    <td>${valueOfElement['name']}</td>
                    <td><a href="javascript:;" class="delete-btn--for-file-upload">Hapus</a></td>
                </tr>`;
                    $('tbody').append(content);
                });

                // content =
            })

            $('body').on('click', '#new-task--form .delete-btn--for-file-upload', function(e) {
                e.preventDefault();
                let trTag = $(this).addClass('hapus');

                let filteredElement = $('#new-task--form .delete-btn--for-file-upload').filter(".hapus");
                let index = $('#new-task--form .delete-btn--for-file-upload').index(filteredElement)

                // console.log(fileList[index]);

                // console.log(index);
                if (index > -1) {
                    fileList.splice(index, 1);
                }

                // fileList = [2, 9]
                // console.log(fileList);

                $(this).parents('tr').empty()
            });

            $('#new-task--form').submit(function(e) {
                // DO STUFF...
                e.preventDefault();
                var fd = new FormData();

                $.each(fileList, function(indexInArray, valueOfElement) {
                    fd.append('file[]', valueOfElement);
                });

                // get all input,text area, and select from form
                let input = $(
                    '#new-task--form select,#new-task--form textarea,#new-task--form input:not([type="file"],[type="submit"])'
                );
                $.each(input, function(indexInArray, valueOfElement) {
                    let key = $(valueOfElement).attr('name')
                    let value = $(valueOfElement).val()
                    fd.append(key, value);

                });
                // fd.append('name', 'farhan');

                // for (var pair of fd.entries()) {
                //     console.log(pair[0] + ', ' + pair[1]);
                // }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/task/" + {!! $project->id !!},
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        location.reload();
                    }
                });
            });

            $('#upload-file-for-completed-task--modal').on('hidden.bs.modal', function(event) {
                // uploadWithoutFile();
                // console.log('disini');
            })
            // end add new task

            // Munculin progress dari project

            function keyPress(e) {
                if (e.key === "Escape") {
                    // write your logic here.
                    $('.timeline--exit-btn').click()
                }
            }

            $('.timeline--exit-btn').click(function() {
                let parent = $('.outer-timeline-container')
                parent.fadeOut('fast');
                $('body').toggleClass('modal-open')
                $('body').off('keyup', keyPress);
            })


            // Kalo judul dipencet munculin progress nya
            $('.task-progress--helper').click(function(e) {
                e.preventDefault();
                $('body').on('keyup', keyPress);
                let parent = $('.outer-timeline-container')
                parent.fadeIn('fast');
                $('body').toggleClass('modal-open')

                selectedTask = projectTask.find(x => x.id === $(this).data('id'));
                selectedTask = selectedTask['log']

                $('.content-isi ul').empty();
                $.each(selectedTask, function(indexInArray, valueOfElement) {
                    $('.content-isi ul').append(`
                <li>
                    <div class="timeline-content">
                        <h3 class="date">${moment(valueOfElement).format('Do MMMM, YYYY')}</h3>
                        <h1>${valueOfElement['title']}</h1>
                        <p>${valueOfElement['content']}</p>
                    </div>
                </li>
                `)
                });

            });
            // End Munculin Progress dari project

            // Logic Add Progress
            $('.task-add-progress--btn').click(function(e) {
                e.preventDefault();
                selectedTask = $(this).data('id')
                $('#add-task-progress--form').attr('action', `/task-log/${selectedTask}`)
            });
            // End Logic Add Progress

            // Logic Edit task
            $('.task-edit--btn').click(function(e) {
                let name = $('#task_name')
                let detail = $('#task-detail')
                let deadline = $('#task-deadline')
                let radioBtn = $('input[name="status"]')

                selectedTask = projectTask.find(x => x.id === $(this).data('id'));
                selectedTask['deadline'] = moment(selectedTask['deadline']).format('DD/MMMM/YYYY')

                name.val(selectedTask['name'])
                detail.val(selectedTask['detail'])

                let deadlineVal = selectedTask['deadline'];
                let projectDeadline = "{!! $project->end_date !!}"
                daterangepicker.taskEdit(deadlineVal, projectDeadline)


                switch (String(selectedTask['status'])) {
                    case 'todo':
                        radioBtn.eq(0).prop('checked', true)
                        break;

                    case 'on progress':
                        radioBtn.eq(1).prop('checked', true)
                        break;

                    case 'completed':
                        radioBtn.eq(2).prop('checked', true)
                        break;
                }

                // Kalo Radio Task completed check munculin table ckeck
                if (radioBtn.eq(2).prop('checked')) {
                    $('.starter-file-text-on-form-edit').html('Finished File')
                    radioBtn.parents('.form-group').hide();
                    let finishedFile = selectedTask['file'].filter(function(e) {
                        if (!e.status.localeCompare('finish'))
                            return e
                    });
                    if (finishedFile.length) {
                        $('.modal-body tbody').empty()
                        $.each(finishedFile, function(indexInArray, valueOfElement) {
                            $('.modal-body tbody').append(`
                        <tr>
                            <td>
                                ${indexInArray+1}
                            </td>

                            <td>
                                ${func.truncate(valueOfElement.title,24)}
                            </td>

                            <td>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="${valueOfElement.name}" id="ckBoxDeletedFile${indexInArray}" name="deletedFile[]">
                                    <label class="form-check-label-icon" for="ckBoxDeletedFile${indexInArray}">
                                        <i class="fas fa-trash"></i>
                                    </label>
                                </div>
                            </td>
                        </tr>
                    `)
                        });
                    }
                } else {
                    let starterFile = selectedTask['file'].filter(function(e) {
                        if (!e.status.localeCompare('starter'))
                            return e
                    });

                    if (starterFile.length) {
                        $('.modal-body tbody').empty()
                        $('.starter-file-text-on-form-edit').html('Starter File')
                        $.each(starterFile, function(indexInArray, valueOfElement) {
                            $('.modal-body tbody').append(`
                        <tr>
                            <td>
                                ${indexInArray+1}
                            </td>

                            <td>
                                ${func.truncate(valueOfElement.title,24)}
                            </td>

                            <td>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="${valueOfElement.name}" id="ckBoxDeletedFile${indexInArray}" name="deletedFile[]">
                                    <label class="form-check-label-icon" for="ckBoxDeletedFile${indexInArray}">
                                        <i class="fas fa-trash"></i>
                                    </label>
                                </div>
                            </td>

                        </tr>
                    `)
                        });
                    }
                }
            });
            $(document).on("change", ".file--file_task", function(e) {
                $(this)
                    .parent()
                    .next()
                    .html(
                        this.files.length > 1 ?
                        this.files.length + " files" :
                        this.files[0].name
                    );
            });
            $('#edit-task--modal').on('hidden.bs.modal', function() {
                $('input[name="status"]').attr('checked', false)
                $('input[name="status"]').parents('.form-group').show();
                $("#form-edit-task").parsley().reset();
                // Balikin table biar kosong lagi
                $('.modal-body tbody').html(`
                <tr >
                    <th colspan = "3"
                        class = "text-center" > Tidak ada file yang terlampir
                    </th>
                </tr>
            `)
                $('.file--file_task').val('');
                $('.file--file_task')
                    .parent()
                    .next()
                    .empty()
            });
            $('#form-edit-task').submit(function(e) {
                let taskId = selectedTask['id']
                $(this).attr('action', `/task/${taskId}`);
                // $(this).submit()
                return true
            });
            // /End Logic edit task

            // Nentuin bakal diadain blur atau enggak di bagian project task sama project progress
            if ($('.recent-activity').height() - 64 >= 560) {
                $('.scroll--recent-activity').show();
                $('.recent-activity').scroll(function(event) {
                    // console.log($(this).scrollHeight);
                    if ($(this).scrollTop() + $(this).innerHeight() - $(this)[0].scrollHeight >= -($(
                                '.scroll--recent-activity')
                            .innerHeight())) {
                        // alert('end reached'); -
                        $('.scroll--recent-activity').hide()
                    } else
                        $('.scroll--recent-activity').show()
                });
            }

            if ($('.project-task').height() - 64 >= 578.991) {
                $('.scroll--project-task').show();
                $('.project-task').scroll(function(event) {
                    // console.log($(this).scrollHeight);
                    if ($(this).scrollTop() + $(this).innerHeight() - $(this)[0].scrollHeight >= -($(
                                '.scroll--project-task')
                            .innerHeight())) {
                        // alert('end reached'); -
                        $('.scroll--project-task').hide()
                    } else
                        $('.scroll--project-task').show()
                });
            }
            // End nentuan blur

            $('.task-detail--more').click(function(e) {
                e.preventDefault();
                $(this).toggleText('Lebih banyak', "Lebih Sedikit")
                $(this).parent().siblings().filter("span").toggle()
                // console.log($(this).parent().siblings())
            });

            let tercapai;
            let target;
            $('#project-tercapai').focus(function() {
                tercapai = $('#project-tercapai--real').val();
                target = $('#project-target--real').val();
            }).blur(function(e) {
                let tercapaiAfter = $('#project-tercapai--real').val();

                if (parseInt(tercapaiAfter) > parseInt(target)) {
                    $('#project-tercapai').val(func.numWithComma(tercapai))
                    $('#project-tercapai--real').val(tercapai)
                } else {
                    $('#project-target--real').attr('data-parsley-min', tercapaiAfter)
                }
            });

            $('#project-target').focus(function() {
                //console.log('hi');
                tercapai = $('#project-tercapai--real').val();
                target = $('#project-target--real').val();
            }).blur(function(e) {
                let targetAfter = $('#project-target--real').val();

                if (parseInt(tercapai) > parseInt(targetAfter)) {
                    $('#project-target').val(func.numWithComma(target))
                    $('#project-target--real').val(target)
                } else {
                    $('#project-tercapai--real').attr('data-parsley-max', targetAfter)
                }
            });

            let enterOrBodyClickOnTercapaiDblCick = function(inputVal, targetValue, tercapaiTag, inputUser) {
                let tercapaiAfter = inputVal.val()
                // Kalo nilai tercapai after bernilai kosong kasih kondisi dimana milai dia selalu lebih gede dari target
                tercapaiAfter = tercapaiAfter == '' ? targetValue + 1 : tercapaiAfter;

                if (parseInt(tercapaiAfter) > parseInt(targetValue)) {
                    toastr.options = {
                        closeButton: true
                    };
                    toastr.info("Mohon periksa kembali data yang dikirim", "PMS Project");
                } else {
                    // console.log('boleh');
                    $(tercapaiTag).html(inputUser.val());

                    let data = {
                        'tercapai': inputVal.val()
                    }
                    $.ajax({
                        type: "GET",
                        url: "/ajax/project-detail/" +
                            {!! $project->id !!},
                        data: data,
                        success: function(response) {
                            $('.ajax-tercapai').html(response.viewTercapai)
                            $('.ajax-pie-chart-detailProject').html(response
                                .viewChart)
                            toastr.options = {
                                closeButton: true
                            };
                            toastr.success("Data berhasil diubah", "PMS Project");
                            $('body').off('click');
                            $('body').on('dblclick', '.project-tercapai--inputDbl',
                                funDblClick);
                        }
                    });

                }
            }
            let funDblClick = function(e) {
                let tercapaiTag = $('.tercapai-value');
                let inputTag =
                    '<input type="text" name="" id="" class="input--dblClickUser"><input type="text" name="" id="" class="d-none input--dblClickVar">';

                let tercapaiBefore = tercapaiTag.html()
                // console.log(tercapaiBefore);
                let targetValue = $('.target-value').html().replace(/\./g, "");
                tercapaiTag.html(inputTag)

                let inputUser = $('.input--dblClickUser')
                let inputVal = $('.input--dblClickVar')
                inputUser.focus()

                numberInput.init(inputUser, inputVal);

                inputUser.keyup(function(event) {
                    if (event.keyCode == 13) {
                        enterOrBodyClickOnTercapaiDblCick(inputVal, targetValue, tercapaiTag,
                            inputUser);
                    }
                });

                $('body').click(function(e) {
                    if (!$(e.target).hasClass('input--dblClickUser')) {
                        tercapaiTag.html(tercapaiBefore)
                        $('body').off('click');
                        $('body').on('dblclick', '.project-tercapai--inputDbl',
                            funDblClick);
                    }
                });
                $('body').off('dblclick', '.project-tercapai--inputDbl', funDblClick);
            }

            $('body').on('dblclick', '.project-tercapai--inputDbl', funDblClick);


            $('#edit-project--form').parsley().on('field:error', function() {
                let node = $(this)[0].$element;
                let parrent_error = node.parent();

                let error_msg = parrent_error
                    .find(".parsley-errors-list")
                    .addClass("d-none")
                    .find("li")
                    .html();
                parrent_error
                    .find(".invalid-feedback")
                    .addClass("d-block")
                    .html(error_msg);

            });

            $("#edit-project--form").parsley().on("field:success", function() {
                let node = $(this)[0].$element;
                let parrent_error = node.parent();

                parrent_error.find(".invalid-feedback").removeClass("d-block");

            });

            $('#form-edit-task').parsley().on('field:error', function() {
                let node = $(this)[0].$element;
                let parrent_error = node.parent();

                let error_msg = parrent_error
                    .find(".parsley-errors-list")
                    .addClass("d-none")
                    .find("li")
                    .html();
                parrent_error
                    .find(".invalid-feedback")
                    .addClass("d-block")
                    .html(error_msg);

            });

            $("#form-edit-task").parsley().on("field:success", function() {
                let node = $(this)[0].$element;
                let parrent_error = node.parent();

                parrent_error.find(".invalid-feedback").removeClass("d-block");

            });

            $("#new-task--form").parsley().on("field:error", function() {
                let node = $(this)[0].$element;
                let parrent_error = node.parent();
                if (node.hasClass("taskPIC")) {
                    let error_msg = node
                        .parents(".col-lg-6")
                        .first()
                        .find(".parsley-errors-list")
                        .addClass("d-none")
                        .find("li")
                        .html();
                    node.parents(".col-lg-6")
                        .first()
                        .find(".invalid-feedback")
                        .addClass("d-block")
                        .html(error_msg);
                } else {
                    let error_msg = parrent_error
                        .find(".parsley-errors-list")
                        .addClass("d-none")
                        .find("li")
                        .html();
                    parrent_error
                        .find(".invalid-feedback")
                        .addClass("d-block")
                        .html(error_msg);
                }
            });

            $("#new-task--form").parsley().on("field:success", function() {
                let node = $(this)[0].$element;
                let parrent_error = node.parent();
                if (node.hasClass("taskPIC")) {
                    node.parent()
                        .find(".invalid-feedback")
                        .removeClass("d-block");
                } else {
                    parrent_error.find(".invalid-feedback").removeClass("d-block");
                }
            });




        });
    </script>
@endsection
