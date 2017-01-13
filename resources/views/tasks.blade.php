@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div style="height: 45px;">
            @if(Session::has('msg'))
                <div class="alert alert-success" id="alert">{{ Session::get('msg') }}</div>
            @endif
            @if(Session::has('error_msg'))
                <div class="alert alert-danger" id="alert">{{ Session::get('error_msg') }}</div>
            @endif
        </div>
        <div class="panel panel-default" style="margin: 0 50px 0px 50px; ">
            <div class="panel-heading" style="font-size: 16px">
                Available Tasks
                <div style="float: right;"><a href="logout" style="font-size: 12px; font-weight: bold;">Logout</a></div>
            </div>
            @if (count($tasks) > 0)
                <div class="panel-body" style="padding-bottom: 0px; ">
                    <table class="table table-striped">
                        <!-- Table Headings -->
                        <thead style="font-size: 11px "> 
                            <th>NUMBER</th>
                            <th>NAME</th>
                            <th>CREATED AT</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </thead>
                        <!-- Table Body -->
                        <tbody style="padding-bottom: 0px; font-size: 13px; ">
                            @foreach ($tasks as $task)         
                                <tr>
                                    <td>
                                        <div>{{ $task->id }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $task->name }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $task->created_at }}</div>
                                    </td>
                                    <td> 
                                        @if ($task->status == 'undone')       
                                        <form method="post" action="/task/update">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-sm btn-success" style="font-size: 11px">{{ $task-> status }}</button>
                                            <input type="hidden" name="id" value="{{ $task->id }}">
                                        </form>
                                        @else
                                            <button class="btn btn-sm btn-success" disabled style="font-size: 11px"> {{ $task->status }} </button>
                                        @endif
                                    </td>
                                    <td>
                                        <form method="post" action="/task/delete">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-sm btn-danger" style="font-size: 11px" onclick="return ConfirmDelete();">Delete</button>
                                            <input type="hidden" name="id" value="{{ $task->id }}">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach                     
                        </tbody>
                    </table>
                </div>
            @else
                <div style="text-align: center;"><h2>Nothing to show yet!</h2></div>
            @endif
            <div align="center">
                <form role="form" method="put" action="/newtasks">
                    <button type="submit" class="btn btn-lg btn-primary btn-block" style="font-size: 12px">New Task</button>
                </form>
            </div>
        </div>

        <div class="pagination" style="margin: 0 50px 10px 50px""> {{ $tasks->links() }} </div>
    </div>
</div> 
@endsection