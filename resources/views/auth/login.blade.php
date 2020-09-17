@extends('layouts.app')

@section('content')
<br/><br/>
<br/>
<br/>
<br/>

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
                            <div class="button-box text-right">
                                <div class="login-toggle-btn">
                                    <input class="form-check-input" type="checkbox" name="remember" 
                                        id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                <button type="submit" class="btn btn-primary"><span>Login</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
