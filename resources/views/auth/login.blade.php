@extends('layout.base')

@section('body')
    <div class="h-full w-full bg-gray-200 flex justify-center items-center">
        <div class="p-8 w-full sm:w-2/3 md:w-1/2 lg:w-1/4">
            <div class="py-8 text-center">
                <h1 class="text-4xl font-bold mb-4">Tech Talk</h1>
                <h2 class="text-2xl">Login</h2>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 text-red-800 rounded p-4 mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('auth.login') }}">
                @csrf

                <input type="text" name="email" placeholder="Email" class="w-full p-2 rounded"/>
                <input type="password" name="password" placeholder="Password" class="w-full p-2 mt-2 rounded"/>

                <button class="w-full bg-blue-600 text-white p-4 rounded mt-4">Login</button>
            </form>
        </div>
    </div>
@endsection
