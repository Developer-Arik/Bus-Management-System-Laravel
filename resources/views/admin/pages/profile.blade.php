@extends('admin.master')
@section('body')
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Starlight</a>
      <span class="breadcrumb-item active">Profile</span>
    </nav>
    @if (session('info-updated'))
        <div class="alert alert-success">
            {{ session('info-updated') }}
        </div>
    @endif
    <div class="sl-pagebody">
        <form method="POST" action="{{ route('admin.profile.update') }}" class="card pd-20 pd-sm-40 form-layout form-layout-4">
            @csrf
            <h6 class="card-body-title">Update Profile</h6>
            <p class="mg-b-20 mg-sm-b-30"></p>
            <div class="row">
            <label for="name" class="col-sm-4 form-control-label">Name: </label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input value="{{ auth()->guard('admin')->user()->name }}" name="name" type="text" class="form-control" placeholder="Enter Name">
                @error('name')
                    <label class="form-label text-danger">{{ $message }}</label>
                @enderror
            </div>
            </div><!-- row -->
            <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label">Email: </label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input value="{{ auth()->guard('admin')->user()->email }}" name="email" type="text" class="form-control" placeholder="Enter email address">
                @error('email')
                    <label class="form-label text-danger">{{ $message }}</label>
                @enderror
            </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Role: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input  type="text" class="form-control" disabled placeholder="Admin">
                </div>
            </div>
            <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label">Enter Password: </label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input name="password" type="password" class="form-control" placeholder="Password" />
                @error('password')
                    <label class="form-label text-danger">{{ $message }}</label>
                @enderror
            </div>
            </div>
            <div class="form-layout-footer mg-t-30">
            <button type="submit" class="btn btn-info mg-r-5">Update Profile</button>
            <a href="{{ route('admin.profile.password.change') }}" class="btn btn-secondary">Change Password</a>
            </div><!-- form-layout-footer -->
        </form>
    </div>
@endsection
