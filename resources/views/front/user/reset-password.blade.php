@extends('front.master.template')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <span class="breadcrumb-item active">Reset Password</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Reset Password Form Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4">{{ __('Reset Password') }}</h4>
                            <small>Your email address will not be published. Required fields are marked *</small>
                            <br><br>
                            <form method="POST" action="{{ route('password.store') }}">
                                @csrf
                                <!-- Password Reset Token -->
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                <div class="form-group">
                                    <label for="email">{{ __('Email') }} *</label>
                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email', $request->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">{{ __('Password') }} *</label>
                                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">{{ __('Confirm Password') }} *</label>
                                    <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <input type="submit" value="{{ __('Reset Password') }}" class="btn btn-primary px-3">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reset Password Form End -->
@endsection