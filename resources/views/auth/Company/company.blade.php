@extends('master.wireframe')

@section('head')

@stop

@section('header')
    @include('master.header')
@endsection

@section('content')
    <div class="container">

        @include('master.notification')


    </div>
@endsection

@section('footer')
    @include('master.footer')
@endsection