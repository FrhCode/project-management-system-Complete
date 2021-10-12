@extends('layouts.dashboard-master')

@section('content')
    {{-- Main Menu --}}

    <form action="/project" method="post" id="create-project--form" data-parsley-validate="" enctype="multipart/form-data">
        @csrf
        <div class="row project-container transition-5">
            {{-- Sisi Kiri --}}
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Project</h3>
                    </div>
                    <div class="card-body">
                        {{-- Input nama --}}
                        <div class="form-group">
                            <label for="name">Project Name</label>
                            <input type="text" autocomplete="off" class="form-control" id="name" placeholder="Project Name"
                                name="project_name" data-parsley-required="true" data-parsley-minlength="6">
                            <div class="invalid-feedback bs-callout-warning">
                                Kolom ini wajib diisi
                            </div>
                        </div>
                        {{-- Input Target --}}
                        <div class="form-group">
                            <label for="target">Target Participants</label>
                            <input type="text" autocomplete="off" class="form-control" id="target"
                                placeholder="target participants" data-parsley-required="true">
                            <input type="text" autocomplete="off" class="form-control d-none" id="target--real"
                                placeholder="target participants" name='project_target' data-parsley-required="true">
                            <div class="invalid-feedback bs-callout-warning">
                                Kolom ini wajib diisi
                            </div>
                        </div>
                        {{-- Input Desktipsi --}}
                        <div class="form-group">
                            <label for="add_project_detail">Project Detail</label>
                            <textarea class="form-control" id="add_project_detail" rows="5" name="project_description"
                                data-parsley-required data-parsley-minlength="10"></textarea>
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
                                    placeholder="Deadline" name="project_end_date" readonly>
                                <div class="input-group-prepend ">
                                    <div class="input-group-text disable project--dateDiff">0 Day</i></div>
                                </div>
                            </div>
                            <div class="invalid-feedback">
                                Kolom ini wajib diisi
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            {{-- Sisi Kanan --}}
            <div class="col-lg-6">
                <div class="card card-secondary" style="display: none">
                    <div class="card-header">
                        <h3 class="card-title">Task</h3>

                        <div class="card-tools">
                            <div class="icon" style="color: #ffffff" id="add-task-for-project"><i
                                    class="fas fa-plus"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="card--add_task pb-1" style="display: none">
                                <div class="d-flex justify-content-between">
                                    <p class="font-weight-bold text-dark mb-1 task--number">Task</p><i
                                        class="fas fa-times icon icon--deleteTask"></i>
                                </div>
                                {{-- Task Name --}}
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Task Name" name="task_name[]"
                                        data-parsley-required data-parsley-minlength="6">
                                    <div class="invalid-feedback ">
                                        Kolom ini wajib diisi
                                    </div>
                                </div>

                                {{-- PIC dan Deadline --}}
                                <div class="form-row mb-3">
                                    <div class="col-lg-6 mb-3 mb-lg-0">
                                        <select class="taskPIC" name="task_user_id[]" style="width: 100%"
                                            data-parsley-required>
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
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"> <i class="fas fa-calendar"></i></div>
                                            </div>
                                            <input type="text" autocomplete="off" class="form-control project-task-deadline"
                                                placeholder="Deadline" name="task_end_date[]" readonly>
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
                                    {{-- <label for="add_project_detail">Project Detail</label> --}}
                                    <textarea name="task_description[]" class="form-control" rows="5"
                                        placeholder="Task Description..." data-parsley-required
                                        data-parsley-minlength="10"></textarea>
                                    <div class="invalid-feedback ">
                                        Kolom ini wajib diisi
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label
                                        class="btn btn-primary my-file-selector
                                    my-file-selector">
                                        <input class="file--file_task" type="file" multiple="multiple" style="display:none"
                                            name='task_attached_file[]'>
                                        Files&hellip;
                                    </label>
                                    <span class='label label-info' class="upload-file-info"></span>
                                    <input type="text" name="task_jumlah_file[]" class="jml_file d-none" value="0">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            {{-- Sisi Kanan --}}
        </div>
        <div class="row">
            <div class="col-lg-6 form--submit-div transition-5 text-right">
                <input type="submit" value="Submit" class="btn btn-secondary add_project__submit_button ">
                <input type="submit" value="Add Task" class="transition-5 btn btn-primary add_project__add_task_button">
            </div>
        </div>
    </form>




@endsection

@section('js')
    <script type="module">
        import * as daterangepicker from "{!! asset('js/date-range-picker.js') !!}";
        import * as projectAddTask from "{!! asset('js/project-addTask.js') !!}";
        import * as numberInput from "{{ asset('js/numberInput.js') }}"
        $(document).ready(function() {
            daterangepicker.projectCreate();
            projectAddTask.init();
            projectAddTask.select2AddTaskEvent();
            projectAddTask.deleteButton();
            numberInput.init($('#target'), $('#target--real'));
        });
    </script>

    @if (Session::has('success'))
        <script>
            toastr.options = {
                "closeButton": true
            }
            toastr.success("{{ Session::get('success') }}", "PMS Project");
        </script>
    @endif

    <script src="{{ asset('js/project-create.js') }}">

    </script>
@endsection
