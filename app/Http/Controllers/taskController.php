<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\User;
use App\Assigntask;
use App\Http\Requests;
//use App\Http\Controllers\Auth;
use Session;
use Illuminate\Support\Facades\Redirect;


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
    	//$tasks = Task::orderBy('created_at', 'asc')->paginate(3)->where('user_id', '=', user()->id);
        $tasks = $request->user()->tasks()->paginate(3);
    	return view('tasks', ['tasks' => $tasks]);
    }

    public function addTask(Request $request) {
    	$task = new Task;
        $task->name = $request->name;
        $task->user_id = $request->user()->id;
        $task->save();
        //$request->user()->tasks()->create(['name' => $request->name,]);
	    Session::flash('msg', 'Task Successfully Added ');
    	return Redirect::to('/task');
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
        $task->save();
        Session::flash('msg', 'Task Successfully Assigned ');
        return Redirect::to('/assigntask');
    }

    //show user tasks an all users.
    public function showTaskToAssign(Request $request) {
        $users = User::all();
        $tasks = $request->user()->tasks()->get();
        $assignedTasks = Assigntask::paginate(3);
        return view('assigntask', ['tasks' => $tasks], ['users' => $users])
                ->with('assignedTasks', $assignedTasks);
    }

    public function deleteAssignedTast(Request $request) {
        $task = Assigntask::find($request->id);
        $task->delete();
        Session::flash('error_msg', 'Assigned Task Successfully Deleted ');
        return Redirect::to('/assigntask');
    }
}
