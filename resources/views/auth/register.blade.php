@extends('layouts.app')

@section('content')
<div class="breadcrumb-area gray-bg">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="/">Home</a></li>
                <li class="active"> Register </li>
            </ul>
        </div>
    </div>
</div>
<div class="login-register-area pt-70 pb-75">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-30">
                <div class="login-form-container">
                    <div class="login-register-form">
                        <!-- register component -->
                        <sign-up>
                            <div slot="form-top">
                                @csrf
                            </div>
                        </sign-up>
                        <!-- end of register component -->
                    </div>
                </div>
                <div class="mt-10 text-center">
                    Already have an account? <a href="/login" class="link underline">Log in</a>
                </div>
            </div>
            <div class="col-md-3 mb-30">
                <div>
                    <p class="h6 text-center text-danger font-bold">I am a seller</p>
                    <div class="mb-2">
                        <span class="d-block font-bold">Register as a seller</span>
                        <span class="d-block pl-2">- Enter your contact details</span>
                        <span class="d-block pl-2">- Add your product specification</span>
                    </div>
                    <div>
                        <span class="d-block font-bold">Benefits for seller</span>
                        <span class="d-block pl-2">- Increase your visibility in global flower platform</span>
                        <span class="d-block pl-2">- Reach new customers easily</span>
                        <span class="d-block pl-2">- Sell in a safe environment</span>
                        <span class="d-block pl-2">- Get information about the buyer’s past performances</span>
                        <span class="d-block pl-2">- Get access to monthly/annual reports</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-30">
                <div>
                    <p class="h6 text-center text-danger font-bold">I am a buyer</p>
                    <div class="mb-2">
                        <span class="d-block font-bold">Register as a buyer</span>
                        <span class="d-block pl-2">- Enter your contact details</span>
                        <span class="d-block pl-2">- Add your inquires</span>
                    </div>
                    <div>
                        <span class="d-block font-bold">Benefits for buyer</span>
                        <span class="d-block pl-2">- Get access to global flower traders</span>
                        <span class="d-block pl-2">- Compare prices and choose best offer</span>
                        <span class="d-block pl-2">- Buy in a safe environment</span>
                        <span class="d-block pl-2">- Get information about the seller’s past performances</span>
                        <span class="d-block pl-2">- Get access to monthly/annual reports</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
