@extends('master.wireframe')

@section('head')

@stop

@section('header')
    @include('master.header')
@endsection

@section('content')
    <div class="container">

        @include('master.notification')

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="sr-only control-label">Username</label>
                                <div class="col-sm-12">
                                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus>
                                    @if ($errors->has('username'))
                                        <span class="help-block"> <strong>{{ $errors->first('username') }}</strong> </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="sr-only control-label">Email</label>
                                <div class="col-sm-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('firstname') || $errors->has('lastname')  ? ' has-error' : '' }}">
                                <label for="firstname" class="sr-only control-label">First Name</label>
                                <div class="col-md-6">
                                    <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="First Name" required>
                                    @if ($errors->has('firstname'))
                                        <span class="help-block"> <strong>{{ $errors->first('firstname') }}</strong> </span>
                                    @endif
                                </div>

                                <label for="lastname" class="sr-only control-label">Last Name</label>
                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="Last Name" required>
                                    @if ($errors->has('lastname'))
                                        <span class="help-block"> <strong>{{ $errors->first('lastname') }}</strong> </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                                <label for="dob" class="sr-only control-label">Date of Birth</label>
                                <div class="col-md-12">
                                    <input id="dob" type='text' class="form-control" name="dob" value="{{ old('dob') }}" placeholder="Date of Birth" required/>
                                    @if ($errors->has('dob'))
                                        <span class="help-block"> <strong>{{ $errors->first('dob') }}</strong> </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" id="gender" value="Male"> Male
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" id="gender" value="Female"> Female
                                    </label>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') || $errors->has('password_confirmation')? ' has-error' : '' }}">
                                <label for="password" class="sr-only control-label">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span>
                                    @endif
                                </div>

                                <label for="password-confirm" class="sr-only control-label">Confirm Password</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block"> <strong>{{ $errors->first('password_confirmation') }}</strong> </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('master.footer')
@endsection

@section('javascript')
    <script type="text/javascript" src="http://momentjs.com/downloads/moment.js"></script>
    <script type="text/javascript" src="js/bootstrap-datetime.js"></script>
    <script type="text/javascript">$(function () {
            $(function () { $('#dob').datetimepicker({format: 'DD-MMM-YYYY'}); });
        });
    </script>
@endsection
