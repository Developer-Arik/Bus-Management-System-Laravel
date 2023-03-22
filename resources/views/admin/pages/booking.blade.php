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
                <select id="PointFrom" class="form-control select2" data-placeholder="From">
                    <option value="">From</option>
                    @foreach ($points as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <div class="px-2"></div>
                <select id="PointTo" class="form-control select2" data-placeholder="To">
                    <option value="">To</option>
                    @foreach ($points as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <div class="px-2"></div>
                <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                <input autocomplete="off" id="doj" type="text" class="form-control fc-datepicker" placeholder="MM/DD/YYYY">
                <div class="px-2"></div>
                <button id="SearchBuses" class="btn btn-primary" aria-disabled="true">Search</button>
            </div>
        </p>
        <div class="table-responsive">
            <table class="table mg-b-0">
                <thead>
                    <tr>
                        <th>SL No</th>
                        <th>Departure</th>
                        <th>Destination</th>
                        <th>Departure Time</th>
                        <th>Bus</th>
                        <th>Seat Available</th>
                        <th>Fare</th>
                        <th>Book Seat</th>
                    </tr>
                </thead>
                <tbody id="append-trips">
                </tbody>
            </table>
        </div>
        <div id="loading" class="py-5 text-center" style="display: none">
            <h5 class="p-0 m-0">Loading...</h5>
            <img src="https://d19qjkjk65tfln.cloudfront.net/img/bangladesh-railway-loader.gif" width="40px" alt="">
        </div>
        <div id="ntf" class="py-5 text-center" style="display: none">
            <h5>No Trips Found</h5>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $('#doj').datepicker({
            showOtherMonths: false,
            selectOtherMonths: false,
            numberOfMonths: 1
        });
    </script>
    <script src="{{ url('admin.js') }}"></script>
@endsection
