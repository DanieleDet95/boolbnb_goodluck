{{-- Auth/register.blade.php --}}

{{-- Layouts app --}}
@extends('layouts.app')

{{-- Yeld Main Content --}}
@section('content')

  {{-- Bootstrap --}}
  <div class="container">
    <div class="row justify-content-center">

      {{-- Login-register --}}
      <div class="register common_form login_register_wrapper col-10 col-md-8 col-lg-6">

        {{-- Form title --}}
        <div class="form_title text-center">
          <div class="top_title">
            <h4>{{ __('Register') }}</h4>
          </div>

          <div class="sub_title">
            <h3>Fill out the fields below</h3>
          </div>
        <div>

        {{-- Form Register --}}
        <form method="POST" action="{{ route('register') }}">
          @csrf
          @method('POST')

          {{-- Name & Lastname --}}
          <div class="register double_input form-group row">

            {{-- Input Name --}}
            <div class="register_name left_input col-6">
              <div class="input_box">
                <input
                id="name"
                type="text"
                class="form-control rounded-0
                @error('name') is-invalid
                @enderror" name="name"
                value="{{ old('name') }}"
                required autocomplete="name"
                autofocus
                placeholder="Name">

                {{-- Validate --}}
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                {{-- end Validate --}}

              </div>
            </div>
            {{-- end Name --}}

            {{-- Input Lastname --}}
            <div class="register_lastname right_input col-6">
              <div class="input_box">
                <div class="input_box">
                  <input id="lastname"
                     type="text"
                     class="form-control rounded-0
                     @error('lastname') is-invalid @enderror"
                     name="lastname"
                     value="{{ old('lastname') }}"
                     autofocus
                     placeholder="Lastname">
                </div>
              </div>
            </div>
            {{-- end Lastname --}}

            {{-- Validation --}}
            @error('lastname')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
            {{-- end Validation --}}

          </div>
          {{-- end Name & Lastname --}}

          {{-- Input Birthday --}}
          <div class="register_birthday form-group row">
            <div class="col-12">
              <div class="input_box">
                <input
                  id="birthday"
                  type="text"
                  class="form-control rounded-0
                  @error('birthday') is-invalid
                  @enderror" name="birthday"
                  value="{{ old('birthday') }}"
                  autofocus
                  onfocus="(this.type='date')"
                  onblur="(this.type='text')"
                  placeholder="Date">

                  {{-- Validate --}}
                  @error('birthday')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  {{-- Validate --}}
              </div>
            </div>
          </div>
          {{-- end Input Birthday --}}

          {{-- Input Email --}}
          <div class="register_email form-group row">
            <div class="col-12">
              <div class="input_box">
                <input
                id="email"
                type="email"
                class="form-control rounded-0
                @error('email') is-invalid
                @enderror" name="email"
                value="{{ old('email') }}"
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
          </div>
          {{-- end Input Email --}}

          {{-- Input Phone --}}
          <div class="register_phone form-group row">
            <div class="col-12">
              <div class="input_box">
                <input
                id="phone"
                type="text"
                class="form-control rounded-0
                @error('phone') is-invalid
                @enderror" name="phone"
                value="{{ old('phone') }}"
                autofocus
                placeholder="Phone">

                {{-- Validate --}}
                @error('phone')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                {{-- end Validate --}}

              </div>
            </div>
          </div>
          {{-- end Input Phone --}}

          {{-- Input Password --}}
          <div class="register_password form-group row">
            <div class="col-12">
              <div class="input_box">
                <input id="password"
                  type="password"
                  class="form-control rounded-0
                  @error('password') is-invalid
                  @enderror" name="password"
                  required autocomplete="new-password"
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
          </div>
          {{-- end Input Password --}}

          {{-- Input Confirm Password --}}
          <div class="register_confirm form-group row">
            <div class="col-12">
              <div class="input_box">
                <input
                  id="password-confirm"
                  type="password"
                  class="form-control rounded-0"
                  name="password_confirmation"
                  required autocomplete="new-password"
                  placeholder="Confirm Password">
              </div>
            </div>
          </div>
          {{-- end Input Confirm Password --}}

          {{-- Password advice --}}
          <div class="password_advice justify-content-center row">
            <div class="col-12">
              <i class="fas fa-exclamation-circle icon"></i>
              <p class="password_message">The password must be at least 8 characters long</p>
            </div>
          </div>
          {{-- end Password advice --}}

          {{-- Submit Login --}}
          <div class="form_submit form-group justify-content-center row">
            <div class="col-12">
              <div class="button_submit">
                <button type="submit" class="custom_button">
                  {{ __('Register') }}
                </button>
              </div>
            </div>
          </div>

        </form>
        {{-- end Form Login --}}

      </div>
      {{-- end Login-register --}}

    </div>
  </div>
  {{-- end Bootstrap --}}

@endsection
