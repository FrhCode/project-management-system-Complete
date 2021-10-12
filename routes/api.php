<?php

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use App\File;
use App\Task;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('project', function (Request $request) {

    // dd($request->all());
    $request->division_id = 2;
    $request->user_id = 3;
    $event = Project::select('id', 'name as title', 'start_date as start', 'FORMAT(end_date, "yyyy/MM/dd") as end', 'url', 'allDay', 'color')->Where('user_id', $request->user_id)->get();
    return response()->json($event, Response::HTTP_ACCEPTED);
    // return response()->json($request,Response::HTTP_ACCEPTED);
});

Route::get('get-user-task/{user}', function (User $user) {
    if ($user->division_id == 1) {
        return Task::with('project:id')->get(
            [
                'project_id as id',
                'name as title',
                \DB::raw('CONVERT(deadline, DATE) as start')
            ]
        );
    }
    return Task::where('user_id', $user->id)->with('project:id')->get(
        [
            'project_id as id',
            'name as title',
            \DB::raw('CONVERT(deadline, DATE) as start')
        ]
    );
});

// Route::post('file', function (Request $request) {
//     if ($request->has('file')) {
//         foreach ($request->file('file') as $key => $value) {
//             $images =$value;
//             // $images = $request->input('message');
//             $images_name = \Helper::randomName($value->getClientOriginalName(),strlen($value->getClientOriginalName())).'.'.$value->getClientOriginalExtension();
//             file::create([
//                 'name' => $images_name,
//                 'task_id' => 1,
//                 'title' => $value->getClientOriginalName() ,
//                 'size' => $value->getSize(),
//                 'extension' => $value->getClientOriginalExtension(),
//             ]);
//             $images->move(public_path('file'),$images_name);
//         }
//     }
//     return response()->json($request,Response::HTTP_ACCEPTED);
// });

Route::post('file', function (Request $request) {
    // if ($request->has('file')) {
    foreach ($request->file('file') as $key => $value) {
        // $images =$value;
        // $images = $request->input('message');
        $images_name = md5(microtime()) . '.' . $value->getClientOriginalExtension();
        // $images_name = $key.'.'.$value->getClientOriginalExtension();
        file::create([
            'name' => $images_name,
            'task_id' => 1,
            'title' => $value->getClientOriginalName(),
            'size' => $value->getSize(),
            'extension' => $value->getClientOriginalExtension(),
        ]);
        $value->move(public_path('file'), $images_name);
    }
    // }
    return response()->json($request, Response::HTTP_ACCEPTED);
});
