{{-- Add Modal Project --}}
<div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="addProjectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProjectModalLabel">Project Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="add_project_name">Name Project</label>
                    <input type="text" class="form-control" id="add_project_name" placeholder="Masukan nama project">
                    {{-- Error Message --}}

                </div>
                <div class="form-group">
                    <label for="add_project_detail">Project Detail</label>
                    <textarea id="add_project_detail" name="editordata" class="summernote"></textarea>
                    {{-- Error Message --}}

                </div>

                <div class="form-group">
                    <label for="add_project_project_date">Waktu Proyek</label>
                    <input readonly name='date' type="text" class="form-control" id="add_project_project_date"
                        aria-describedby="emailHelp" placeholder="Waktu Pengerjaan Project">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-action="submit">Create Event</button>
            </div>
        </div>
    </div>
</div>
{{-- End Add Modal Project --}}



{{-- Delete Project Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda Yakin akan menghapus Project Ini
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a href="/delete"><button type="button"
                        class="btn btn-danger delete-project--confirmation">Hapus</button></a>
            </div>
        </div>
    </div>
</div>
{{-- End Delete Project Modal --}}

{{-- Make Project Done Modal --}}
<div class="modal fade" id="projectDoneModal" tabindex="-1" aria-labelledby="projectDoneLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectDoneLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin project ini telah selesai?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-info helperProjecttDone">Yakin</button>
            </div>
        </div>
    </div>
</div>
{{-- End Make Project Done Modal --}}

{{-- Edit Project Modal --}}
{{-- <div class="modal fade" id="edit_project_modal" tabindex="-1" role="dialog" aria-labelledby="edit_project_modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_project_modalLabel">Edit Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/tes" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_project_name">Name Project</label>
                        <input type="text" class="form-control" id="edit_project_name"
                            placeholder="Masukan nama project" Value='BSDP 1' name='name'>
                        Error Message

                    </div>
                    <div class="form-group">
                        <label for="edit_project_detail">Project Detail</label>
                        <textarea id="edit_project_detail" name="editordata">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.

                        </textarea>
                        Error Message
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="sumbit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}
{{-- End Edit Project Modal --}}


{{-- Loading --}}
<div id="loader" class="d-flex justify-content-center align-items-center hide">
    <div class="text-center">
        <img src="{{ asset('img/loading-buffering.gif') }}" alt="">
        <div class="loader-text">
            <h1>Loading</h1>
            <h1 class="dot-spesial">.</h1>
            <h1 class="dot">.</h1>
            <h1 class="dot">.</h1>
            <h1 class="dot">.</h1>
            <h1 class="dot">.</h1>
            <h1 class="dot">.</h1>
            <h1 class="loader--number">0%</h1>

        </div>
    </div>
</div>

<!-- REQUIRED SCRIPTS -->


<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"
    integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- AdminLTE -->
<script src="{{ asset('js/adminlte.js') }}"></script>
{{-- Font Awosome --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
    integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
{{-- Moment JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
    integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- Full Calendar --}}
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.js"></script>

{{-- Date Range Picker --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

{{-- SummerNote --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"
    integrity="sha512-+cXPhsJzyjNGFm5zE+KPEX4Vr/1AbqCUuzAS8Cy5AfLEWm9+UI9OySleqLiSQOQ5Oa2UrzaeAOijhvV/M4apyQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{-- Select2 --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- Dropzone Js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"
    integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- FontAwosome --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/fontawesome.min.js" integrity="sha512-KCwrxBJebca0PPOaHELfqGtqkUlFUCuqCnmtydvBSTnJrBirJ55hRG5xcP4R9Rdx9Fz9IF3Yw6Rx40uhuAHR8Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

{{-- DataTable --}}
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js">
</script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>

{{-- Toastr --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@if (Session::get('success'))
<script>
    // Display a success toast, with a title
        toastr.success("{!! Session::get('success') !!}", 'PMS Project')
</script>
@endif
@if (Session::get('failed'))
<script>
    // Display a success toast, with a title
        toastr.error("{!! Session::get('failed') !!}", 'PMS Project')
</script>
@endif
{{-- Chart JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script> --}}

{{-- Parsley JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"
    integrity="sha512-Fq/wHuMI7AraoOK+juE5oYILKvSPe6GC5ZWZnvpOO/ZPdtyA29n+a5kVLP4XaLyDy9D1IBPYzdFycO33Ijd0Pg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('js/localeParsley.js') }}"></script>

{{-- Plugin data label pie chart js --}}
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
{{-- Custom JS --}}
<script src="{{ asset('js/custom.js') }}" type="module"></script>

@yield('modal')
@yield('js')

<!-- OPTIONAL SCRIPTS -->
{{-- <script src="plugins/chart.js/Chart.min.js"></script> --}}
<!-- AdminLTE for demo purposes -->
{{-- <script src="dist/js/demo.js"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="dist/js/pages/dashboard3.js"></script> --}}
</body>

</html>
