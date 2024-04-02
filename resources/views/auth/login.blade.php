@extends('layouts.app')

@section('content')
    <div class="form-horizontal st">
        <div class="form-group head">
            <i class="fa fa-sign-in fa-lg"></i>&nbsp; Ienākt profilā
        </div>
        <div class="form-group social">
            <center>
                <a href="{{ url('/auth/facebook') }}">
                    <img src="{{ asset('images') }}/facebook.png" alt="" />
                </a>
                <a href="{{ url('/auth/twitter') }}">
                    <img src="{{ asset('images') }}/twitter.png" alt="" />
                </a>
            </center>
        </div>
        <div class="form-group useform">
            <center>
                <i class="fa fa-arrow-down"></i>
                <span><b>Vai</b></span> izmanto formu
                <i class="fa fa-arrow-down"></i>
            </center>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 control-label">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    Atcerēties mani
                                </label>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link forgot" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check"></i> {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
