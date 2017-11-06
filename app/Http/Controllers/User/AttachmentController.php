<?php

namespace App\Http\Controllers\User;

use App\Model\Common\Project;
use App\Model\User\Attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AttachmentController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        return view('user.attachment.create', compact('slug'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        $project = Project::findBySlug($slug)->firstOrFail();

        $this->validate($request, [

            'title' => 'required',
            'attachment' => 'required|size:5000'

        ]);

        $filename = uniqid();

        $attachment = new Attachment();
        if ($request->hasFile('attachment')) {
            $extension = $request->file('attachment')->getClientOriginalExtension();
            $file = $request->file('attachment')->move(config('constants.upload_path.attachments'), $filename . "." . $extension);
            $attachment->attachment_url = $filename . "." . $extension;
        }

        $attachment->title = $request->title;
        $attachment->project_id = $project->id;
        $attachment->save();


        flash('Attachment Created Successfully..!')->success();


        return redirect('pm/projects/' . $slug . '#attachments');
    }


    public function download($slug, $id)
    {

        $project = Project::findBySlug($slug)->firstOrFail();

        $attachment = $project->projectAttachment()->where('id', $id)->firstOrFail();

        $file = public_path().'/'. config('constants.upload_path.attachments') . $attachment->attachment_url;


        if(File::exists($file)){
            return response()->download($file);

        } else {
            flash('Attachment Download Error..!')->error();
            return redirect('pm/projects/' . $slug . '#attachments');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug, $id)
    {
        $project = Project::findBySlug($slug)->firstOrFail();
        $attachment=$project->projectAttachment()->where('id', $id)->firstOrFail();
        File::delete(public_path().'/'.config('constants.upload_path.attachments').$attachment->attachment_url);
        $attachment->delete();

        flash('Attachment Deleted Successfully..!')->success();
        return redirect('pm/projects/' . $slug . '#attachments');
    }
}
