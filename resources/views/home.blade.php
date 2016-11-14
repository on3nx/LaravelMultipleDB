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
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('master.footer')
@endsection