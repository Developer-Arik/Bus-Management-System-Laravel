@extends('admin.master')
@section('body')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Starlight</a>
    <span class="breadcrumb-item active">Add Bus</span>
</nav>
<div class="sl-pagebody">
    @error('seats')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    <form method="POST" action="" class="card pd-20 pd-sm-40 form-layout form-layout-4">
        @csrf
        <input id="seat-input" type="hidden" name="seats" value="[]">
        <h6 class="card-body-title">Add Point</h6>
        <p class="mg-b-20 mg-sm-b-30"></p>
        <div class="row">
            <label for="name" class="col-sm-4 form-control-label">Name: </label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input value="{{ old('name') }}" name="name" type="text" class="form-control" placeholder="Enter Name">
                @error('name')
                    <label class="form-label text-danger">{{ $message }}</label>
                @enderror
            </div>
        </div><!-- row -->
        <div class="row mg-t-20">
            <label for="max_row" class="col-sm-4 form-control-label">Counter:</label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                
            </div>
        </div><!-- row -->
        <div class="form-layout-footer mg-t-30">
            <button type="submit" class="btn btn-info mg-r-5">Save</button>
        </div><!-- form-layout-footer -->
    </form>
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
        }
        .seat-ul > .seat{
            display: inline-flex;
            border: 1px solid #000;
            width: 100%;
            justify-content: center;
            text-align: center;
            align-items: center;
            width: 45px;
            height: 45px;
            margin: 4px;
            box-shadow: 0px 0px 4px;
            cursor: pointer;
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
            box-shadow: 0px 0px 4px;
            cursor: pointer;
        }
    </style>
@endsection
@section('script')
@endsection
