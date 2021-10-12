@extends('layouts.dashboard-master')

@section('content')
<div class="row">
    <div class="pr-lg-1 col-lg-6">
        <div class="card ">

            <div class="card-header">
                <h3 class="card-title">Master data project</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered" id="master-data--table">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 20%">Singkatan</th>
                            <th>Nama</th>
                            @if (Auth::user()->division_id == 1)
                            <th data-orderable="false">Edit</th>
                            <th data-orderable="false">Hapus</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @if (count($divisions))
                        @foreach ($divisions as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="/team/{{ $item->id }}">{{ $item->title }}</a></td>
                            <td>{{ $item->name }}</td>
                            @if (Auth::user()->division_id == 1)
                            <td class="text-center">
                                <a href="javascript:;">
                                    <i class="fas fa-edit edit-division--btn" data-toggle="modal"
                                        data-target="#editModal" data-id="{{ $item->id }}">
                                    </i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="javascript:;">
                                    <i class="fas fa-trash delete-division--btn" data-id="{{ $item->id }}"
                                        data-toggle="modal" data-target="#confirmationModal">
                                    </i>
                                </a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->

        </div>
    </div>

    @if (Auth::user()->division_id == 1)
    <div class="pl-lg-1 col-lg-6">
        <div class="card">
            <form action="/division" method="POST" data-parsley-validate>
                <div class="card-header">
                    <h3 class="card-title">Tambah data divisi</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" autocomplete="off" class="form-control" id="title" placeholder="Contoh : LSD"
                            name="title" data-parsley-required="true" data-parsley-minlength="3"
                            data-parsley-maxlength="5">
                        <div class="invalid-feedback bs-callout-warning">
                            Kolom ini wajib diisi
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" autocomplete="off" class="form-control" id="name"
                            placeholder="Contoh : Learning Designer" name="name" data-parsley-required="true"
                            data-parsley-minlength="4">
                        <div class="invalid-feedback bs-callout-warning">
                            Kolom ini wajib diisi
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer text-right">
                    <input type="submit" value="Submit" class="btn btn-primary">

                </div>
            </form>
        </div>
    </div>
    @endif
</div>

@endsection

@section('modal')

<!-- Modal delete division -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah kamu yakin akan menghapus kategori ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="/division/6" method="post" id="delete-division--form">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-primary">Ya, Lanjutkan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" data-parsley-validate method="POST" id="edit-division--form">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" autocomplete="off" class="form-control" id="title" placeholder="Title"
                            name="title" data-parsley-required="true" data-parsley-minlength="3">
                        <div class="invalid-feedback bs-callout-warning">
                            Kolom ini wajib diisi
                        </div>

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" autocomplete="off" class="form-control" id="name" placeholder="Nama"
                                name="name" data-parsley-required="true" data-parsley-minlength="3">
                            <div class="invalid-feedback bs-callout-warning">
                                Kolom ini wajib diisi
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    $('#master-data--table').DataTable();

        $('.delete-division--btn').click(function() {
            let divisionId = $(this).data('id')

            $('#delete-division--form').attr('action', `/division/${divisionId}`)
        })

        $('.edit-division--btn').click(function() {
            let divisionId = $(this).data('id');

            let form = $('#edit-division--form')
            let titleField = $('#edit-division--form #title');
            let nameField = $('#edit-division--form #name')


            $.ajax({
                type: "GET",
                url: `/division/${divisionId}`,
                success: function(response) {
                    // console.log(response);
                    form.attr('action',`/division/${response.id}`)
                    titleField.val(response.title)
                    nameField.val(response.name)
                }
            });
        });
</script>

@endsection
