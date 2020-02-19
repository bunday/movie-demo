@extends('layouts.app')

@section('content')
<div class="mx-auto h-full flex justify-center items-center bg-gray-900">
    <div class="flex w-full px-48">
        <div class="bg-white rounded p-4 shadow-lg w-full">

            <div class="px-8 py-4">
            <div class="text-xl">{{ __('Login') }}</div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                      <div class="my-4">
                        <p class="block text-gray-300 text-sm font-bold mb-2">E-Mail </p>
                        <div class="flex flex-col">
                          <input
                            class="shadow appearance-none @error('email') border-red-200 @enderror  w-full h-10 border bg-gray-200 rounded py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="E-Mail"
                            name="email" value="{{ old('email') }}" required autocomplete="email"
                          />
                          @error('email')
                          <span class="py-4 text-red-400 block" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                        </div>
                      </div>
                      <div class="my-4">
                        <p class="block text-gray-300 text-sm font-bold mb-2">Password </p>
                        <div class="flex flex-col">
                          <input
                            class="shadow appearance-none @error('password') border-red-200 @enderror  w-full h-10 border bg-gray-200 rounded py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="password"
                            name="password" required type="password" autocomplete="new-password"
                          />
                          @error('password')
                          <span class="py-4 text-red-400 block" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                        </div>
                      </div>


                    <div class="flex justify-between">
                        <a class="text-purple-500" href="/register">Create an Account</a>
                        <button type="submit" class="bg-purple-500 text-lg rounded text-white px-4 py-2">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
