@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-8">
            <h3 id="sendSms">Send sms</h3>
            <!-- send sms form -->
            <send-sms-form action="/send-sms">
                <div slot="form">
                    @csrf
                </div>
            </send-sms-form>
        </div>
    </div>
</div>
@endsection