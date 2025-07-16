@extends('front.master.template')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <span class="breadcrumb-item active">Resend Verification Email</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Resend Verification Email Form Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4">Resend Verification Email</h4>
                            <p>{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</p>
                            <!-- Session Status -->
                            @if (session('status') == 'verification-link-sent')
                            <p class="mb-4 text-warning">
                                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                </p>
                            @endif
                            <div class="d-flex align-items-center mb-4 pt-2">
                                <div class="input-group quantity mr-3" >
                                    <form method="POST" action="{{ route('verification.send') }}">
                                        @csrf
        
                                        <div class="form-group mb-0">
                                            <input type="submit" value="{{ __('Resend Verification Email') }}" class="btn btn-primary px-3">
                                        </div>
                                    </form>
                                </div>
                                <div class="input-group quantity mr-3" >
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="btn btn-primary px-3" type="button" onclick="event.preventDefault();
                                        this.closest('form').submit();">{{ __('Log Out') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Resend Verification Email Form End -->
@endsection