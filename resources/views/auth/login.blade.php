{{-- Auth/login.blade.php --}}

{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section('content')

{{-- Bootstrap --}}
<div class="container">
  <div class="row justify-content-center">

    {{-- Login-register --}}
    <div class="login_register_wrapper col-6">

      {{-- Form title --}}
      <div class="form_title text-center">
        <div class="top_title">
          <h4>{{ __('Login') }}</h4>
        </div>
        <div class="sub_title">
          <h4>Enter Recipient Info</h4>
        </div>
      <div>

      {{-- Form Login --}}
      <form method="POST" action="{{ route('login') }}">
        @csrf
        @method('POST')

        {{-- Input email --}}
        <div class="login_email form-group">
          <div class="input_box">
            <input id="email"
              type="email"
              class="form-control rounded-0
              @error('email') is-invalid
              @enderror" name="email" value="{{ old('email') }}"
              required autocomplete="email"
              autofocus
              placeholder="Email">

            {{-- Validate --}}
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
            {{-- end Validate --}}

          </div>
        </div>
        {{-- end Input email --}}

        {{-- Input password --}}
        <div class="login_password form-group">
          <div class="input_box">
            <input id="password"
              type="password"
              class="form-control rounded-0
              @error('password') is-invalid
              @enderror" name="password"
              required
              autocomplete="current-password"
              placeholder="Password">

            {{-- Validate --}}
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            {{-- end Validate --}}

            </div>
          </div>
          {{-- end Input password --}}

          {{-- Remember me --}}
          <div class="login_remember row justify-content-center">
            <div class="checkbox">

              {{-- Checkbox --}}
              <label class="container_checkbox" for="remember">{{ __('Remember me') }}
                <input type="checkbox" checked="checked" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="checkmark"></span>
              </label>
              {{-- end Checkbox --}}

            </div>
          </div>
          {{-- end Remember me --}}

          {{-- Submit Login --}}
          <div class="login_submit form-group row justify-content-center">
            <div class="button_login">

              {{-- Button --}}
              <button type="submit" class="custom_button">
                {{ __('Login') }}
              </button>
              {{-- end Button --}}

              {{-- Forgot password --}}
              @if (Route::has('password.request'))
                <div class="forgot_password">
                  <a class="custom-form-link" href="{{ route('password.request') }}">
                    <span>{{ __('Forgot your password?') }}</span>
                  </a>
                </div>
              @endif
              {{-- end Forgot password --}}

            </div>
          </div>
          {{-- end Submit Login --}}

      </form>
      {{-- end Form Login --}}

    </div>
    {{-- end Login-register --}}

  </div>
</div>
{{-- end Bootstrap --}}

@endsection
