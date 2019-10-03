@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Sign up') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group input-group">
                            <div class="form-check">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="is_employer" id="employer" {{ old('is_employer') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="employer">{{ __('I am an employer') }}</label>
                                </div>
                            </div>
                        </div>
 
                        <div class="form-group input-group col-sm-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input id="name" type="text" placeholder="Full Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group input-group col-sm-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            </div>
                            <input id="email" type="email" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                            <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group input-group col-sm-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input id="password-confirm" type="password" placeholder="Repeat password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>   

                        <div class="row justify-content-md-center">
                            <button type="submit" class="btn btn-apply" style="width:auto">
                                <span style="font-size:18px"><i class="fas fa-user-plus"></i>{{ __('Sign up') }}</span>
                            </button>
                        </div> 
                        
                        <div class="mt-3">   
                            <p class="text-center">Already have an account? Please <a href="{{ route('login') }}">Log In</a></p>
                        </div>

                        <div class="row justify-content-md-center">
                            <a role="button" href="{{ route('login.linkedin') }}" class="btn btn-apply"><span style="font-size:18px"><i class="fab fa-linkedin"></i>Sign in with LinkedIn</span></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
