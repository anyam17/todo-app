@extends('layouts.main')

@section('content')

<script type="text/javascript">
    function getTask(task_id) {
        console.log(task_id.value);
        //alert(task_id.value);
    }

    $.ajax({
    method: 'GET', // Type of response and matches what we said in the route
    url: '/assigntask/update', // This is the url we gave in the route
    data: {'task_id' : task_id}, // a JSON object to send back

    });
</script>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
		    <form role="form" method="post" action="/assigntask/assignedtask">
		        {{ csrf_field() }}
		    	<div class="col-sm-6">
		      		<div class="panel panel-info">
		        		<div class="panel-heading">
		          			<h3 class="panel-title">All Users</h3>
		        		</div>
		        		<div class="panel-body">
			              	<select name="user_id" class="form-control">
                                <option>Select user</option>
		                		@foreach ($users as $user)
		                			<option value="{{ $user->id }}"> {{ $user->name }} </option>
		                		@endforeach
		                	</select>
			            </div>
		      		</div>
		    	</div>
		    	<div class="col-sm-6">
		      		<div class="panel panel-info">
		        		<div class="panel-heading">
		          			<h3 class="panel-title">My Tasks</h3>
		        		</div>
		        		<div class="panel-body">
			              	<select name="task_id" class="form-control" onchange="getTask(this);">
                                <option selected>Select task</option>
		                		@foreach ($tasks as $task)
		                			<option value="{{ $task->id }}"> {{ $task->name }} </option>
		                		@endforeach
		                	</select>
			            </div>
		      		</div>
		    	</div>
		    	<div align="center" style="padding-top: 0px">
		    		<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Assign Task </button>
		    	</div>
            </form>

            <div style="height: 10px;">
                @if(Session::has('msg'))
                    <div class="alert alert-success" id="alert">{{ Session::get('msg') }}</div>
                @endif
                @if(Session::has('error_msg'))
                    <div class="alert alert-danger" id="alert">{{ Session::get('error_msg') }}</div>
                @endif
            </div>  
            <div class="panel panel-default" style="margin-top: 20px">
                <div class="panel-heading" style="font-size: 20px">
                    Assigned Tasks
                </div>
                @if (count($tasks) > 0)
                    <div class="panel-body" style="padding-bottom: 0px; ">
                        <table class="table table-striped">
                            <!-- Table Headings -->
                            <thead style="font-size: 11px "> 
                                <th>USER</th>
                                <th>TASKS</th>
                                <th>ASSIGNED AT</th>
                                <th>ACTION</th>
                            </thead>
                            <!-- Table Body -->
                            <tbody style="padding-bottom: 0px; font-size: 13px; ">
                                @foreach ($assignedTasks as $assignedTask)       
                                    <tr>
                                        <td>
                                            <div>{{ $assignedTask->user->name }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $assignedTask->task->name }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $assignedTask->created_at }}</div>
                                        </td>
                                        <td>
                                            <form method="post" action="/assignedtask/delete">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-sm btn-danger" style="font-size: 11px" onclick="return ConfirmDelete();"><i class="fa fa-trash-o fa-lg"></i>&nbsp; Delete</button>
                                                <input type="hidden" name="id" value="{{ $assignedTask->id }}">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach                                             
                            </tbody>
                        </table>
                    </div>
                @else
                    <div style="text-align: center;"><h2>No Assigned Tasks!</h2></div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
