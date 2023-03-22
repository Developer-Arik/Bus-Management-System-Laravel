@extends('master')
@section('body')
<div style="max-width: 1250px;" class="container-fluid">
 <div class="row">
  <div class="col-3 vertical-menu">
   <ul>
    <li>
        <a href="{{ route('profile') }}" class="active">Profile</a>
    </li>
    <li>
        <a href="{{ route('booking') }}">Bookings</a>
    </li>
   </ul>
  </div>
  <div class="col-9">
    @if (session('Success'))
        <div class="mt-3">
            <div class="alert alert-success">
                {{ session('Success') }}
            </div>
        </div>
    @endif
   <div class="brdcmp">
    <h2 class="title">Profile</h2>
   </div>
   <form style="padding-bottom: 10px;" action="{{ route('update-profile') }}" method="post">
        @csrf
        <div>
            <label for="c_name" class="form-label">Name</label>
            <input id="c_name" name="c_name" type="text" class="form-control border-3 rounded-0 shadow-none" value="{{ old('name') ? old('name') : auth('web')->user()->name }}" placeholder="Name" >
            <label for="c_name" class="form-label text-danger">@error('c_name')
                {{ $message }}
            @enderror</label>
        </div>
        <div>
            <label class="form-label">Email</label>
            <input type="text" class="form-control border-3 rounded-0 shadow-none" placeholder="{{ auth('web')->user()->email }}" disabled>
            <label class="form-label text-danger"></label>
        </div>
        <div>
            <label for="cur_password" class="form-label">Current Password</label>
            <input id="cur_password" name="cur_password" type="password" class="form-control border-3 rounded-0 shadow-none" placeholder="Current Password">
            <label for="cur_password" class="form-label text-danger">@error('cur_password')
                {{ $message }}
            @enderror</label>
        </div>
        <div>
            <label for="c_password" class="form-label">Password</label>
            <input id="c_password" name="c_password" type="password" class="form-control border-3 rounded-0 shadow-none" placeholder="Password">
            <label for="c_password" class="form-label text-danger">@error('c_password')
                {{ $message }}
            @enderror</label>
        </div>
        <div>
            <label for="cnf_password" class="form-label">Confirm Password</label>
            <input id="cnf_password" name="cnf_password" type="password" class="form-control border-3 rounded-0 shadow-none" placeholder="Confirm Password">
            <label for="cnf_password" class="form-label text-danger">@error('cnf_password')
                {{ $message }}
            @enderror</label>
        </div>
        <div class="p-0 m-0">
            <button type="submit" class="btn rounded-0 btn-outline-primary border-2 shadow-none m-0">Submit</button>
        </div>
   </form>
  </div>
 </div>
</div>
@endsection
