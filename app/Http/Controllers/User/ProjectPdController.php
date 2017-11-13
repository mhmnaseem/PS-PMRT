<?php

namespace App\Http\Controllers\User;

use App\Model\Common\Project;
use App\Model\User\Pd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ProjectPdController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        return view('user.pd.create', compact('slug'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$slug)
    {
       $project=Project::findBySlug($slug)->firstOrFail();

        $this->validate($request,[
            'title' => 'required',
            'status' => 'required',
            'date' => 'required|date|after:yesterday'

        ]);


        $pd=new Pd();
        $pd->title=$request->title;
        $pd->status=$request->status;
        $pd->date=$request->date;
        $pd->day=$request->day;
        $pd->hour=$request->hour;
        $pd->comment=$request->comment;
        $pd->project_id=$project->id;
        $pd->save();


        flash('P&D Created Successfully..!')->success();


        return redirect('pm/projects/'.$slug.'#pd');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug,$id)
    {
        $project=Project::findBySlug($slug)->firstOrFail();
        $pd=$project->projectPd()->where('id',$id)->firstOrFail();
        return view('user.pd.show', compact('pd','slug'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug,$id)
    {
        $project=Project::findBySlug($slug)->firstOrFail();
        $pd=$project->projectPd()->where('id',$id)->firstOrFail();
        return view('user.pd.edit', compact('pd','slug'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug,$id)
    {
        $project=Project::findBySlug($slug)->firstOrFail();


        $this->validate($request,[
            'title' => 'required',
            'status' => 'required',
            'date' => 'required|date'

        ]);

        $pd=$project->projectPd()->where('id',$id)->firstOrFail();
        $pd->title=$request->title;
        $pd->status=$request->status;
        $pd->date=$request->date;
        $pd->day=$request->day;
        $pd->hour=$request->hour;
        $pd->comment=$request->comment;
        $pd->save();


        flash('P&D Updated Successfully..!')->success();

        return redirect('pm/projects/'.$slug.'#pd');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug,$id)
    {
        $project=Project::findBySlug($slug)->firstOrFail();
        $project->projectPd()->where('id',$id)->firstOrFail()->delete();
        flash('P&D Deleted Successfully..!')->success();
        return redirect('pm/projects/'.$slug.'#pd');
    }
}
