@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 panel panel-default panel-shaded" style="margin: 150px;height:400px">
      <div class="panel-body" style="margin-top:90px">
        <div class="row">
          <div class="col-md-4">
            @include('auth/banner')
          </div>

          <!-- Add a separator -->
          <div class="separator" style="background-color:green; width:3px;height:100%;margin:0 20px"></div>

          <div class="col-md-7">
            @action('login_form.before')
            <form class="form-horizontal margin-top" method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">{{ __('Email Address') }}</label>
                <div class="col-md-6">
                  <input id="email" type="email" class="form-control" name="email" autocomplete="email" value="{{ old('email') }}" required autofocus>
                  @if ($errors->has('email'))
                    <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">{{ __('Password') }}</label>
                <div class="col-md-6">
                  <input id="password" type="password" class="form-control" name="password" autocomplete="current-password" required>
                  @if ($errors->has('password'))
                    <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <label class="checkbox">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                  </label>
                </div>
              </div>

              @action('login_form.before_submit')

              <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                  <button type="submit" style="background-color:green;color:#ffff" class="btn @action('login_form.submit_class')" @action('login_form.submit_attrs')>
                    {{ __('Login') }}
                  </button>
                  @if (Eventy::filter('auth.password_reset_available', true))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                      {{ __('Forgot Your Password?') }}
                    </a>
                  @endif
                </div>
              </div>
            </form>
            @action('login_form.after')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
