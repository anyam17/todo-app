@extends('layouts.main')

@section('content')
<div class="container" style="height: 100%">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="task">Tasks</a><br>
                    <a href="assigntask">Assign Tasks</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
