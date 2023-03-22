@extends('admin.master')
@section('body')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Starlight</a>
    <span class="breadcrumb-item active">Booking</span>
</nav>
<div class="sl-pagebody">
    <div class="card pd-20 pd-sm-40">
        <p class="mg-b-20 mg-sm-b-30">
            <div class="input-group">
                <input autocomplete="off" id="doj" type="number" class="form-control" placeholder="Enter PNR">
                <div class="px-2"></div>
                <button id="SearchBuses" class="btn btn-primary" aria-disabled="true">Search</button>
            </div>
        </p>
    </div>
    <div class="py-3"></div>
    <div id="append-dt" class="card pd-20 pd-sm-40 text-center" style="display: none">
        <div class="col-12 dt" style="display: none">
            <div class="card pd-12 pd-sm-40">
                <h6 class="card-body-title">Booking PNR : 9338383</h6>
                <p class="mg-b-20 mg-sm-b-30"></p>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Bus: </label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control bus" disabled="" placeholder="Hanif Volvo">
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Email: </label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control email" disabled="" placeholder="arikanzum199@gmail.com">
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">From: </label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control from" disabled="" placeholder="Dhaka">
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">To: </label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control to" disabled="" placeholder="Comilla">
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Time: </label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control time" disabled="" placeholder="7:30 PM">
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Date: </label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control date" disabled="" placeholder="7:30 PM">
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Seats: </label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control seats" disabled="" placeholder="A1,A2">
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label"></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <ul class="seat-ul">
                        </ul>
                    </div>
                </div>
              </div>
        </div>
        <div class="loading">
            <h5>Loading...</h5>
            <img src="https://d19qjkjk65tfln.cloudfront.net/img/bangladesh-railway-loader.gif" width="40px" alt="">
        </div>
        <div class="nrf py-3 text-center" style="display: none">
            <h5></h5>
        </div>
    </div>
</div>
@endsection
@section('style')
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
            border: 2px solid rgb(255, 0, 140);
            border-radius: 5px;
            width: 100%;
            justify-content: center;
            text-align: center;
            align-items: center;
            width: 45px;
            height: 45px;
            margin: 4px;
            background: rgb(255, 21, 0);
            cursor: pointer;
            color: #fff;
            box-shadow: 0 0;
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
        .seat-ul > .seat.marked{
            background: #00ff9d;
            color: #000000;
        }
    </style>
@endsection
@section('script')
    <script>
        function loadSeats(seats){
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
                        if(seat!=undefined && seat.marked!=true){
                            $(".seat-ul").append(`<li class="seat">${seat.seatNo}</li>`);
                        }else if(seat!=undefined && seat.marked==true){
                            $(".seat-ul").append(`<li class="seat marked">${seat.seatNo}</li>`);
                        }
                        else{
                            $(".seat-ul").append(`<li class="spacer"></li>`);
                        }
                }
            }
        }
        $("#SearchBuses").click(function (e) {
            e.preventDefault();
            $("#append-dt .dt").hide();
            $("#append-dt .nrf").hide();
            $("#append-dt").show();
            $("#append-dt .loading").show();
            $.ajax({
                type: "GET",
                url: "/admin/booking/search",
                data: {
                    pnr : $('#doj').val()
                },
                dataType: "JSON",
                success: function (response){
                    $("#append-dt .loading").hide();
                    $("#append-dt .dt .card-body-title").html(`Booking PNR : ${$('#doj').val()} ${response.paid===true ? pays='PAID' : pays='UNPAID'}`);
                    $("#append-dt .dt .bus").attr("placeholder",response.bus);
                    $("#append-dt .dt .email").attr("placeholder",response.email);
                    $("#append-dt .dt .from").attr("placeholder",response.departure);
                    $("#append-dt .dt .to").attr("placeholder",response.destination);
                    $("#append-dt .dt .time").attr("placeholder",response.time);
                    $("#append-dt .dt .date").attr("placeholder",response.date);
                    $("#append-dt .dt .seats").attr("placeholder",response.seats.join(','));
                    $("#append-dt .dt").show();
                    $.ajax({
                        type: "GET",
                        url: "/seats/"+response.busID,
                        data : {
                            marked : response.seats
                        },
                        dataType: "JSON",
                        success: function (response) {
                            loadSeats(response);
                        }
                    });
                },
                error : function (err){
                    $("#append-dt .loading").hide();
                    $("#append-dt .nrf > h5").html(err.responseJSON.message);
                    $("#append-dt .nrf").show();
                }
            });
        });
    </script>
@endsection
