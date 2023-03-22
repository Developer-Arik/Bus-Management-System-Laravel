@extends('admin.master')
@section('body')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Starlight</a>
    <span class="breadcrumb-item active">Add Scedule</span>
</nav>
<div class="sl-pagebody">
    @error('seats')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    <form method="POST" action="" class="card pd-20 pd-sm-40 form-layout form-layout-4">
        @csrf
        <h6 class="card-body-title">Add Scedule</h6>
        <p class="mg-b-20 mg-sm-b-30"></p>
        <div class="row">
            <label  class="col-sm-4 form-control-label">Departure Point: </label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <select name="departure" class="form-control select2" data-placeholder="Departure Point">
                    <option value="">Departure Point</option>
                    @foreach ($points as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('departure')
                    <label class="form-label text-danger">{{ $message }}</label>
                @enderror
            </div>
        </div><!-- row -->
        <div class="py-2"></div>
        <div class="row">
            <label  class="col-sm-4 form-control-label">Destination Point: </label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <select name="destination" class="form-control select2" data-placeholder="Destination Point">
                    <option value="">Destination Point</option>
                    @foreach ($points as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('destination')
                    <label class="form-label text-danger">{{ $message }}</label>
                @enderror
            </div>
        </div><!-- row -->
        <div class="py-2"></div>
        <div class="row">
            <label  class="col-sm-4 form-control-label">Departure Time: </label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="time" name="time" class="form-control">
                @error('time')
                    <label class="form-label text-danger">{{ $message }}</label>
                @enderror
            </div>
        </div><!-- row -->
        <div class="py-2"></div>
        <div class="row">
            <label class="col-sm-4 form-control-label">Select Bus: </label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <select name="bus" class="form-control select2" data-placeholder="Bus">
                    <option value="">Select Bus</option>
                    @foreach ($bus as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('bus')
                    <label class="form-label text-danger">{{ $message }}</label>
                @enderror
            </div>
        </div><!-- row -->
        <div class="py-2"></div>
        <div class="row">
            <label  class="col-sm-4 form-control-label">Seat Fare: </label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="number" name="fare" class="form-control" placeholder="Seat Fare" />
                @error('fare')
                    <label class="form-label text-danger">{{ $message }}</label>
                @enderror
            </div>
        </div><!-- row -->
        <div class="form-layout-footer mg-t-30">
            <button type="submit" class="btn btn-info mg-r-5">Save</button>
        </div><!-- form-layout-footer -->
    </form>
</div>
@endsection
@section('script')
@endsection
