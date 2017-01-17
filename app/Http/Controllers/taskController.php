<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use DB;
use Auth;
use App\Task;
use App\User;
use App\Assigntask;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;


class taskController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function login(Request $request) {
		
		return view('login');
	}

	public function register(Request $request) {
		$user = new User;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = $request->password;
		$user->save();
		Session::flash('msg', 'Account Successfully Created');
    	return Redirect::to('/login');

	}

    public function showTask(Request $request) {
        $tasks = $request->user()->tasks()->orderBy('id', 'desc')->paginate(3);
    	return view('tasks', ['tasks' => $tasks]);
    }

    public function addTask(Request $request) {
    	$task = new Task;
        $task->name = $request->name;
        $task->expiry_date = date('Y-m-d', strtotime($request->input('expiry_date')));
        $task->user_id = $request->user()->id;  //or use Auth::user()->id
        $todays_date = Carbon::today()->format('Y-m-d');

        if ( $task->expiry_date < $todays_date) {
            Session::flash('error_msg', 'Date Already Passed ');
            return Redirect::to('/newtasks');
        }

        $task->save();
	    Session::flash('msg', 'Task Successfully Added ');
    	return Redirect::to('/task');
    }

    public function homeRefresh(Request $request) {
        $tasks = Task::where('status', '=', 'undone')->get();
        $todays_date = Carbon::today()->format('Y-m-d');

        foreach ($tasks as $key => $task) {
            if ($todays_date >= $task->expiry_date) {
                $toUpdate = Task::find($task->id);
                $toUpdate->status = 'expired';
                $toUpdate->save();
            }
        }

        return view('home');
    }

    public function updateStatus(Request $request) {
    	$task = Task::find($request->id);
    	$task->status = 'done';
    	$task->save();

    	return Redirect::to('/task');
    }

    public function deleteTast(Request $request) {
    	$task = Task::find($request->id);
    	$task->delete();
    	Session::flash('error_msg', 'Task Successfully Deleted ');
    	return Redirect::to('/task');
    }

    /*
        Assign task functions
    */
    public function assignTask(Request $request) {
        $task = new Assigntask;
        $task->user_id = $request->input('user_id');
        $task->task_id = $request->input('task_id');

        if ($task->user_id == 0 || $task->task_id == 0) {
            Session::flash('error_msg', 'Empty Assignment ');
            return Redirect::to('/assigntask');
        }

        $assignedtasks = DB::table('assigntasks')->where([
            ['user_id', '=', $task->user_id],
            ['task_id', $task->task_id],
        ])->count();
        if ($assignedtasks > 0) {
            Session::flash('error_msg', 'Task Already Assigned to: '.Str::title(Auth::user()->name).'' );
            return Redirect::to('/assigntask');
        }

        $task->save();
        Session::flash('msg', 'Task Successfully Assigned ');
        return Redirect::to('/assigntask');
    }

    //Display all user assigned tasks
    public function showTaskToAssign(Request $request) {
        $users = User::all();
        $tasks = $request->user()->tasks()->get();
        $assignedTasks = Assigntask::all();
        return view('assigntask', ['tasks' => $tasks], ['users' => $users])
                ->with('assignedTasks', $assignedTasks);
    }

    public function deleteAssignedTast(Request $request) {
        $task = Assigntask::find($request->id);
        $task->delete();
        Session::flash('error_msg', 'Assigned Task Successfully Deleted ');
        return Redirect::to('/assigntask');
    }

    public function getTaskId(Request $request) {
        // Get all the request data from the jquery.
        $ajax_task_id = $request->all();//or use $ajax_task_id = $request->input('task_id'); will catch only the id data
        $task_id = DB::table('tasks')
                    ->join('assigntasks', 'tasks.user_id', '=', 'assigntasks.user_id')
                    ->select('task_id')
                    ->get();
        if ( $ajax_task_id == $task_id ) {
            return response()->json(['task_id' => $task_id]);
        }
    }
}
