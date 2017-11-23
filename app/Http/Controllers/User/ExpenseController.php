<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\UploadRequest;
use App\Model\Common\Project;
use App\Model\User\Expense;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ExpenseController extends Controller
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
        return view('user.expense.create', compact('slug'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadRequest $request, $slug)
    {
        $project = Project::findBySlug($slug)->firstOrFail();
        $expense = new Expense();
        $expense->expense_type = $request->expense_type;
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->date = $request->date;
        $expense->project_id = $project->id;


        if ($request->hasFile('image')) {

            $filename = uniqid();
            $extension = $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image')->move(config('constants.upload_path.attachments'), $filename . "." . $extension);
            $expense->attachment_url = $filename . "." . $extension;

        }

        $expense->save();

        flash('Expense Created Successfully..!')->success();


        return redirect('pm/projects/' . $slug . '#expenses');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $id)
    {
        $project = Project::findBySlug($slug)->firstOrFail();
        $expense = $project->projectExpenses()->where('id', $id)->firstOrFail();
        return view('user.expense.show', compact('expense', 'slug'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, $id)
    {
        $project = Project::findBySlug($slug)->firstOrFail();
        $expense = $project->projectExpenses()->where('id', $id)->firstOrFail();
        return view('user.expense.edit', compact('expense', 'slug'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UploadRequest $request, $slug, $id)
    {
        $project = Project::findBySlug($slug)->firstOrFail();
        $expense = $project->projectExpenses()->where('id', $id)->firstOrFail();

        $expense->expense_type = $request->expense_type;
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->date = $request->date;

        if ($request->hasFile('image')) {

            $filename = uniqid();
            $extension = $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image')->move(config('constants.upload_path.attachments'), $filename . "." . $extension);
            $expense->attachment_url = $filename . "." . $extension;

        }

        $expense->save();


        flash('Expense Updated Successfully..!')->success();

        return redirect('pm/projects/' . $slug . '#expenses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug, $id)    {

        $project = Project::findBySlug($slug)->firstOrFail();
        $expense=$project->projectExpenses()->where('id', $id)->firstOrFail();
        File::delete(public_path().'/'.config('constants.upload_path.attachments').$expense->attachment_url);
        $expense->delete();

        flash('Expense Deleted Successfully..!')->success();
        return redirect('pm/projects/' . $slug . '#expenses');
    }
}
