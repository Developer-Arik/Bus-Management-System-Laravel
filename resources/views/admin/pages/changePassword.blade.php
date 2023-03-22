@extends('admin.master')
@section('body')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Starlight</a>
    <span class="breadcrumb-item active">Change Password</span>
  </nav>
  @if (session('password-updated'))
      <div class="alert alert-success">
          {{ session('password-updated') }}
      </div>
  @endif
<div class="sl-pagebody">
    <form method="POST" action="{{ route('admin.profile.password.update') }}" class="card pd-20 pd-sm-40 form-layout form-layout-4">
        @csrf
        <h6 class="card-body-title">Change Password</h6>
        <p class="mg-b-20 mg-sm-b-30"></p>
        <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label">Current Password: </label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="password" name="current_password" class="form-control" placeholder="Confirm Password" />
                @error('current_password')
                    <label class="form-label text-danger">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label">Enter Password: </label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="password" name="password" class="form-control" placeholder="Password" />
                @error('password')
                    <label class="form-label text-danger">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label">Confirm Password: </label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" />
                @error('confirm_password')
                    <label class="form-label text-danger">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="form-layout-footer mg-t-30">
        <button type="submit" class="btn btn-info mg-r-5">Update Password</button>
        </div><!-- form-layout-footer -->
    </form>
</div>
@endsection
