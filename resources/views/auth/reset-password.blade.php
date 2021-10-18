{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Reset Password') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}


@extends('layouts.base')
@section('title','Login')
@section('content')
    <section class="form">
        <h1 class="title">Create New Password</h1>


        <x-jet-validation-errors class="mb-4" />

        <form class="login-form row"  method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

           <div class="form-field col-lg-6 mx-auto">
              <input id="email" class="input-text js-input" name="email" type="email" :value="{{$request->email}}" required autofocus>
              <label class="label" for="email">E-mail</label>
           </div>
           <div class="form-field col-lg-6 mx-auto">
            <input id="password" class="input-text js-input" name="password" type="password" required>
            <label class="label" for="password">New Password</label>
           </div>
           <div class="form-field col-lg-6 mx-auto">
            <input id="password" class="input-text js-input" name="password_confirmation" type="password" required>
            <label class="label" for="password_confirmation">Comfirm Password</label>
           </div>

           <div class="form-field col-lg-12">
              <input class="submit-btn" type="submit" value="Create">
           </div>
        </form>
     </section>
@endsection
