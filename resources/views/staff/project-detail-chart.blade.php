<div class="row mt-3">
    <div class="card col-lg-6">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between pt-3">
                <div class="d-flex align-items-center">
                    <h3 class="card-title">Pencapaian Target <strong>{{ $project->name }}</strong></h3>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="position-relative mb-4">
                <canvas id="progress-chart" style="max-height: 400px" data-tercapai="{{ $project->tercapai }}"
                    data-target="{{ $project->target }}"></canvas>
            </div>
            <div class="d-flex flex-row justify-content-end">
                <p class="m-0">Target dari <strong>{{ $project->name }}</strong> adalah
                    <strong>{{ number_format($project->target, 0, '.', ',') }}</strong> peserta terdidik
                </p>
            </div>
        </div>
    </div>

</div>

<script type="module">
    import * as chart from "{!! asset('js/chart.js') !!}";
    $(document).ready(function() {
        const target = {!! $project->target !!}
        const tercapai = {!! $project->tercapai !!}
        const sisa = target - tercapai;
        chart.pieChart(target, tercapai, sisa);

        // console.log('terpanggil');

    });
</script>
