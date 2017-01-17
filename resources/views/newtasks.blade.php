@extends('layouts.main')

@section('content')
<div class="col-md-10 col-md-offset-1">
    <div style="height: 10px;">
        @if(Session::has('error_msg'))
            <div class="alert alert-danger" id="alert">{{ Session::get('error_msg') }}</div>
        @endif
    </div> 
	<div class="panel panel-default" style="margin: 35px 300px 0 300px">
        <div class="panel-heading"> New Tasks</div>
        <div class="panel-body"> 
            <form role="form" method="post" action="/task">
                {{ csrf_field() }}
                <div class="form-group">
                    <label> Task Detail</label>
                    <input type="text" name="name" class="form-control" placeholder="Task Detail" required>
                </div>
                <div class="form-group">
                    <label> Expiry Date</label>
                    <input type="date" name="expiry_date" class="form-control" placeholder="yyyy-mm-dd" required>
                </div>
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add </button>
            </form>
        </div>
    </div>
</div>
@endsection