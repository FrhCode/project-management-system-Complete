<?php

namespace App\Http\Controllers;

use App\Division;
use App\Project;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::where('status', 'on Progress')->get();
        $location = 'Tambah User';

        $divisions = Division::all();
        return view('staff.user-create', compact('projects', 'location', 'divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'usrName' => 'required|unique:users',
            'name' => 'required',
            'division_id' => 'required',
            'occupation_id' => 'required',
            'img' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'password' => 'required',
        ]);

        // Kalo g ada poto, hapus key nya, password juga sama
        $input = '';
        if ($request->has('img')) {

            $fileName = uniqid() . $request->img->getClientOriginalName();
            $request->img->move(public_path('img'), $fileName);


            $input = $request->except('img');
            $input['img'] = $fileName;
        } else
            $input = $request->all();

        $input['password'] = bcrypt($input['password']);
        // dd($input);
        User::create($input);

        return redirect('/data-user')->with('success', 'Data berhasil diubah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // $projects = Project::where('status', 'on Progress')->get();

        // $location = 'Profile';


        // return view('staff.profile', compact('projects',  'location', 'user'));

        $projects = Project::where('status', 'on Progress')->get();

        $location = 'Profile';

        $divisions = Division::all();
        return view('staff.newProfile', compact('projects', 'location', 'user', 'divisions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //

        $validatedData = $request->validate([
            'name' => 'required',
            'division_id' => 'required',
            'occupation_id' => 'required',
            'img' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        // Kalo g ada poto, hapus key nya, password juga sama
        $input = '';
        if ($request->has('img')) {

            $fileName = uniqid() . $request->img->getClientOriginalName();
            $request->img->move(public_path('img'), $fileName);


            $input = $request->except('img');
            $input['img'] = $fileName;
        } else
            $input = $request->all();

        $input['password'] = bcrypt($input['password']);

        if ($request->password == null) {
            unset($input['password']);
        }
        $user->update($input);

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
