@extends('master')
@section('body')
<div style="max-width: 1250px;" class="container-fluid">
 <div class="row">
  <div class="col-3 vertical-menu">
   <ul>
    <li>
        <a href="{{ route('profile') }}">Profile</a>
    </li>
    <li>
        <a href="{{ route('booking') }}" class="active">Bookings</a>
    </li>
   </ul>
  </div>
  <div class="col-9">
   <div class="brdcmp">
    <h2 class="title">Bookings</h2>
   </div>
   @foreach ($all as $item)
    <div class="ticket-card">
        <div class="details">
            <h5 class="pnr">PNR {{ $item['pnr'] }} {{ $item['paid'] ? '(PAID)' : '(UNPAID)' }}</h5>
            <h6 class="desc">Seat : {{ $item['seats'] }}, Bus : {{ $item['bus'] }} , Date: {{ $item['date'] }}, Time: {{ $item['time'] }}</h6>
            <p class="desc"></p>
        </div>
        <div class="ticket">
            <a href="{{ route('singleBooking',$item['pnr']) }}" class="btn btn-{{ $item['paid'] ? 'primary' : 'success'}} shadow-none rounded-0">{{ $item['paid'] ? 'View Details' : 'Pay Now'}}</a>
        </div>
    </div>
   @endforeach
   @if (sizeof($all)<1)
    <div class="ticket-card">
        <h5 class="p-0 m-0">No Booking Found</h5>
    </div>
   @endif
  </div>
 </div>
</div>
@endsection
{{-- https://eticket.railway.gov.bd/booking/train/trip-info/MjgzNQ== --}}
