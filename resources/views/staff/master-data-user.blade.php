@extends('layouts.dashboard-master')

@section('content')
<div class="card ">

    <div class="align-items-center card-header row">
        <h3 class="card-title col">Master data user</h3>
        @if (Auth::user()->division_id == 1)
        <a href="/user/create" class="text-white">
            <button type="button" class="btn btn-secondary">
                Tambah User +
            </button>
        </a>
        @endif
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered" id="master-data--table">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th style="width: 20%">Name</th>
                    <th>Divisi</th>
                    <th>Jabatan</th>
                    @if (Auth::user()->division_id == 1)
                    <th style="width: 20px">Update</th>
                    <th style="width: 20px">Delete</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                <tr>
                    <td> {{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->division->name }}</td>
                    <td>{{ $item->occupation->name }}</td>
                    @if (Auth::user()->division_id == 1)
                    <td class="text-center">
                        <a href="javascript:;">
                            <i class="fas fa-edit edit-user--btn" data-id="{{ $item->id }}" data-toggle="modal"
                                data-target="#editUserModal"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="javascript:;">
                            <i class="fas fa-trash delete-user--btn" data-toggle="modal" data-target="#deleteUserModal"
                                data-id="{{ $item->id }}"></i>
                        </a>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->


</div>

@endsection

@section('modal')

<!-- Modal Confirmation -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus user ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="" method="post" id="delete-user--form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal edit user-->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <form action="/user/2" method="post" enctype="multipart/form-data" id="edit-user--form" data-parsley-validate>
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
                            name="name" data-parsley-required="true" data-parsley-minlength="3">
                        <div class="invalid-feedback bs-callout-warning">
                            Kolom ini wajib diisi
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-lg-6">
                            <label for="division--form">Division</label>
                            <select class="form-control" name="division_id" style="width: 100%" id="division--form">
                                @foreach ($divisions as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="occupation--form">Jabatan</label>
                            <select class="form-control" name="occupation_id" style="width: 100%" id="occupation--form">
                                {{-- @foreach ($divisions as $item)
                            <option value="{{ $item->id }}" @if ($item->id == Auth::user()->division_id)
                                selected
                                @endif>{{ $item->name }}</option>
                                @endforeach --}}
                            </select>
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
                        <label class="custom-file-label edit-photo-user--label" for="customFile">Foto Profil (Kosongkan
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
<script>
    bsCustomFileInput.init()

        $('#master-data--table').DataTable();

        $('.delete-user--btn').click(function() {
            let userId = $(this).data('id')

            $('#delete-user--form').attr('action', `/user/${userId}`)
        })

        $('.edit-user--btn').click(function() {
            let userId = $(this).data('id')

            let form = $('#edit-user--form');
            let nameField = $('#edit-user--form #name')
            let divisionField = $('#edit-user--form #division--form')
            let occupationField = $('#edit-user--form #occupation--form')
            let passwordField = $('#edit-user--form #password')

            form.attr('action', `/user/${userId}`)
            occupationField.empty()
            $.ajax({
                type: "GET",
                url: `/user/${userId}`,
                success: function(response) {
                    nameField.val(response.name)
                    $(divisionField.children()).removeAttr('selected');

                    $.each(divisionField.children(), function(indexInArray, valueOfElement) {
                        if ($(valueOfElement).attr('value') == response.division_id) {
                            $(valueOfElement).attr('selected', 'selected')
                        }
                    });

                    // jika divisi bernilai 1 (admin) maka jabatan cuman ada admin
                    if (response.division_id == 1) {
                        occupationField.append(
                            `
                        <option value="1">admin</option>
                    `
                        )
                    } else {
                        if (response.occupation_id == 2) {
                            occupationField.append(
                                `
                            <option value="2" selected>Team Leader</option>
                            <option value="3">Team Member</option>
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

                    }
                }
            });
        })

        $('#editUserModal').on('hidden.bs.modal', function(event) {
            $("#edit-user--form").parsley().reset();
            $('.edit-photo-user--form').val(null);
            $('.edit-photo-user--label').text("Foto Profil (Kosongkan jika tidak ingin dirubah)");
        })

        // Kalo kolom divisi berubah maka
        $('#edit-user--form #division--form').change(function() {
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
                if (response.occupation_id == 2) {
                    occupationField.append(
                        `
                            <option value="2" selected>Team Leader</option>
                            <option value="3">Team Member</option>
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
</script>

@endsection
