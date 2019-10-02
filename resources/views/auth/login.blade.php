@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- <div class="form-group input-group">
                            <div class="form-check">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="is_employer" id="employer" {{ old('is_employer') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="employer">{{ __('I am an employer') }}</label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group input-group col-sm-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i></span>
                            </div>
                            <input id="email" type="email" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group input-group col-sm-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>


                        <div class="form-group input-group">
                            <div class="form-check">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                                </div>
                            </div>
                            <div class="col offset-4">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif 
                            </div>
                        </div>
                        
                        <div class="form-group row justify-content-md-center">
                            <button type="submit" class="btn btn-apply">
                                <span style="font-size:18px"><i class="fas fa-sign-in-alt"></i>{{ __('Login') }}</span>
                            </button>
                        </div>
                        <div class="row justify-content-md-center">
                            <h5>Or</h5>
                        </div>
                        <div class="row justify-content-md-center">
                            <a type="button" href="{{ route('login.linkedin') }}" class="btn btn-apply"><span style="font-size:18px"><i class="fab fa-linkedin"></i>Sign in with LinkedIn</span></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
