<?php

namespace App\Http\Controllers\User;
use App\Model\Common\Project;
use App\Model\User\NetworkAssessment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NetworkAssessmentController extends Controller
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
        return view('user.networkAssessment.create', compact('slug'));
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
            'start_date' => 'required|date|after:yesterday',
            'end_date' => 'date|after:start_date|nullable',

        ]);

        $networkAssessment=new NetworkAssessment();
        $networkAssessment->title=$request->title;
        $networkAssessment->status=$request->status;
        $networkAssessment->start_date=$request->start_date;
        $networkAssessment->end_date=$request->end_date;
        $networkAssessment->comment=$request->comment;
        $networkAssessment->project_id=$project->id;
        $networkAssessment->save();

        flash('Network Assessment Created Successfully..!')->success();


        return redirect('pm/projects/'.$slug.'#network-assessment');
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
        $networkAssessment=$project->projectNetworkAssessment()->where('id',$id)->firstOrFail();
        return view('user.networkAssessment.show', compact('networkAssessment','slug'));
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
        $networkAssessment=$project->projectNetworkAssessment()->where('id',$id)->firstOrFail();
        return view('user.networkAssessment.edit', compact('networkAssessment','slug'));
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
            'start_date' => 'required|date',
            'end_date' => 'date|after:start_date|nullable',

        ]);

        $networkAssessment=$project->projectNetworkAssessment()->where('id',$id)->firstOrFail();
        $networkAssessment->title=$request->title;
        $networkAssessment->status=$request->status;
        $networkAssessment->start_date=$request->start_date;
        $networkAssessment->end_date=$request->end_date;
        $networkAssessment->comment=$request->comment;
        $networkAssessment->save();

        flash('Network Assessment Updated Successfully..!')->success();

        return redirect('pm/projects/'.$slug.'#network-assessment');
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
        $project->projectNetworkAssessment()->where('id',$id)->firstOrFail()->delete();
        flash('Network Assessment Deleted Successfully..!')->success();
        return redirect('pm/projects/'.$slug.'#network-assessment');
    }
}
