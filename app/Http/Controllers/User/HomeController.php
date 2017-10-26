<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Model\User\User;
use Carbon\Carbon;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = User::findorfail(auth()->user()->id);


        //pending projects Projects
        $pendingProjects =$user->projects()
            ->where('status', '=', 'open')
            ->count();

        //Total improgress
        $TotalOverdue = $user->projects()
            ->where('status', '!=', 'Complete')
            ->where('due_date', '<', Carbon::now())
            ->count();


        //Completed Projects
        $completedProjects = $user->projects()
            ->where('status', '=', 'Completed')
            ->count();

        //Total Projects
        $TotalProjects =$user->projects()->count();


        //all in one array
        $total = [
            'totalPending' => $pendingProjects,
            'totalOverdue' => $TotalOverdue,
            'totalCompleted' => $completedProjects,
            'totalProjects' => $TotalProjects
        ];


        //chart
        $chart =  Charts::multiDatabase('line', 'material')
            ->title('Projects By Month')
            ->dataset('Total Projects', $user->projects()->get())
            ->dataset('Pending Projects', $user->projects()
                ->where('status', '=', 'open')->get())
            ->dataset('Overdue Projects',$user->projects()
                ->where('status', '!=', 'Complete')
                ->where('due_date', '<', Carbon::now())->get())
            ->dataset('Completed Projects', $user->projects()
                ->where('status', '=', 'Completed')->get())
            ->groupByMonth();


        return view('user.home',compact('total','chart'));
    }

    public function profileEdit()
    {
        $id=Auth::user()->id;
        $pm=User::where('id', $id)->firstOrFail();
        return view('user.profile.edit', compact('pm'));
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

        $pm=User::where('id', $id)->firstOrFail();

        $pm->name=$request['name'];
        $pm->email=$request['email'];
        $pm->password=bcrypt($request['password']);

        $pm->save();


        return redirect()->route('home');

    }

}
