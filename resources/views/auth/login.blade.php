@extends('layouts.app')

@section('title', __('messages.login'))

@section('content')
<x-ui.page-header
    :title="__('messages.login_title')"
    image="assets/images/element/signin.svg"
    imageAlt="Login"
/>

<section class="pt-0">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
                <x-ui.card class="p-4 p-sm-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <x-ui.form-input
                            name="usrEmail"
                            :label="__('messages.email')"
                            type="email"
                            required
                        />

                        <x-ui.form-input
                            name="usrPassword"
                            :label="__('messages.password')"
                            type="password"
                            required
                        />

                        <div class="mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="rememberCheck" name="remember">
                                <label class="form-check-label" for="rememberCheck">{{ __('messages.remember_me') }}</label>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-sm-4">
                                <x-ui.button type="submit" class="btn-primary">
                                    {{ __('messages.login') }}
                                </x-ui.button>
                            </div>
                            <div class="col-sm-8 text-sm-end">
                                <span>{{ __('messages.no_account') }}</span>
                                <a href="{{ route('register') }}"><u>{{ __('messages.sign_up') }}</u></a>
                            </div>
                        </div>
                    </form>
                </x-ui.card>
            </div>
        </div>
    </div>
</section>
@endsection
