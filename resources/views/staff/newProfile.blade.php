@extends('layouts.dashboard-master')

@section('content')

<div class="row">

    <div class="col-12 col-lg-4">
        <div class="bg-white p-3 rounded shadow-sm text-center">
            <img src="{{ asset('img/'.$user->img) }}" alt="" class="" style=" border-radius: 50%; border:
                    .2rem solid gainsboro; width: 151px;height: 151px;">
            <div class="     mt-3">
                <span class="font-weight-bold">Keterangan</span>
                <ul>
                    <li style=" list-style: none; ">Gunakan foto yang tidak buram</li>
                    <li style=" list-style: none; ">Gunakan foto yang berukuran tidak terlalu besar</li>
                </ul>
            </div>
        </div>
    </div>
    <div class=" col-12 col-lg-8 mt-3 mt-lg-0">
        <div class="bg-white px-5 py-3 rounded shadow-sm">
            <div style="font-size: 1.8rem;" class="align-items-center d-flex font-weight-bold justify-content-between">
                Informasi Pribadi

                @if (Auth::user()->id == $user->id)
                <span class="text-muted hover" id="edit-hover" style="font-size: 1rem;" data-toggle="modal"
                    data-target="#editUserModal">
                    Ubah
                    <i class="fas fa-edit"></i></span>
                @endif
            </div>

            <div class="col-lg-8 mt-3 px-5" style="font-size: 1.4rem;">
                <div class="mb-3 row">
                    <div class="col">Nama </div>
                    {{-- @php
                    dd($user);
                    @endphp --}}
                    <div class="col">{{ $user->name }}</div>
                </div>

                <div class="mb-3 row">
                    <div class="col">Divisi </div>
                    <div class="col">{{ $user->division->name }}</div>
                </div>
                <div class="mb-3 row">
                    <div class="col">Posisi </div>
                    <div class="col">{{ $user->occupation->name }}</div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('modal')
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <form action="/user/{{ $user->id }}" method="post" enctype="multipart/form-data" id="edit-user--form"
        data-parsley-validate>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" autocomplete="off" class="form-control" id="name" placeholder="Nama"
                            name="name" data-parsley-required="true" data-parsley-minlength="3"
                            value="{{ $user->name }}">
                        <div class="invalid-feedback bs-callout-warning">
                            Kolom ini wajib diisi
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" autocomplete="off" class="form-control" id="password"
                            placeholder="Jika tidak ingin mengganti password silakan dikosongkan" name="password">
                        <div class="invalid-feedback bs-callout-warning">
                            Kolom ini wajib diisi
                        </div>
                    </div>

                    <div class="custom-file">
                        <p>Foto Profil</p>
                        <input type="file" class="custom-file-input edit-photo-user--form" id="customFile" name="img">
                        <label class="custom-file-label edit-photo-user--label" for="customFile">Foto Profil
                            (Kosongkan
                            jika tidak ingin
                            dirubah)</label>
                    </div>
                </div>



                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>

    </form>
</div>
@endsection

@section('js')

@endsection
