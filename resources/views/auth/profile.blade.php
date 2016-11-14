@extends('master.wireframe')

@section('head')

@stop

@section('header')
    @include('master.header')
@endsection

@section('content')
    <!-- Begin page content -->
    <div class="container">

        @include('master.notification')

        <div class="row">
            <div class="page-header">
                <h1>Update Profile</h1>
            </div>
        </div>

        @include('flash::message')

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Your Username: <strong>{{ $user->username }}</strong></div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/profile/update') }}">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="sr-only control-label">Email</label>
                                <div class="col-sm-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ $user->email }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span>
                                    @endif
                                    <span id="helpBlock" class="help-block">Require email verification</span>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('firstname') || $errors->has('lastname')  ? ' has-error' : '' }}">
                                <label for="firstname" class="sr-only control-label">First Name</label>
                                <div class="col-md-6">
                                    <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname')  }}" placeholder="{{ $user->firstname }}">
                                    @if ($errors->has('firstname'))
                                        <span class="help-block"> <strong>{{ $errors->first('firstname') }}</strong> </span>
                                    @endif
                                </div>

                                <label for="lastname" class="sr-only control-label">Last Name</label>
                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname')  }}" placeholder="{{ $user->lastname }}">
                                    @if ($errors->has('lastname'))
                                        <span class="help-block"> <strong>{{ $errors->first('lastname') }}</strong> </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                                <label for="dob" class="sr-only control-label">Date of Birth</label>
                                <div class="col-md-12">
                                    <input id="dateofbirth" type='text' class="form-control" name="dateofbirth" value="{{ old('dateofbirth') }}" placeholder="{{ $user->dateofbirth }}"/>
                                    @if ($errors->has('dob'))
                                        <span class="help-block"> <strong>{{ $errors->first('dateofbirth') }}</strong> </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" id="gender" value="1" {{ $user->gender == "1" ? 'checked="checked"' : '' }}> Male
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" id="gender" value="0" {{ $user->gender == "0" ? 'checked="checked"' : '' }}> Female
                                    </label>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('cur_password') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <span id="helpBlock" class="help-block">Leave password blank, if you not intend to change password</span>
                                </div>
                                <label for="dob" class="sr-only control-label">Current Password</label>
                                <div class="col-md-12">
                                    <input id="cur_password" type='password' class="form-control" name="cur_password" value="{{ old('cur_password') }}" placeholder="Current Password"/>
                                    @if ($errors->has('dob'))
                                        <span class="help-block"> <strong>{{ $errors->first('cur_password') }}</strong> </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') || $errors->has('password_confirmation')? ' has-error' : '' }}">
                                <label for="password" class="sr-only control-label">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="New Password">
                                    @if ($errors->has('password'))
                                        <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span>
                                    @endif
                                </div>

                                <label for="password-confirm" class="sr-only control-label">Confirm Password</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block"> <strong>{{ $errors->first('password_confirmation') }}</strong> </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    @include('master.footer')
@endsection

@section('javascript')
    <script type="text/javascript" src="http://momentjs.com/downloads/moment.js"></script>
    <script type="text/javascript" src="js/bootstrap-datetime.js"></script>
    <script type="text/javascript">$(function () {
            $('div.alert').not('.alert.important').delay(3000).slideUp();
            $(function () { $('#dob').datetimepicker({format: 'DD-MMM-YYYY'}); });
        });
    </script>
@endsection