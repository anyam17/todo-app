@extends('layouts.main')

@section('content')
	<div class="panel panel-default" style="margin: 35px 300px 0 300px">
        <div class="panel-heading"> New Tasks</div>
        <div class="panel-body"> 
            <form role="form" method="post" action="/task">
                {{ csrf_field() }}
                <div class="form-group">
                    <label> Task Detail</label>
                    <input type="text" name="name" class="form-control" placeholder="Task Detail" required>
                </div>
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add </button>
            </form>
        </div>
    </div>
@endsection