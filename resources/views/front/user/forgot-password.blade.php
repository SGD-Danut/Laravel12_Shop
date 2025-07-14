@extends('front.master.template')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <span class="breadcrumb-item active">Forgot Password</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Forgot Password Form Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4">Forgot Password</h4>
                            <small>Your email address will not be published. Required fields are marked *</small>
                            <br><br>
                            <p>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
                            <!-- Session Status -->
                            <p class="mb-4 text-warning">{{ session('status') }}</p>
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">{{ __('Email') }} *</label>
                                    <input name="email" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" id="email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <input type="submit" value="{{ __('Email Password Reset Link') }}" class="btn btn-primary px-3">
                                </div>
                            </form>
                            @php
                                if (session('status')) {
                                    alert()->success('Success!', session('status'));
                                }
                            @endphp
                            @error('email')
                                @php
                                    alert()->error('Error!', $message);
                                @endphp
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Forgot Password Form End -->
@endsection
