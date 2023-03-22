@extends('master')
@section('body')
<div style="max-width: 1250px;" class="container-fluid">
 <div class="row pt-3">
    @if (session('payment_success'))
        <div class="alert alert-success">
            {{session('payment_success')}}
        </div>
    @endif
 </div>
 <div class="row">
    <div class="col-12">
        <div class="brdcmp">
            <h2 class="title">Payment Info</h2>
           </div>
    </div>
 </div>
 <div class="row">
    <div class="col-{{ $item['paid']==false ? '9' : '12' }}">
        <div class="ticket-card">
            <div class="details">
                <h5 class="pnr">PNR {{ $item['pnr'] }} {{ $item['paid'] ? '(PAID)' : '(UNPAID)' }}</h5>
                <h6 class="desc">Seat : {{ $item['seats'] }}, Bus : {{ $item['bus'] }}</h6>
                <h6 class="desc">Date: {{ $item['date'] }}, Time: {{ $item['time'] }}</h6>
            </div>
        </div>
        <div class="seats-cont py-2">
            <h4>Bus Seats</h4>
            <ul class="seat-ul" style="grid-template-columns: repeat(4, 1fr);"></ul>
        </div>
    </div>
    @if ($item['paid']==false)
        <div class="col-3">
            <div class="alert alert-success mb-0 pb-0">
                <h5>Total Seat : {{ $item["ammount"] }}tk</h5>
                <h5>Service Charge : {{ $item["service_charge"] }}tk</h5>
                <h5>Total : {{ $item["ammount"]+$item["service_charge"] }}tk</h5>
            </div>
            <div class="py-2">
                <form action="{{ route('payment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pnr" value="{{ $item["pnr"] }}">
                    <button class="btn btn-success shadow-none rounded-0">Pay Now</button>
                </form>
            </div>
        </div>
    @endif
 </div>
</div>
@endsection
@section('style')
    <meta name="busId" value="{{ $busId }}">
    <meta name="seats" value='{{ $seats }}' >
    <style>
        .seat-ul{
            margin: 0 !important;
            list-style-type:none;
            padding: 0;
            display: grid;
            width:fit-content;
            grid-template-columns: repeat(5,1fr);
        }
        .seat-ul > .seat{
            display: inline-flex;
            border-radius: 5px;
            width: 100%;
            justify-content: center;
            text-align: center;
            align-items: center;
            width: 45px;
            height: 45px;
            margin: 4px;
            color: #ffffff;
            background: #299106;
            cursor: pointer;
            box-shadow: 0 0;
            font-weight: 600;
        }
        .seat-ul > .seat.marked{
            color: #fff;
            background: rgb(255, 21, 0);
        }
        .seat-ul > .spacer{
            display: inline-flex;
            /* border: 1px solid #000; */
            width: 100%;
            justify-content: center;
            text-align: center;
            align-items: center;
            padding: 14px;
            width: 45px;
            height: 45px;
            margin: 4px;
        }
    </style>
@endsection
@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('token')
        }
    });
    let seats;

    function loadSeats(){
        let xAxises = [];
        let yAxises = [];

        for (let index = 0; index < seats.length; index++) {
            const element = seats[index].xaxis;
            xAxises.push(element);
        }
        for (let index = 0; index < seats.length; index++) {
            const element = seats[index].yaxis;
            yAxises.push(element);
        }

        for (let index = 1; index <= Math.max(...xAxises); index++){
            const sl = index;
            for (let index = 1; index<= Math.max(...yAxises); index++){
                    let seat = seats.filter((seat) => {
                        return seat.xaxis===sl && seat.yaxis===index
                    })[0];
                    $(".seat-ul").css(`grid-template-columns`,`repeat(${Math.max(...yAxises)},1fr)`);
                    if(seat!=undefined){
                        $(".seat-ul").append(`<li class="seat ${seat.marked===true ? 'marked' : ''}">${seat.seatNo}</li>`);
                    }else{
                        $(".seat-ul").append(`<li class="spacer"></li>`);
                    }
            }
        }
    }

    $.ajax({
        type: "GET",
        url: "/seats/"+$(`meta[name="busId"]`).attr("value"),
        data: {
            "marked" : $(`meta[name="seats"]`).attr("value")
        },
        dataType: "JSON",
        success: function (response) {
            seats = response;
            loadSeats();
        }
    });
</script>
@endsection
