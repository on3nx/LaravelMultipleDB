<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                <li {{ (Request::is('home') ? 'class=active' : '') }}><a href="{{ url('/home') }}"><span class="glyphicon glyphicon glyphicon-home" aria-hidden="true"></span>{!! (Request::is('home') ? '<span class="sr-only">(current)</span>' : '') !!}</a></li>
                <li {{ (Request::is('about') ? 'class=active' : '') }}><a href="{{ url('/about') }}">About{!! (Request::is('about') ? '<span class="sr-only">(current)</span>' : '') !!}</a></li>
                <li {{ (Request::is('contact') ? 'class=active' : '') }}><a href="{{ url('/contact') }}">Contact{!! (Request::is('contact') ? '<span class="sr-only">(current)</span>' : '') !!}</a></li>
                <?php /*<!--<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>--> */ ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form" role="form" method="post" action="{{ url('/login') }}" accept-charset="UTF-8" id="login-nav">
                                            {{ csrf_field() }}
                                            <div class="form-group{{ $errors->has('identifier') ? ' has-error' : '' }}">
                                                <input id="identifier" type="text" class="form-control" name="identifier" placeholder="Email/Username" value="{{ old('identifier') }}" required autofocus>
                                            </div>
                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                                <div class="help-block text-right"><a href="{{ url('/password/reset') }}">Forget the password ?</a></div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="remember"> Remember Me </label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="bottom text-center">
                                        New here ? <a href="{{ url('/register') }}"><b>Register</b></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

                            <span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu3">
                            <li class="dropdown-header">aaa{{ Auth::user()->firstname.' '.Auth::user()->lastname }}sss</li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Register your Business</a></li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ url('/profile') }}">
                                    Manage Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>