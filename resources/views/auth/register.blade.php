@extends('layouts.guestlayout')

@section('content')

<div class="container">
  <div class="row guest-form-row">
    <div class="col-lg-6">
      <div class="page-header-container login-form">
        <div class="page-title">
          <div class="row">
            <div class="col-sm-6">
              <h2>{{ __('Register') }}</h2>
            </div>
          </div>
        </div>

        <form method="POST" action="{{ route('register') }}">
          @csrf

          {{-- Name field --}}
          <div class="form-group">
            <label for="email">{{ __('Name') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          {{-- Email field --}}
          <div class="form-group">
            <label for="email">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          {{-- Password field --}}
          <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          {{-- Confirm Password field --}}
          <div class="form-group">
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
          </div>

          <div class="form-group text-center">
            <input type="submit" class="btn btn-success" value="Register">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
