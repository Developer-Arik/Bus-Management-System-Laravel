@extends('admin.master')
@section('body')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Starlight</a>
    <span class="breadcrumb-item active">Book Seat </span>
</nav>
<div class="sl-pagebody">
    <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
        @csrf
        <h6 class="card-body-title">Book Seat: {{ $doj }} {{$scedule['from']}} - {{$scedule['to']}}</h6>
        <p class="mg-b-20 mg-sm-b-30">Date : {{ \Carbon\Carbon::parse($doj)->format('d') }} {{ \Carbon\Carbon::parse($doj)->format('M') }},{{ \Carbon\Carbon::parse($doj)->format('Y') }} Time : {{ $scedule['time'] }} Bus : {{ $scedule['bus'] }}</p>
        <div class="row">
            <div id="appendSeats" class="col-sm-4 mg-t-10 mg-sm-t-0 align-items-center text-center">
                <div class="seats py-2">
                    <ul class="seat-ul">
                    </ul>
                </div>
                <div class="loading">
                    <h5>Loading...</h5>
                    <img src="https://d19qjkjk65tfln.cloudfront.net/img/bangladesh-railway-loader.gif" width="40px" alt="">
                </div>
            </div>
            <div class="col-sm-8">
                <div class="table-responsive">
                    <table class="table mg-b-0">
                        <thead>
                            <tr>
                                <th>Seat No</th>
                                <th>Fare</th>
                            </tr>
                        </thead>
                        <tbody id="append-trips">
                            <tr>
                                <th>Grand Total</th>
                                <th>0</th>
                            </tr>
                        </tbody>
                    </table>
                    <div id="email-box" class="py-2">
                        <input id="reserve-email" class="form-control" placeholder="Email" type="text">
                        <label class="p-0 py-1 text-danger" for="reserve-email"></label>
                        <button id="SeatsSubmit" type="button" class="btn btn-primary btn-block mg-t-10">Book Seats</button>
                    </div>
                    <div class="py-2" id="otp-box" style="display: none">
                        <input id="reserve-email-otp" class="form-control" placeholder="OTP" type="number">
                        <label class="p-0 py-1 text-danger" for="reserve-email-otp"></label>
                        <button id="OtpSubmit" type="button" class="btn btn-success btn-block mg-t-10">Submit Otp</button>
                    </div>
                </div>
            </div>
        </div><!-- row -->
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
            box-shadow: 0px 1px 3px 0px #000;
            font-weight: 500;
        }
        .seat-ul > .seat.avv{
            border: #000;
            background: #299106 !important;
            color: rgb(255, 255, 255) !important;
        }
        .seat-ul > .seat.bkk{
            cursor: no-drop;
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
        .seat-ul > .seat.sel{
            color: #000 !important;
            background: #ffe30d !important;
        }
    </style>
@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN' : $('meta[name="csrf_token"]').attr("token")
            }
        });

        const fare = {{ $fare }};
        let selectedSeats = [];
        let seats;

        function loadTrips(){
            $("#append-trips").html('');
            for (let index = 0; index < selectedSeats.length; index++) {
                const element = selectedSeats[index];
                $("#append-trips").append(`<tr>
                    <th>${element}</th>
                    <th>${fare}</th>
                </tr>`);
            }
            $("#append-trips").append(`<tr>
                    <th>Grand Total</th>
                    <th>${(fare*(selectedSeats.length))}</th>
                </tr>`);
        }

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
                            $(".seat-ul").append(`<li sid="${seat.id}" seatNo="${seat.seat_no}" class="seat${seat.status===1 ? ' bkk' : ' avv'}">${seat.seat_no}</li>`);
                        }else{
                            $(".seat-ul").append(`<li class="spacer"></li>`);
                        }
                }
            }
            $('.seat.avv').click(function (e) {
                e.preventDefault();
                if(!$(this).hasClass('sel')){
                    if(selectedSeats.length<4){
                        $(this).addClass('sel');
                        selectedSeats = [...selectedSeats,$(this).attr('seatNo')];
                        console.log(selectedSeats);
                        loadTrips();
                    }
                    else{
                        alert("Cannot select seat more than 4 seats");
                    }
                }else{
                    const index = selectedSeats.indexOf($(this).attr('seatNo'),0);
                    selectedSeats.splice(index,1);
                    $(this).removeClass('sel');
                    loadTrips();
                    console.log(selectedSeats);
                }
            });
        }

        $.ajax({
            type: "GET",
            url: "/api/load-scedule/",
            dataType: "JSON",
            data: {
                "id" : {{ $id }},
                "doj" : window.location.href.split('/')[window.location.href.split('/').length-1]
            },
            success: function (response){
                $("#appendSeats > .loading").hide();
                seats = response.bus.seats;
                loadSeats();
            }
        });
        $("#SeatsSubmit").click(function (e) {
            e.preventDefault();
            const seats = selectedSeats;
            if(seats.length>0){
                $.ajax({
                    type: "POST",
                    url: "/admin/ajax/reserve",
                    data: {
                        "scedule_id" : {{ $id }},
                        "doj" : window.location.href.split('/')[window.location.href.split('/').length-1],
                        "seats" : seats,
                        "email" : $("#reserve-email").val()
                    },
                    dataType: "JSON",
                    success: function (res){
                        $("#email-box").hide();
                        $("#otp-box").prepend(`
                        <div class="alert alert-success">
                                        ${res.message}
                        </div>`);
                        $("#otp-box").show();
                    },
                    error: function (err){
                        $(`label[for="reserve-email"]`).html(err.responseJSON.errors.email[0]);
                    }
                });
            }else{
                alert("Select seats to book");
            }
        });
        $("#OtpSubmit").click(function (e) {
            e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "/admin/ajax/reserve-verify",
                    data: {
                        "scedule_id" : {{ $id }},
                        "doj" : window.location.href.split('/')[window.location.href.split('/').length-1],
                        "seats" : selectedSeats,
                        "email" : $("#reserve-email").val(),
                        "otp" : $("#reserve-email-otp").val()
                    },
                    dataType: "JSON",
                    success: function (res){
                        alert(res.message);
                        window.location.reload();
                    },
                    error: function (err){
                        if(err.status===422){
                            $(`label[for="reserve-email-otp"]`).html(err.responseJSON.errors.otp[0]);
                        }
                        if(err.status===401){
                            $(`label[for="reserve-email-otp"]`).html(err.responseJSON.message);
                        }
                    }
                });
        });
    </script>
@endsection
