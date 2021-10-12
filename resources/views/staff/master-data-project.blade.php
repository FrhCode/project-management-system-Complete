@extends('layouts.dashboard-master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Master data project</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered" id="master-data--table">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Task</th>
                        <th data-orderable="false">Progress</th>
                        <th style="width: 40px" data-orderable="false">Label</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($project as $item)
                        @php
                            $percentage = Helper::percentageTaskComplete($item->task, 'percentage');
                        @endphp
                        <tr data-id="{{ $item->id }}">
                            <td>{{ $loop->iteration }} </td>
                            <td><a href="project/{{ $item->id }}">{{ $item->name }}</a></td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" style="width: {{ $percentage }}"></div>
                                </div>
                            </td>
                            <td><span class="badge bg-danger">{{ $percentage }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

@section('js')
    <script>
        $('#master-data--table').DataTable();
    </script>

@endsection
