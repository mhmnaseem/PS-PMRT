<?php

namespace App\Http\Controllers\Partner;

use App\Model\Common\Project;
use App\Model\Partner\Partner;
use App\Model\User\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Charts;

class PartnerHomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:partner');
    }

    public function index()
    {

        $partner = Partner::findorfail(auth()->user()->id);


        //pending projects Projects
        $pendingProjects =$partner->projects()
            ->where('user_id', '=', null)
            ->where('status', '=', 'open')
            ->count();

        //Total Projects
        $TotalProjects =$partner->projects()->count();

        //Total PMS
        $TotalPms = $partner->pms()->count();

        //Completed Projects
        $completedProjects = $partner->projects()
            ->where('user_id', '!=', null)
            ->where('status', '=', 'Complete')
            ->count();

        //all in one array
        $total = [
            'totalPending' => $pendingProjects,
            'totalCompleted' => $completedProjects,
            'totalProjects' => $TotalProjects,
            'totalPms' => $TotalPms

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
            ->dataset('Total Projects', $partner->projects()->get())
            ->dataset('Pending Projects', $partner->projects()->where('user_id', '=', null)
                ->where('status', '=', 'open')->get())
            ->dataset('Overdue Projects',$partner->projects()
                ->where('status', '!=', 'Complete')
                ->where('due_date', '<', Carbon::now())->get())
            ->dataset('Completed Projects', $partner->projects()->where('user_id', '!=', null)
                ->where('status', '=', 'Complete')->get())
            ->groupByMonth();

        return view('partner.home', compact('total','chart'));
    }

    public function profileEdit()
    {
        $id = Auth::user()->id;
        $partner = Partner::where('id', $id)->firstOrFail();
        return view('partner.profile.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,id,' . $id,
            'password' => 'required|string|min:6|confirmed',
        ]);

        $partner = Partner::where('id', $id)->firstOrFail();

        $partner->name = $request['name'];
        $partner->email = $request['email'];
        $partner->password = bcrypt($request['password']);

        $partner->save();


        return redirect()->route('partner.home');

    }

}
