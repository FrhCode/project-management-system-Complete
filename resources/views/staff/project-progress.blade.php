<div class="card">
    <div class="card-header-manual border-0 d-flex justify-content-between">
        <div>
            <h3 class="card-title">Project Progress <strong>{{ $project->name }}</strong></h3>
            <p>Sekarang : <strong>{{ \Helper::get_quarter_for_spesific_date(Carbon\carbon::now()) }}</strong></p>
        </div>
        <div style="width: 250px">
            <select class="select2-project-progress" name="state" style="width: 100%">
                @foreach ($projects as $item)
                <option value="{{ $item->id }}" @if($project->name==$item->name)
                    selected
                    @endif>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="bg-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Todo List</th>
                        @foreach ($quarters as $quarter)
                        <th>{{ $quarter->period }}</th>
                        @endforeach
                        <th scope="col">Team in Charge</th>
                    </tr>
                </thead>
                <tbody id="plp" data-helper="{{ $project->id }}">
                    @foreach ($project->task as $task)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $task->name }}</td>
                        @foreach ($quarters as $quarter)
                        {{-- Bandingin apakah task sekarang memiliki deadline pada looping quarter sekarang --}}
                        <th @if (!strcmp($quarter->period,Helper::get_quarter_for_spesific_date($task->deadline)))
                            style="background: #d4d0c7"
                            @endif
                            ></th>
                        {{-- <th>{{ Helper::get_quarter_for_spesific_date($task->created_at) }}</th> --}}
                        @endforeach
                        <td>{{ $task->user->division->title }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
