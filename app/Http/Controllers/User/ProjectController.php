<?php

namespace App\Http\Controllers\User;

use App\Model\User\User;
use Carbon\Carbon;
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

        //star projects
        $starProjects =$user->projects()
            ->where('star', '=', 1)
            ->get();


        //pending projects
        $pendingProjects =$user->projects()
            ->where('status', '=', 'Open')
            ->get();

        // Overdue Projects
        $overdueProjects = $user->projects()
            ->where('status', '!=', 'Complete')
            ->where('due_date', '<', Carbon::now())
            ->get();

        //Completed Projects
        $completedProjects = $user->projects()
            ->where('status', '=', 'Completed')
            ->get();

        //All Projects
        $allProjects =$user->projects()->get();



        //count results and put in array
        $total = [
            'totalPending' => count($pendingProjects),
            'totalOverdue' => count($overdueProjects),
            'totalCompleted' => count($completedProjects),
            'allProjects' => count($allProjects)

        ];



        return view('user.projects.index', compact('starProjects','pendingProjects', 'overdueProjects', 'completedProjects', 'allProjects', 'total'));
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
