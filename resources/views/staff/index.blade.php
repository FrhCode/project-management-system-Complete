@extends('layouts.dashboard-master')

@section('content')

<div class="row">
    {{-- Bagian Kiri --}}
    <div class="col-lg-6">
        {{-- Kotak Kecil buat tugas2 --}}
        <div class="row">

            @if (Auth::user()->occupation_id == 1)
            <div class="col-lg-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $userCount }}</h3>

                        <p>User</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $projectActiveCount }}</h3>

                        <p>Project sedang berjalan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                </div>
            </div>

            @else
            <div class="col-lg-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $tasks->count() }}</h3>

                        <p>Tugas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $tasks->where('created_at', '>=', \Carbon\Carbon::today())->count() }}</h3>

                        <p>Tugas Baru</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                </div>
            </div>
            @endif

        </div>
        {{-- Kotak Kecil buat tugas2 --}}

        {{-- Todo Card --}}
        @if (Auth::user()->division_id != 1)
        <div class="card card-primary card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-three-todo-tab" data-toggle="pill"
                            href="#custom-tabs-todo-home" role="tab" aria-controls="custom-tabs-todo-home"
                            aria-selected="true">To Do</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-onProgress-tab" data-toggle="pill"
                            href="#custom-tabs-three-onProgress" role="tab" aria-controls="custom-tabs-three-onProgress"
                            aria-selected="false">On Progress</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-complete-tab" data-toggle="pill"
                            href="#custom-tabs-three-complete" role="tab" aria-controls="custom-tabs-three-complete"
                            aria-selected="false">Done</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade active show" id="custom-tabs-todo-home" role="tabpanel"
                        aria-labelledby="custom-tabs-three-todo-tab">
                        <ul class="todo-list ui-sortable" data-widget="todo-list">

                            @foreach ($tasks as $item)
                            @if (!strcmp($item->status, 'todo'))
                            <li class="">

                                <div class=" icheck-primary d-inline
                                    ml-2">

                                    <label for="todoCheck2"></label>
                                </div>
                                <span class="text">{{ $item->name }}</span>
                                <small class="badge badge-{{ Helper::badgeColorDate($item->deadline) }}">
                                    <i class="far fa-clock mr-1"></i>
                                    {{ \Carbon\Carbon::createFromTimeStamp(strtotime($item->deadline))->diffForHumans() }}
                                </small>

                            </li>

                            @endif
                            @endforeach

                        </ul>
                    </div>

                    <div class="tab-pane fade" id="custom-tabs-three-onProgress" role="tabpanel"
                        aria-labelledby="custom-tabs-three-onProgress-tab">
                        <ul class="todo-list ui-sortable" data-widget="todo-list">
                            @foreach ($tasks as $item)
                            @if (!strcmp($item->status, 'on progress'))
                            <li class="" style="">
                                <!-- drag handle -->

                                <!-- checkbox -->
                                <div class="





                                         icheck-primary d-inline ml-2">

                                    <label for="todoCheck1"></label>
                                </div>
                                <!-- todo text -->
                                <span class="text">{{ $item->name }}</span>
                                <!-- Emphasis label -->
                                <small class="badge badge-{{ Helper::badgeColorDate($item->deadline) }}"> <i
                                        class="far fa-clock mr-1"></i>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($item->deadline))->diffForHumans() }}
                                </small>
                                <!-- General tools such as edit or delete-->

                            </li>

                            @endif
                            @endforeach


                        </ul>
                    </div>

                    <div class="tab-pane fade" id="custom-tabs-three-complete" role="tabpanel"
                        aria-labelledby="custom-tabs-three-complete-tab">
                        <ul class="todo-list ui-sortable" data-widget="todo-list">
                            @foreach ($tasks as $item)
                            @if (!strcmp($item->status, 'completed'))
                            <li class="" style="">
                                <div class="  icheck-primary d-inline ml-2">
                                    <label for="todoCheck1"></label>
                                </div>
                                <!-- todo text -->
                                <span class="text">{{ $item->name }}</span>
                                <!-- Emphasis label -->
                                <small class="badge badge-{{ Helper::badgeColorDate($item->deadline) }}"> <i
                                        class="far fa-clock mr-1"></i>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($item->deadline))->diffForHumans() }}
                                </small>
                                <!-- General tools such as edit or delete-->

                            </li>

                            @endif
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        @endif
        {{-- Todo Card --}}

        {{-- chart Card --}}
        @if ($project)
        <div id="ajax-pie-chart">
            @include('staff.pie-chart')
        </div>
        @endif
        {{-- chart Card --}}


    </div>
    {{-- End Bagian Kiri --}}

    {{-- Bagian Kanan --}}
    <div class="col-lg-6">
        {{-- Card Calendar --}}
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <span class="text-bold text-lg">Agenda</span>
                    <a href="javascript:void(0);">View Report</a>
                </div>
            </div>
            <div class="card-body">
                <div class="position-relative mb-4">
                    <div id='calendar'></div>
                </div>
            </div>

        </div>
        {{-- End Card Calendar --}}

        {{-- Project Proggress --}}

        {{-- End Project Proggress --}}
    </div>
    {{-- End Bagian Kanan --}}
</div>

@if ($project)
<div id="ajax-project-progress">
    @include('staff.project-progress')
</div>
@endif

@endsection

@section('js')
<script>
    let user = {!! Auth::user() !!}
</script>

<script src="{{ asset('js/dashboard-fc.js') }}"></script>

<script type="module">
    import * as activeLink from "{!! asset('js/activeLink.js') !!}";
        import * as select2 from "{!! asset('js/select2.js') !!}";
        import * as chart from "{!! asset('js/chart.js') !!}";
        $(document).ready(function() {
            select2.select2PieChart();
            select2.select2ProjectProgress();
            select2.select2ModalTask();

            chart.init(activeLink.path);
        });
    </script>

@endsection
