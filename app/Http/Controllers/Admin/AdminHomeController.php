<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\Admin;
use App\Model\Common\Project;
use App\Model\Partner\Partner;
use App\Model\User\User;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminHomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth:admin');
    }

    public function index()
    {




        //pending projects Projects
        $pendingProjects =Project::where('user_id', '=', null)
            ->where('status', '=', 'open')
            ->count();

        //Total Projects
        $TotalProjects =Project::all()->count();

        //Total Projects
        $TotalPartners = Partner::all()->count();

        //Completed Projects
        $completedProjects = Project::where('user_id', '!=', null)
            ->where('status', '=', 'Complete')
            ->count();

        //all in one array
        $total = [
            'totalPending' => $pendingProjects,
            'totalCompleted' => $completedProjects,
            'totalProjects' => $TotalProjects,
            'totalPartners' => $TotalPartners

        ];


//        $chart = Charts::database($partner->projects()->get(), 'bar', 'highcharts')
//            ->title('Projects By Month')
//            ->elementLabel("Total")
//            ->dimensions(1000, 500)
//            ->responsive(false)
//            ->groupByMonth();


        //chart
        $chart =  Charts::multiDatabase('line', 'material')
            ->title('Projects By Month')
            ->dataset('Total Projects', Project::all())
            ->dataset('Pending Projects', Project::where('user_id', '=', null)
                ->where('status', '=', 'open')->get())
            ->dataset('Completed Projects', Project::where('user_id', '!=', null)
                ->where('status', '=', 'Complete')->get())
            ->groupByMonth();




        return view('admin.home', compact('total','chart'));
    }

    public function profileEdit()
    {
        $id=Auth::user()->id;
        $admin=Admin::where('id', $id)->firstOrFail();
        return view('admin.profile.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request)
    {
        $id=Auth::user()->id;
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,id,'.$id,
            'password' => 'required|string|min:6|confirmed',
        ]);

        $admin=Admin::where('id', $id)->firstOrFail();

        $admin->name=$request['name'];
        $admin->email=$request['email'];
        $admin->password=bcrypt($request['password']);

        $admin->save();


        return redirect()->route('admin.home');

    }
}
