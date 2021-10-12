<?php

use App\Division;
use App\File as Files;
use App\Helper\Helper;
use App\Log;
use App\Occupation;
use App\Project;
use App\Task;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Auth;
use League\Flysystem\File;
use Mockery\Undefined;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::redirect('/', '/home');

Route::middleware(['auth'])->group(function () {

    Route::get('home', function () {


        //Buat di select2
        $projects = Project::where('status', 'on Progress')->get();
        // Buat Project summary || Pie Chart
        try {
            $project = $projects->random(1)->first()->load('task.user.division');
            $quarters = Helper::get_quarters($project->start_date, $project->end_date);
        } catch (\Throwable $th) {
            $project = '';
            $quarters = '';
        }
        // return $project;
        // return $project;

        //User Task
        $tasks = Auth::user()->task;

        $location = 'Dashboard';

        if (Auth::user()->occupation_id == 1) {
            $userCount =  User::count();
            $projectActiveCount =  Project::where('status', 'on Progress')->count();
            return view('staff.index', compact('project', 'quarters', 'projects', 'tasks', 'location', 'userCount', 'projectActiveCount'));
        }
        return view('staff.index', compact('project', 'quarters', 'projects', 'tasks', 'location'));
    });

    Route::get('task-list', function () {
        $projects = Project::where('status', 'on Progress')->get();
        // $tasks = Task::whereHas('user', function ($query) {
        //     $query->where('division_id', Auth::user()->division_id);
        // })->get();
        $tasks = Task::where('user_id', Auth::user()->id)->get();
        // return $tasks;
        // return Task::with('user')->get();
        // return $tasks;
        // return $tasks;
        // return Task::find(6)->project->name;

        $location = 'Task-list';
        return view('staff.task', compact('tasks', 'projects', 'location'));
    });

    Route::resource('task', TaskController::class)->except('store');
    Route::resource('project', ProjectController::class)->except('show')->middleware('isTeamLeader');
    Route::resource('project', ProjectController::class)->only('show');
    Route::resource('task-log/{task?}', TaskLogController::class)->only('store');
    Route::resource('division', DivisionController::class);
    Route::resource('user', UserController::class);

    Route::post('task/{project?}', 'TaskController@store');
    Route::get('ajax/pie-chart', function (Request $request) {
        $projects = Project::all();

        // Buat Project summary || Pie Chart
        $project = $projects->find($request->id);

        // Data Random buat ditampilin di Pie Chart
        return view('staff.pie-chart', compact('projects', 'project'));
    });

    Route::get('ajax/project-detail/{project}', function (Request $request, Project $project) {
        $project->update($request->all());

        $viewTercapai = view('staff.project-detail-tercapai', compact('project'))->render();
        $viewChart = view('staff.project-detail-chart', compact('project'))->render();

        return response()->json(['viewTercapai' => $viewTercapai, 'viewChart' => $viewChart]);
    });

    Route::get('ajax/project-progress', function (Request $request) {
        $projects = Project::all();
        $project = Project::where('id', $request->id)->with('task')->first();
        $quarters = Helper::get_quarters($project->start_date, $project->end_date);
        // return
        // return $project;
        return view('staff.project-progress', compact('projects', 'project', 'quarters'));
    });

    Route::get('/error', function () {
        return redirect()->back()->with('failed', 'Aksi tersebut tidak diizinkan');
    });

    Route::post('task/completed/{task}', 'TaskController@updatePost');

    Route::get('data-project', function () {
        $projects = Project::where('status', 'on Progress')->get();
        $project = Project::with('task')->get();

        $location = 'Project';
        return view('staff.master-data-project', compact('projects', 'project', 'location'));
    });

    Route::get('data-division', function () {
        $projects = Project::where('status', 'on Progress')->get();

        $location = 'Divisi';
        $divisions = Division::all();
        return view('staff.master-data-division', compact('projects',  'location', 'divisions'));
    });

    Route::get('data-user', function () {
        $projects = Project::where('status', 'on Progress')->get();
        $location = 'User';

        $users = User::where('occupation_id', '!=', 1)->orderBy('division_id')->with('division', 'occupation')->get();
        $divisions = Division::all();

        return view('staff.master-data-user', compact('projects',  'location', 'users', 'divisions'));
    });

    Route::get('team/{division}', function (Division $division) {
        $division->load('user.occupation');
        $projects = Project::where('status', 'on Progress')->get();

        $location = $division->name;


        return view('staff.division', compact('projects',  'location', 'division'));
    });

    Route::get('profile/{user}', 'UserController@show');

    // Route::get('/mkl', function () {
    //     $projects = Project::where('status', 'on Progress')->get();

    //     $location = 'Profile';

    //     $user = User::find(1);
    //     $divisions = Division::all();
    //     return view('staff.newProfile', compact('projects', 'location', 'user', 'divisions'));
    // });
});


