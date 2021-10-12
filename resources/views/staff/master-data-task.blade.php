@extends('layouts.dashboard-master')

@section('content')
<div class="card">
    <div class="card-header">
        {{-- <h3 class="card-title">
              DataTable with minimal features &amp; hover style
            </h3> --}}
        <button type="button" class="btn btn-success float-right add-task"><i class="fas fa-plus fa-fw"></i> Taks
            Baru</button>
    </div>
    <div class="card-body">
        <table id="tableProject" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Task Name</th>
                    <th>Project Name</th>
                    <th>Penanggung Jawab</th>
                    <th>Start Date</th>
                    <th>Due Date</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="project/detail">Buat Laporan</a></td>
                    <td><a href="project/detail">BSDP 1 Pinca</a></td>
                    <td>Agus</td>
                    <td>11-Jan-2021</td>
                    <td>11-March-2021</td>
                    <td>On Progress</td>
                </tr>
                <tr>
                    <td>Buat Laporan LJ</td>
                    <td>BSDP 0</td>
                    <td>Farhan</td>
                    <td>11-Mei-2021</td>
                    <td>11-Sep-2021</td>
                    <td>On Progress</td>
                </tr>
                <tr>
                    <td>Buat Materi</td>
                    <td>BSDP 1 Pinca</td>
                    <td>Firman</td>
                    <td>11-Feb-2021</td>
                    <td>11-Des-2021</td>
                    <td>On Progress</td>
                </tr>


        </table>
    </div>

</div>
@endsection

@section('js')

@endsection