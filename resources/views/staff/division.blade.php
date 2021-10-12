@extends('layouts.dashboard-master')

@section('content')

<div class="row">
    @foreach ($division->user as $item)
    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
            <div class="card-body ">
                <div class="row">
                    <div class="col-7 align-self-md-center">
                        <h2 class="lead">
                            <b>{{ $item->name }}</b><br>
                            <span>({{ $item->occupation->name }})</span>
                        </h2>
                    </div>
                    <div class="col-5 text-center">
                        <img src="{{ asset('img/'.$item->img) }}" alt="user-avatar" class="img-circle img-fluid"
                            style="width: 116px; height: 116px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>@endsection

@section('js')

@endsection
