<?php

namespace App\Http\Controllers\User;

use App\Model\Common\Project;
use App\Model\User\OnsiteDeliveryGoLive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OnsiteDeliveryGoLiveController extends Controller
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
        return view('user.onsiteDeliveryGoLive.create', compact('slug'));
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
            'location' => 'required',
            'start_date' => 'required|date|after:yesterday',
            'end_date' => 'date|after:start_date|nullable',
            'status' => 'required',

        ]);

        $onsiteDeliveryGoLive=new OnsiteDeliveryGoLive();
        $onsiteDeliveryGoLive->title=$request->title;
        $onsiteDeliveryGoLive->location=$request->location;
        $onsiteDeliveryGoLive->start_date=$request->start_date;
        $onsiteDeliveryGoLive->end_date=$request->end_date;
        $onsiteDeliveryGoLive->status=$request->status;
        $onsiteDeliveryGoLive->comment=$request->comment;
        $onsiteDeliveryGoLive->project_id=$project->id;
        $onsiteDeliveryGoLive->save();

        flash('Onsite Delivery/Go Live Created Successfully..!')->success();


        return redirect('pm/projects/'.$slug.'#onsite-delivery-go-live');
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
        $onsiteDeliveryGoLive=$project->projectOnsiteDeliveryGoLive()->where('id',$id)->firstOrFail();
        return view('user.onsiteDeliveryGoLive.show', compact('onsiteDeliveryGoLive','slug'));
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
        $onsiteDeliveryGoLive=$project->projectOnsiteDeliveryGoLive()->where('id',$id)->firstOrFail();
        return view('user.onsiteDeliveryGoLive.edit', compact('onsiteDeliveryGoLive','slug'));
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
            'location' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'date|after:start_date|nullable',
            'status' => 'required'

        ]);

        $onsiteDeliveryGoLive=$project->projectOnsiteDeliveryGoLive()->where('id',$id)->firstOrFail();
        $onsiteDeliveryGoLive->title=$request->title;
        $onsiteDeliveryGoLive->location=$request->location;
        $onsiteDeliveryGoLive->start_date=$request->start_date;
        $onsiteDeliveryGoLive->end_date=$request->end_date;
        $onsiteDeliveryGoLive->status=$request->status;
        $onsiteDeliveryGoLive->comment=$request->comment;
        $onsiteDeliveryGoLive->save();

        flash('Onsite Delivery/Go Live Updated Successfully..!')->success();

        return redirect('pm/projects/'.$slug.'#onsite-delivery-go-live');
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
        $project->projectOnsiteDeliveryGoLive()->where('id',$id)->firstOrFail()->delete();
        flash('Onsite Delivery/Go Live Deleted Successfully..!')->success();
        return redirect('pm/projects/'.$slug.'#onsite-delivery-go-live');
    }
}
