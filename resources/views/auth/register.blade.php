@extends('layouts.auth')

@section('heading')
    Create a new account
@endsection

@section('content')
    <form class="space-y-6" action="{{ route('register') }}" method="POST">
        @csrf
        <!-- Name -->
        <div>
            <label
            for="name"
            class="block text-sm font-medium leading-6 text-gray-900"
            >Full Name</label
            >
            <div class="mt-2">
            <input
                id="name"
                name="name"
                type="text"
                autocomplete="name"
                placeholder="Alp Arslan"
                required
                value="{{ old('name') }}"
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                @error('name')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Username -->
        <div>
            <label
            for="username"
            class="block text-sm font-medium leading-6 text-gray-900"
            >Username</label
            >
            <div class="mt-2">
            <input
                id="username"
                name="user_name"
                type="text"
                autocomplete="username"
                placeholder="alparslan1029"
                required
                value="{{ old('user_name') }}"
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                @error('user_name')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Email -->
        <div>
            <label
            for="email"
            class="block text-sm font-medium leading-6 text-gray-900"
            >Email address</label
            >
            <div class="mt-2">
            <input
                id="email"
                name="email"
                type="email"
                autocomplete="email"
                placeholder="alp.arslan@mail.com"
                required
                value="{{ old('email') }}"
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                @error('email')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Password -->
        <div>
            <label
            for="password"
            class="block text-sm font-medium leading-6 text-gray-900"
            >Password</label
            >
            <div class="mt-2">
            <input
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                placeholder="••••••••"
                required
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                @error('password')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <label
            for="password"
            class="block text-sm font-medium leading-6 text-gray-900"
            >Confirm Password</label
            >
            <div class="mt-2">
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="current-password"
                placeholder="••••••••"
                required
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                @error('password_confirmation')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <button
            type="submit"
            class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">
            Register
            </button>
        </div>
    </form>

    <p class="mt-10 text-center text-sm text-gray-500">
        Already a member?
        <a
        href="{{route('login')}}"
        class="font-semibold leading-6 text-black hover:text-black"
        >Sign In</a
        >
    </p>
@endsection