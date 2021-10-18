{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}

@extends('layouts.base')
@section('title','Login')
@section('content')
    <section class="form">
        <h1 class="title">Login</h1>


        <x-jet-validation-errors class="mb-4" />

        <form class="login-form row" method="POST" action="{{route('login')}}">
            @csrf
           <div class="form-field col-lg-6 ">
              <input id="email" class="input-text js-input" name="email" type="email" :value="old('email')" required autofocus>
              <label class="label" for="email">E-mail</label>
           </div>
           <div class="form-field col-lg-6 ">
                <input id="password" class="input-text js-input" name="password" type="password" required autocomplete="current-password">
                <label class="label" for="password">Password</label>
            </div>
           <div class="form-field col-lg-12">
              <input class="submit-btn" type="submit" value="Login">
           </div>
        </form>
        <h4 class="text-center">OR</h4>
        <h6 class="text-center">Login With</h6>
        <div class="social-buttons">
            <a href="{{ url('auth/facebook') }}" class="social-buttons__button social-button social-button--facebook" aria-label="Facebook">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="{{ url('auth/google') }}" class="social-buttons__button social-button social-button--google" aria-label="Google">
                <i class="fab fa-google-plus-g"></i>
            </a>
        </div>
        @if (Route::has('password.request'))
        <div class="text-center">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        </div>

    @endif

     </section>
@endsection
