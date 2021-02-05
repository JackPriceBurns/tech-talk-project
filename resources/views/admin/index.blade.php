@extends('layout.layout')

@section('content')
    <h1 class="text-2xl">Welcome back <span class="font-bold">{{ auth()->user()->name }}</span>,</h1>
@endsection
