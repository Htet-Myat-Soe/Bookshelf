{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Email Password Reset Link') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}


@extends('layouts.base')
@section('title','Login')
@section('content')
    <section class="form">
        <h1 class="title">Reset Password</h1>


        <x-jet-validation-errors class="mb-4" />
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <form class="login-form row"  method="POST" action="{{ route('password.email')}}">
            @csrf
           <div class="form-field col-lg-6 mx-auto">
              <input id="email" class="input-text js-input" name="email" type="email" :value="old('email')" required autofocus>
              <label class="label" for="email">E-mail</label>
           </div>
           <div class="form-field col-lg-12">
              <input class="submit-btn" type="submit" value="Reset">
           </div>
        </form>
     </section>
@endsection
