@extends('layouts.dashboard-master')

@section('content')
<div class="row">
    {{-- Todo --}}
    <div class="col-lg-4 mb-sm-5">
        <div class="card card-outline-todo">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">TODO</h3>
            </div>

            <!-- /.card-body -->
        </div>

        <div class="draggable-container" style="min-height: 20px;">
            @foreach ($tasks as $item)

            @if (!strcmp($item->status, 'todo'))
            <div @if (Helper::isTaskOwner($item->user_id))
                class="task mt-2 p-3 draggable" draggable='true' data-id = "{{ $item->id }}" @else
                class="task mt-2 p-3"
                @endif
                style="background: #fff;">
                <div class="font-italic">
                    <a href={{ "project/".$item->project->id}} class="project_detail"> {{ $item->project->name }}</a>
                </div>
                <div class="row justify-content-between">
                    <div class="col-9">
                        <p>{{ $item->name }}</p>
                        <span class=""> {{ $item->deadline->format('d-F-Y') }}</span>
                        <i class="
                                fas fa-hourglass-end fa-fw"></i>
                        <span class="text-{{ Helper::badgeColorDate($item->deadline) }}">
                            @if ($item->deadline->isPast())
                            Terlambat
                            @else
                            {{ $item->deadline->diffForHumans() }}
                            @endif
                        </span>
                    </div>
                    <div class="col-3 d-flex flex-row-reverse">
                        <img class="rounded-circle" src="{{ asset('img/' . $item->user->img) }}" alt=""
                            data-toggle="tooltip" data-placement="bottom" title="{{ $item->user->name }}"
                            style="width: 70px;height: 70px;">
                    </div>
                </div>
            </div>
            @endif
            @endforeach


        </div>

        <div class="task px-3 pt-2 text-secondary separator">
            Task
        </div>
    </div>

    {{-- On Progress --}}
    <div class="col-lg-4 mb-sm-5">
        <div class="card card-outline-progress">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">ON PROGRESS</h3>
            </div>


            <!-- /.card-body -->
        </div>
        <div class="draggable-container" style="min-height: 20px;">
            @foreach ($tasks as $item)
            @if (!strcmp($item->status, 'on progress'))
            <div @if (Helper::isTaskOwner($item->user_id))
                class="task mt-2 p-3 draggable" draggable='true' data-id = "{{ $item->id }}" @else
                class="task mt-2 p-3"
                @endif
                style="background: #fff;">
                <div class="font-italic">
                    <a href={{ "project/".$item->project->id}} class="project_detail"> {{ $item->project->name }}</a>
                </div>
                <div class="row justify-content-between">
                    <div class="col-9">
                        <p>{{ $item->name }}</p>
                        <span class=""> {{ $item->deadline->format('d-F-Y') }}</span>
                        <i class="
                            fas fa-hourglass-end fa-fw"></i>
                        <span class="text-{{ Helper::badgeColorDate($item->deadline) }}">
                            @if ($item->deadline->isPast())
                            Terlambat
                            @else
                            {{ $item->deadline->diffForHumans() }}
                            @endif
                        </span>
                    </div>
                    <div class="col-3 d-flex flex-row-reverse">
                        <img class="rounded-circle" src="{{ asset('img/' . $item->user->img) }}" alt=""
                            data-toggle="tooltip" data-placement="bottom" title="{{ $item->user->name }}"
                            style="width: 70px;height: 70px;">
                    </div>
                </div>
            </div>
            @endif
            @endforeach


        </div>

        <div class="task px-3 pt-2 text-secondary separator">
            Task
        </div>
    </div>

    {{-- Complete --}}
    <div class="col-lg-4 mb-sm-5">
        <div class="card card-outline-complete">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">COMPLETED</h3>
            </div>


            <!-- /.card-body -->
        </div>

        <div class="draggable-container" style="min-height: 20px;">
            @foreach ($tasks as $item)
            @if (!strcmp($item->status, 'completed'))
            <div @if (Helper::isTaskOwner($item->user_id))
                class="task mt-2 p-3 draggable" draggable='true' data-id = "{{ $item->id }}" @else
                class="task mt-2 p-3"
                @endif
                style="background: #fff;">
                <div class="font-italic">
                    <a href={{ "project/".$item->project->id}} class="project_detail"> {{ $item->project->name }}</a>
                </div>
                <div class="row justify-content-between">
                    <div class="col-9">
                        <p>{{ $item->name }}</p>
                        <span class=""> {{ $item->deadline->format('d-F-Y') }}</span>

                    </div>
                    <div class="
                            col-3 d-flex flex-row-reverse">
                        <img class="rounded-circle" src="{{ asset('img/' . $item->user->img) }}" alt=""
                            data-toggle="tooltip" data-placement="bottom" title="{{ $item->user->name }}"
                            style="width: 70px;height: 70px;">
                    </div>
                </div>
            </div>
            @endif
            @endforeach


        </div>

        <div class="task px-3 pt-2 text-secondary separator">
            Task
        </div>
    </div>
</div>



@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="upload-file-for-completed-task--modal" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="upload-file-for-completed-taskLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" id="file-task--completed" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="upload-file-for-completed-taskLabel">File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="m-0 mb-2 font-weight-bold starter-file-text-on-form-edit">File</p>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
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
                        <label class="btn btn-secondary">
                            <input class="file--file_task" type="file" multiple="multiple" style="display:none"
                                name='file[]'>
                            Files&hellip;
                        </label>
                        <small class='d-block font-italic'>*Silakan tekan close jika tidak ingin mengupload file</small>
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
@endsection
@section('js')
<script src="{{ asset('js/dragableTask.js') }}"></script>
@endsection
