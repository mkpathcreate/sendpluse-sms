@extends('layouts.app')

@section('content')
<div class="breadcrumb-area gray-bg">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="/">Home</a></li>
                <li class="active"> login </li>
            </ul>
        </div>
    </div>
</div>
<div class="login-register-area pt-70 pb-75">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-form-container">
                    <div class="login-register-form">
                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input id="email" type="email" class="form-control 
                                    @error('email') is-invalid @enderror" name="email" 
                                    value="{{ old('email') }}" 
                                    placeholder="email"
                                    required autocomplete="email" autofocus>
    
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                    name="password" required placeholder="password">
    
                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="button-boxx">
                                <div class="login-toggle-btn">
                                    <input class="form-check-input" type="checkbox" name="remember" 
                                        id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                    <a href="{{route('password.request')}}">Forgot Password?</a>
                                </div>
                                <button type="submit" class="btn btn-pink font-bold"><span>Login</span></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-10 text-center">
                    If you are not registered, Join us <a href="/register" class="link underline">here</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
