@extends('master')
@section('body')
 <div class="container py-3">
  <div class="row">
   <div class="col-md-6 offset-3">
    <h1>Reset Password</h1>
    <form method="post" class="w-100">
     @csrf
     <input type="hidden" name="token" value="{{ $token }}">
     <input type="hidden" name="email" value="{{ $email }}">
     <div class="py-2">
        <label class="form-label">New Password</label>
        <input type="password" name="password" class="form-control border-3 rounded-0 shadow-none" placeholder="New Password">
        @error('password')
            <label class="form-label text-danger">{{ $message }}</label>
        @enderror
     </div>
     <div class="py-2">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="confirm_password" class="form-control border-3 rounded-0 shadow-none" placeholder="Confirm Password" >
        @error('confirm_password')
            <label class="form-label text-danger">{{ $message }}</label>
        @enderror
    </div>
     <div class="py-1">
      <input type="submit" value="Reset Password" class="btn btn-outline-primary rounded-0 shadow-none border-2">
     </div>
  </form>
   </div>
  </div>
 </div>
@endsection
