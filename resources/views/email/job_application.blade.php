@extends('email._layouts.base')

@section('content')
<h1>DashX Job Request</h1>

<p>You have received a job application. Please check below link for more details. 👍</p>
@php
$extra_data = json_decode($data->extra_data);
@endphp
<table class="email-table">
    <thead>

        <tr>
            <td>Name:</td>
            <td> {{$data->name}}</td>
        </tr>
        <tr>
            <td>Email:</td>
            <td> {{$data->email}}</td>
        </tr>
        @if($data->phone_number)
        <tr>
            <td>Phone Number:</td>
            <td> {{$data->phone_number}}</td>
        </tr>
        @endif
        @if($data->location)
        <tr>
            <td>Location:</td>
            <td> {{$data->location}}</td>
        </tr>
        @endif
        @if($data->experience)
        <tr>
            <td>Experience:</td>
            <td> {{$data->experience}}</td>
        </tr>
        @endif

    </thead>


</table>


<button class="email-btn"><a href="{{url('sw-admin')}}">View Details</a></button>

@endsection