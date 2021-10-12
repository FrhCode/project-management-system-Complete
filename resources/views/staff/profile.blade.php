@extends('layouts.dashboard-master')

@section('content')

<div class="col-lg-6 p-0">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Profile</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body row">
            <div class="col-lg-4">
                <img src="{{ asset('img/'.$user->img) }}" alt="" width="100%">
            </div>
            <div class="col-lg-8">
                <div class="form-group">
                    <p>
                        <span class="font-weight-bold">Name : </span>
                        {{ $user->name }}
                    </p>
                </div>
                <div class="form-group">
                    <p>
                        <span class="font-weight-bold">Divisi : </span>
                        {{ $user->division->name }}
                    </p>
                </div>
                <div class="form-group">
                    <p>
                        <span class="font-weight-bold">Posisi : </span>
                        {{ $user->occupation->name }}
                    </p>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">«</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul>
        </div>
    </div>
</div>

@endsection

@section('js')

@endsection
