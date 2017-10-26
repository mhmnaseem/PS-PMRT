<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findorfail(auth()->user()->id);

        //pending projects
        $pendingProjects = $user->projects()
            ->where('user_id', '=', null)
            ->where('status', '=', 'open')
            ->latest('id')->get();

        //assigned Projects
        $assignedProjects = $user->projects()
            ->where('user_id', '!=', null)
            ->latest('id')->get();

        //Completed Projects
        $completedProjects = $user->projects()
            ->where('user_id', '!=', null)
            ->where('status', '=', 'Completed')
            ->latest('id')->get();

        //all Projects
        $allProjects = $user->projects()
            ->latest('id')->get();

        //count results
        $total = [
            'totalPending' => count($pendingProjects),
            'totalAssigned' => count($assignedProjects),
            'totalCompleted' => count($completedProjects),
            'allProjects' => count($allProjects)

        ];



        return view('user.projects.index', compact('pendingProjects', 'assignedProjects', 'completedProjects', 'allProjects', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
