@extends('layout.base')

@section('body')
    <div class="flex justify-center items-center">
        <div class="w-full sm:w-3/4 md:w-2/3 lg:w-1/2 xl:w-1/3">
            @if ($errors->any())
                <div class="bg-red-100 text-red-800 rounded p-4 mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="p-8 bg-white rounded shadow-lg">
                <div class="py-8">
                    <h1 class="text-2xl uppercase text-blue-700 font-bold">Admin Section</h1>
                </div>

                <form method="POST" action="{{ route('auth.login') }}">
                    @csrf

                    <label class="uppercase text-gray-600 text-sm font-bold">Email</label>
                    <input type="text" name="email" placeholder="Email" class="w-full bg-gray-100 focus:outline-none p-2 mb-2 rounded"/>

                    <label class="uppercase text-gray-600 text-sm font-bold">Password</label>
                    <input type="password" name="password" placeholder="Password" class="w-full bg-gray-100 focus:outline-none p-2 rounded"/>

                    <button class="w-full bg-blue-700 text-white p-4 rounded mt-4">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection
