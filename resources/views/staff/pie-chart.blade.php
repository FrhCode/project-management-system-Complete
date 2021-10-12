<div class="card">
    <div class="card-header border-0">
        <div class="d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <h3 class="card-title">Pencapaian Target <strong>{{ $project->name }}</strong></h3>
            </div>
            <div style="width: 200px">
                <select class="select2-pie-chart" name="state" style="width: 100%">
                    @foreach ($projects as $value)
                    <option value="{{ $value->id }}" @if($project->name==$value->name)
                        selected
                        @endif>
                        {{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="position-relative mb-4">
            <canvas id="progress-chart" style="max-height: 400px" data-tercapai="{{ $project->tercapai }}"
                data-target="{{ $project->target }}"></canvas>
        </div>
        <div class="d-flex flex-row justify-content-end">
            <p>Target dari <strong>{{ $project->name }}</strong> adalah
                <strong>{{  number_format($project->target, 0, '.', ',') }}</strong> peserta terdidik</p>
        </div>
    </div>
</div>
