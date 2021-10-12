@extends('layouts.dashboard-master')

@section('content')

<div class="row">
    <div class="card col-lg-6 p-0">
        <form action="/user" method="post" enctype="multipart/form-data" id="edit-user--form" data-parsley-validate="">
            @csrf

            <div class="body py-3 px-4">
                @if($errors->any())
                {{ implode('', $errors->all('<div>:message</div>')) }}
                @endif
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="usrName">User Name</label>
                        <input type="text" autocomplete="off" class="form-control" id="usrName" placeholder="User Name"
                            name="usrName" data-parsley-required="true" data-parsley-minlength="3">
                        <div class="invalid-feedback bs-callout-warning">
                            Kolom ini wajib diisi
                        </div>
                    </div>

                    <div class="col-lg-6 mt-3 mt-lg-0">
                        <label for="name">Nama</label>
                        <input type="text" autocomplete="off" class="form-control" id="name" placeholder="Nama"
                            name="name" data-parsley-required="true" data-parsley-minlength="3">
                        <div class="invalid-feedback bs-callout-warning">
                            Kolom ini wajib diisi
                        </div>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="division--form">Divisi</label>
                        <select class="form-control" name="division_id" style="width: 100%" id="division--form"
                            data-parsley-required="true">
                            <option value="" selected disabled hidden>Pilih Divisi</option>
                            @foreach ($divisions as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback bs-callout-warning">
                            Kolom ini wajib diisi
                        </div>
                    </div>
                    <div class="col-lg-6 mt-3 mt-lg-0">
                        <label for="occupation--form">Jabatan</label>
                        <select class="form-control" name="occupation_id" style="width: 100%" id="occupation--form"
                            data-parsley-required="true">
                            <option value="" selected disabled hidden>Silakan Pilih Divisi Dahulu</option>

                            {{-- @foreach ($divisions as $item)
                            <option value="{{ $item->id }}" @if ($item->id == Auth::user()->division_id)
                            selected
                            @endif>{{ $item->name }}</option>
                            @endforeach --}}
                        </select>
                        <div class="invalid-feedback bs-callout-warning">
                            Kolom ini wajib diisi
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" autocomplete="off" class="form-control" id="password"
                        placeholder="Jika tidak ingin mengganti password silakan dikosongkan" name="password"
                        data-parsley-required="true" data-parsley-minlength="3">
                    <div class="invalid-feedback bs-callout-warning">
                        Kolom ini wajib diisi
                    </div>
                </div>

                <div class="form-group mb-0">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input edit-photo-user--form" id="customFile" name="img">
                        <label class="custom-file-label edit-photo-user--label text-black-50" for="customFile">Foto
                            Profil
                            (Kosongkan jika ingin menggunakan foto bawaan)
                        </label>
                    </div>
                </div>
            </div>



            <div class="bg-gray-light d-flex footer justify-content-between px-4 py-2">
                <a href="/data-user">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <span>
                            &lt;
                        </span>
                        Kembali
                    </button>
                </a>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>

        </form>
    </div>

</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
            bsCustomFileInput.init()

            $('#division--form').change(function() {
                let response = {
                    'division_id': $(this).val()
                }

                let occupationField = $('#edit-user--form #occupation--form')
                occupationField.empty()

                if (response.division_id == 1) {
                    occupationField.append(
                        `
                            <option value="1">admin</option>
                        `
                    )
                } else {
                    occupationField.append(
                        `
                            <option value="2">Team Leader</option>
                            <option value="3" selected>Team Member</option>
                        `
                    )


                }
            })

            $('#edit-user--form').parsley().on('field:error', function() {
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

            $("#edit-user--form").parsley().on("field:success", function() {
                let node = $(this)[0].$element;
                let parrent_error = node.parent();

                parrent_error.find(".invalid-feedback").removeClass("d-block");

            });
        });
</script>
@endsection
