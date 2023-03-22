@extends('admin.master')
@section('body')
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">{{ $bus->name }}</h6>
            <p class="mg-b-20 mg-sm-b-30">{{/* Total Number of seats */ sizeOf($bus->seats) }} Seats</p>
            <div class="row mg-t-20">
                <div class="col-12 mg-sm-t-0">
                    <div class="seats py-2">
                        <ul class="seat-ul">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card pd-20 pd-sm-40">
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
                            $(".seat-ul").append(`<li class="seat">${seat.seatNo}</li>`);
                        }else{
                            $(".seat-ul").append(`<li class="spacer"></li>`);
                        }
                }
            }
        }

        $.ajax({
            type: "GET",
            url: "/seats/"+{{ $bus->id }}+"?marked=[]",
            dataType: "JSON",
            success: function (response) {
                seats = response;
                loadSeats();
            }
        });
    </script>
@endsection
