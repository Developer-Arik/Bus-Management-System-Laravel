@extends('master')
@section('body')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="my-3 bg-danger">
                <h5 class="pt-1 pb-0 mb-0 px-2 text-white w-100">Route : {{ $from }} to {{ $to }}</h5>
                <h6 class="pb-1 px-2 text-white w-100">Date : {{ $date }}</h6>
            </div>
        </div>
        <div class="col-12">
            <table class="w-100 scedule-table">
                <thead style="background: #de9459">
                    <tr>
                        <th>Departure</th>
                        <th>Destination</th>
                        <th>Departure Time</th>
                        <th>Bus</th>
                        <th>Seat Available</th>
                        <th>Fare</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody id="append-trips">
                    <tr class="loading">
                        <th colspan="7" class="py-5 text-center">
                            <h4>Loading...</h4>
                            <img src="https://d19qjkjk65tfln.cloudfront.net/img/bangladesh-railway-loader.gif" width="40px" alt="">
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <div class="my-5"></div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        let selectedSeats = [];
        function loadSeats(seats,append,selectedSeats,sceduleId,fare){
            let xAxises = [];
            let yAxises = [];
            loadTrips([],sceduleId,0);

            for (let index = 0; index < seats.length; index++) {
                const element = seats[index].xaxis;
                xAxises.push(element);
            }
            for (let index = 0; index < seats.length; index++) {
                const element = seats[index].yaxis;
                yAxises.push(element);
            }
            append.css(`grid-template-columns`,`repeat(${Math.max(...yAxises)},1fr)`);
            for (let index = 1; index <= Math.max(...xAxises); index++){
                const sl = index;
                for (let index = 1; index<= Math.max(...yAxises); index++){
                        let seat = seats.filter((seat) => {
                            return seat.xaxis===sl && seat.yaxis===index
                        })[0];
                        if(seat!=undefined){
                            append.append(`<li sceduleId="${seat.scedule_id}" seatNo='${JSON.stringify({
                                "id" : seat.id,
                                "seat_no" : seat.seat_no
                            })}' class="seat ${seat.status===0 ? "avv" : 'bkk'}">${seat.seat_no}</li>`);
                        }else{
                            append.append(`<li class="spacer"></li>`);
                        }
                }
            }

            $('.seat.avv').click(function (e){
                e.preventDefault();
                if(!$(this).hasClass('sel')){
                    if(selectedSeats.length<4){
                        $(this).addClass('sel');
                        const newObj = {...JSON.parse($(this).attr('seatNo')),sceduleId : $(this).attr('sceduleId')};
                        selectedSeats = [...selectedSeats,newObj];
                        loadTrips(selectedSeats,sceduleId,fare);
                    }
                    else{
                        alert("Cannot select seat more than 4 seats");
                    }
                }else{
                    const index = selectedSeats.indexOf($(this).attr('seatNo'),0);
                    selectedSeats.splice(index,1);
                    $(this).removeClass('sel');
                    loadTrips(selectedSeats,sceduleId,fare);
                }
            });
        }
        function loadTrips(selectedSeats = [],id = 0,fare = 0){
            const seats = selectedSeats.filter((seat) => {
                return seat.sceduleId===id;
            });
            const toAppend = $(`tr[sceduleid="${id}"]`).find('.append-trips');
            toAppend.html('');
            for (let index = 0; index < seats.length; index++) {
                const element = seats[index];
                toAppend.append(`<tr>
                    <th>${element.seat_no}</th>
                    <th>${fare}</th>
                </tr>`);
            }
            toAppend.append(`<tr>
                    <th>Total</th>
                    <th>${seats.length*fare}</th>
            </tr>`);
            if(selectedSeats.length>0){
                const data = {
                    seat_list : seats,
                    sceduleId : selectedSeats[0].sceduleId,
                    date : doj
                };

                $(`input[name="seat_json"]`).val(JSON.stringify(data));
                $('.reserve-seat').removeAttr('disabled');
            }else{
                $('.reserve-seat').attr("disabled", "disabled");
            }
        }
        const doj = new URLSearchParams(window.location.search).get('doj');
        $.ajax({
            type: "GET",
            url: "http://localhost:8000/api/load-trip",
            data: {
                from : {{ request()->from }},
                to : {{ request()->to }},
                doj : doj
            },
            dataType: "JSON",
            success: function (response) {
                $("#append-trips .loading").remove();
                for (let index = 0; index < response.length; index++) {
                    const element = response[index];
                    $('#append-trips').append(`
                        <tr>
                            <th>${element.departure}</th>
                            <th>${element.destination}</th>
                            <th>${element.departure_time}</th>
                            <th>${element.bus.name}</th>
                            <th>${element.bus.seats.seat_count}</th>
                            <th>${element.fare}</th>
                            <th>
                                <button sceduleid="${element.id}" class="seat-viewbox-toggle btn btn-danger shadow-none rounded-0">View Seat</button>
                            </th>
                        </tr>
                    `);
                    $("#append-trips").append(`<tr style="display:none;" sceduleid="${element.id}" class="book-tray p-3">
                        <th colspan="7">
                            <div class="row">
                                <div class="col-6">
                                    <ul class="seat-ul" style="display : grid;grid-template-columns: repeat(6,1fr);">
                                    </ul>
                                    <div class="loading text-center py-5 w-100">
                                        <h5>Loading...</h5>
                                        <img src="https://d19qjkjk65tfln.cloudfront.net/img/bangladesh-railway-loader.gif" width="40px" alt="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <table class="w-100">
                                        <thead style="background: #dee2e6">
                                            <tr>
                                                <th style="background: #dee2e6;color:#000">Seat No</th>
                                                <th style="background: #dee2e6;color:#000">Fare</th>
                                            </tr>
                                        </thead>
                                        <tbody class="append-trips">
                                        </tbody>
                                    </table>
                                    <div class="py-2">
                                        <form action="/reserve-seat" method="POST">
                                            <input type="hidden" name="_token" value="${$('meta[name="csrf_token"]').attr("token")}"/>
                                            <input type="hidden" name="seat_json" value=""/>
                                            <button type="submit" class="btn btn-success shadow-none rounded-0 reserve-seat" disabled="disabled">Book Seats</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </th>
                    </tr>`);
                }
                $('.seat-viewbox-toggle').click(function (e) {
                    e.preventDefault();
                    $(`input[name="seat_json"]`).val('');
                    selectedSeats=[];
                    const id = $(this).attr('sceduleid');
                    $('.book-tray').hide();
                    $(`tr[sceduleid="${id}"]`).find('.seat-ul').html('');
                    $(`tr[sceduleid="${id}"]`).find('.loading').show();
                    if(!$(this).hasClass('open')){
                        $(`.seat-viewbox-toggle`).removeClass('open');
                        $(`.seat-viewbox-toggle[sceduleid="${id}"]`).addClass('open');
                        $(`tr.book-tray[sceduleid="${id}"]`).show();
                        $.ajax({
                            type: "GET",
                            url: `/api/load-scedule`,
                            data: {
                                id : id,
                                doj : doj
                            },
                            dataType: "JSON",
                            success: function (response) {
                                $(`tr[sceduleid="${id}"]`).find('.loading').hide();
                                loadSeats(response.bus.seats,$(`tr[sceduleid="${id}"]`).find('.seat-ul'),selectedSeats,id,response.fare);
                            }
                        });
                    }else{
                        $(`.seat-viewbox-toggle`).removeClass('open');
                        $(`.book-tray`).hide();
                    }
                });
            },
            error: function (err){
                    $("#append-trips .loading").remove();
                    $("#append-trips").append(`<tr>
                            <th colspan="7">No Trips Found</th>
                    </tr>`);
            }
        });
    </script>
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
        .reserve-seat{
            font-weight: 600;
        }
    </style>
    <style>
        .scedule-table tr{
            border: 2px solid rgb(0, 0, 0);
        }
        table.scedule-table thead{
            border-collapse: collapse;
            border-color : #de9459;
        }
        table.scedule-table > thead > tr th{
            padding: 8px 16px;
            border-collapse: collapse;
            color: #f9f9f9;
        }
        table.scedule-table > tbody > tr th{
            padding: 8px 16px;
            border-collapse: collapse;
            background: #f9f9f9;
        }
    </style>
@endsection
