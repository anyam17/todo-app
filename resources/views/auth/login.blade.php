@extends('layouts.main')

@section('content')
    <div class="container">    
        <div id="loginbox" style="margin-top:45px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="{{ url('/password/reset') }}">Forgot password?</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="col-sm-12">
                            @if(Session::has('msg'))
                                <div class="alert alert-success" id="alert">{{ Session::get('msg') }}</div>
                            @endif
                            @if(Session::has('error_msg'))
                                <div class="alert alert-danger" id="alert">{{ Session::get('error_msg') }}</div>
                            @endif
                        </div>
                            
                        <form id="loginform" class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div style="margin: 0 15px 5px 15px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="login-username" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Address">
                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block" style="padding-left: 15px">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif   
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">  
                                <div style="margin: 0 15px 5px 15px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="login-password" type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block" style="padding-left: 15px">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                                
                            <div class="input-group">
                              <div class="checkbox">
                                <label>
                                  <input id="login-remember" type="checkbox" name="remember"> Remember me
                                </label>
                              </div>
                            </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                        <button type="submit" id="btn-login" class="btn btn-success">Login</button>
                                      <a id="btn-fblogin" href="#" class="btn btn-primary">Login with Facebook</a>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:10px; font-size:90%" >
                                            Don't have an account! 
                                        <a href="register">
                                            Sign Up Here
                                        </a>
                                        </div>
                                    </div>
                                </div>    
                            </form>     
                        </div>                     
                    </div>  
        </div>
    </div>
    
@endsection