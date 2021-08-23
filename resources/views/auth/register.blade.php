{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}

@extends('layouts.base')
@section('title','Login')
@section('content')
    <section class="form">
        <h1 class="title">Register</h1>
       
    
        <x-jet-validation-errors class="mb-4" />

        <form class="login-form row" method="POST" action="{{route('register')}}">
            @csrf
            <div class="form-field col-lg-6 ">
                <input id="email" class="input-text js-input" name="name" type="text" :value="name" required autofocus>
                <label class="label" for="email">Name</label>
            </div>
           <div class="form-field col-lg-6 ">
              <input id="email" class="input-text js-input" name="email" type="email" :value="email" required>
              <label class="label" for="email">E-mail</label>
           </div>
           <div class="form-field col-lg-6 ">
                <input id="password" class="input-text js-input" name="password" type="password" required autocomplete="current-password">
                <label class="label" for="password">Password</label>
            </div>
            <div class="form-field col-lg-6 ">
                <input id="password" class="input-text js-input" type="password" name="password_confirmation" required autocomplete="new-password">
                <label class="label" for="password">Confirm Password</label>
            </div>
           <div class="form-field col-lg-12">
              <input class="submit-btn" type="submit" value="Register">
           </div>
        </form>
     </section>
@endsection

