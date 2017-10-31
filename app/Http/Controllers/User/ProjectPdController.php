<?php

namespace App\Http\Controllers\User;

use App\Model\Common\Project;
use App\Model\User\Pd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ProjectPdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        return $slug;
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
            'status' => 'required',
            'date' => 'required|date|after:yesterday'

        ]);

        $pd=new Pd();
        $pd->status=$request->status;
        $pd->date=$request->date;
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
            'status' => 'required',
            'date' => 'required|date|after:yesterday'

        ]);

        $pd=$project->projectPd()->where('id',$id)->firstOrFail();
        $pd->status=$request->status;
        $pd->date=$request->date;
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

        return redirect('pm/projects/'.$slug.'#pd');
    }
}