<?php

namespace App\Http\Controllers\User;

use App\Model\Common\Project;
use App\Model\User\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoteController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        $project = Project::findBySlug($slug)->firstOrFail();

        $note = Note::firstOrNew(['project_id' => $project->id]);
        $note->note = $request->input('note');
        $note->save();

        flash('Note Saved Successfully..!')->success();


        return redirect('pm/projects/' . $slug . '#notes');
    }


}
