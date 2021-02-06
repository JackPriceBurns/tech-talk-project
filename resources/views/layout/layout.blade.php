@extends('layout.base')

@section('body')
    @include('layout.nav')

    <div class="flex justify-center">
        <div class="container">@yield('content')</div>
    </div>
@endsection