// Web.php
Route::get('/tes', function (Request $request) {
    // return $request->all();
    return User::where('division_id', '!=', 1)->inRandomOrder()->first();
    // return User::find(3)->task;
    return Division::with('leader')->get();
    // return Project::with('task')->find(5);
    return view('staff.a');
    return Task::find(11)->log;
    return Files::where('name', ' c sSacSlet peSs tiest hCe ct.zip')->get();
    $file = Files::whereIn('id', [7, 8, 9])->get();
    $fileName = $file->pluck('name');

    $file->each->delete();
    return $fileName;


    $input = [
        'name' => "1im ungeryoieeJp Mgopayb rnaJMe .zip",
        'title' => "Membuat Learning Journey (1).zip",
        'size' => 4147885,
        'extension' => "zip",
        'status' => "finish",
        'task_id' => 1
    ];
    // return view('staff.a');
    return Files::create($input);
    return Files::find(1);
    $var = array();

    $person = new stdClass();
    $person->name   = "farhan";
    $person->age    = 22;
    $var[] = $person;
    unset($person);

    $person = new stdClass();
    $person->name   = "Zydan";
    $person->age    = 20;
    $var[] = $person;
    unset($person);

    $var = array_map(function ($item) {
        $item->height = 300;
        return $item;
    }, $var);
    return $var;
    $file = Task::find(23)->load('file');
    // return $file;
    return $file->file->where('status', 'finish');
    // dd(Task::where('id', 1)->get());
    dd(Task::find(1));
    return view('staff.a');
});

Route::post('tes', function (Request $request) {
    // re
    // dd($request->all());
    return 'Hello World';
    // return $request->all();
    $PostContent = $request->text;
    $output = nl2br($PostContent);

    return $output;

    return $request->all();
});

Route::get('project/edit', function () {
    return view('staff.project-edit');
});

// Route::get('/download/{task}', function (Task $task) {
//     // return $task;
//     $zip = new ZipArchive;
//     $fileName = $task->name . ".zip";
//     // return $fileName;
//     if ($zip->open(public_path($fileName), ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
//         $file = File::files(public_path('file'));
//         return $file;
//         foreach (Files::all() as $i => $data_from_db) {
//             foreach ($file as $j => $file_from_folder) {
//                 if (strcmp(basename($file_from_folder), $data_from_db->name) == 0) {
//                     $zip->addFile($file_from_folder, $i . '.' . $data_from_db->title);
//                 }
//             }
//         }
//     }

//     $zip->close();

//     return response()->download(public_path($fileName))->deleteFileAfterSend(true);
//     // return file_exists(public_path('css/adminlte.css'));
//     // return file_exists(public_path('css/adminlte.css'));
// });
// Route::get('/token', function () {
//     return csrf_token();
// });
Route::get('/download/{task}/{status?}', function (Task $task, $status = null) {
    // return 'hello world';
    set_time_limit(2000);
    $zip_file = $task->name . ".zip"; // Name of our archive to download
    $folder = 'file';
    $zip = new \ZipArchive();
    $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

    switch ($status) {
        case 'starter':
            $file = $task->file->where('status', 'starter');
            break;
        case  'finish':
            $file = $task->file->where('status', 'finish');
            break;
    }
    foreach ($file as $key => $value) {
        $location = $folder . "/" . $value->name;
        $fileName = $key + 1 . "." . $value->title;
        // return file_exists(public_path($location));
        $zip->addFile(public_path($location), $fileName);
    }
    // Adding file: second parameter is what will the path inside of the archive
    // So it will create another folder called "storage/" inside ZIP, and put the file there.
    // $zip->addFromString('test.txt', 'file content goes here');
    $zip->close();

    // We return the file immediately after download
    return response()->download($zip_file)->deleteFileAfterSend(true);
});





// Route::get('data-task', function () {
//     $projects = Project::where('status', 'on Progress')->get();
//     return view('staff.master-data-task', compact('projects'));
// });

Route::get('delete', function () {
    return redirect('/home')->with('status', 'Project Berhasil Dihapus');
});


Route::post('file-upload', function (Request $request) {
    if ($request->has('file')) {
        foreach ($request->file('file') as $key => $value) {
            $images = $value;
            // $images = $request->input('message');
            $images_name = \Helper::randomName($value->getClientOriginalName(), strlen($value->getClientOriginalName())) . '.' . $value->getClientOriginalExtension();
            file::create([
                'name' => $images_name,
                'task_id' => 1,
                'title' => $value->getClientOriginalName(),
                'size' => $value->getSize(),
                'extension' => $value->getClientOriginalExtension(),
            ]);
            $images->move(public_path('file'), $images_name);
        }

        // // $images_name = $request->input('fileName').'.'.$images->extension();
        // $images = $request->file('file');
        // $images_name = md5($images.time()).'.'.$images->extension();
        // $images->move(public_path('file'),$images_name);
        // file::create([
        //     'name' => $images_name,
        //     'task_id' => $request->task_id,
        //     'title' => $request->file('file')->getClientOriginalName(),
        // ]);
        // return response()->json($request,Response::HTTP_OK);
    }

    return response()->json($request, Response::HTTP_ACCEPTED);
});



Route::get('/logout', 'Auth\LoginController@logout');
