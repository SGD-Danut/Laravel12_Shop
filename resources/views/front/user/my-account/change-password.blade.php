@extends('front.user.my-account.my-account')
  
@section('my-account-content')
    <div class="tab-pane fade show active" id="tab-pane-1">
        <h4 class="mb-3">Change Password</h4>
        <p>Dacă consideri că parola ta este slabă poți să o schimbi de aici.</p>                           
    </div>
    <div class="row">
        <div class="col-md-6">
            <form method="POST" action="{{ route('change-user-password') }}">
                @csrf
                <div class="form-group">
                    <label for="current_password">{{ __('Current Password') }} *</label>
                    <input name="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password">
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="new_password">{{ __('New Password') }} *</label>
                    <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password">
                    @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="new_password_confirmation">{{ __('Confirm Password') }} *</label>
                    <input name="new_password_confirmation" type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="new_password_confirmation">
                    @error('new_password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-0">
                    <input type="submit" value="{{ __('Reset Password') }}" class="btn btn-primary px-3">
                </div>
            </form>
        </div>
    </div>
@endsection