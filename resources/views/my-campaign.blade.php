@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h5 class="h5">Campaign Info</h5>
    <div class="text-right mt-1 mb-1">
        @if(!in_array($campaign->status, [16,3]))
        <a href="/my-campaigns/{{$campaign->id}}/cancel" class="btn btn-warning" onclick="return confirm('are you sure?')">
            Cancel campaign
        </a>
        @endif
        @if($campaign->status == 1)
        <a href="/my-campaigns/{{$campaign->id}}/delete" class="btn btn-danger" onclick="return confirm('are you sure?')">
            Delete campaign
        </a>
        @endif
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <td>Id</td>
                <td>{{$campaign->id}}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <span>@if($campaign->status == 0) New @endif</span>
                    <span>@if($campaign->status == 1) Pending @endif</span>
                    <span>@if($campaign->status == 2) Sending in progress @endif</span>
                    <span>@if($campaign->status == 3) Sent @endif</span>
                    <span>@if($campaign->status == 16) Cancelled @endif</span>
                </td>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{$campaign->name}}</td>
            </tr>
            <tr>
                <td>Message</td>
                <td>{{$campaign->message->body}}</td>
            </tr>
            <tr>
                <td>Address Book Id</td>
                <td>{{$sms_campaign->data->address_book_id}}</td>
            </tr>
            <tr>
                <td>Sender Name</td>
                <td>{{$sms_campaign->data->sender_name}}</td>
            </tr>
            <tr>
                <td>Date created</td>
                <td>{{$sms_campaign->data->date_created}}</td>
            </tr>
            <tr>
                <td>Send date</td>
                <td>{{$sms_campaign->data->send_date}}</td>
            </tr>
            <tr>
                <td>Sent</td>
                <td>{{$summary['sent']}}</td>
            </tr>
            <tr>
                <td>Delivered</td>
                <td>{{$summary['delivered']}}</td>
            </tr>
            <tr>
                <td>Undelivered</td>
                <td>{{$summary['undelivered']}}</td>
            </tr>
        </table>
    </div>
</div>
@endsection