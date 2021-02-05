@extends('layout.base')

@section('body')
    @include('layout.nav')

    <div class="flex justify-center">
        <div class="container p-8">@yield('content')</div>
    </div>
@endsection
