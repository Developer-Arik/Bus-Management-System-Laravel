@extends('master')
@section('body')
 <div class="container py-3">
  <div class="row">
   <div class="col-md-6 offset-3">
    <form method="post" class="w-100">
     <div class="alert alert-success">
      An OTP verification code sent to {{ $email }}
     </div>
      @error('code')
       <div class="alert alert-danger">
        {{ $message }}
       </div>
      @enderror
     @csrf
     <div class="py-2">
      <label for="pad-log" class="form-label">OTP</label>
      <input type="number" name="code" class="form-control border-3 rounded-0 shadow-none" id="pad-log" placeholder="VERIFICATION CODE" >
     </div>
     <div class="py-1">
      <input type="submit" value="Verify" class="btn btn-outline-primary rounded-0 shadow-none border-2">
     </div>
  </form>
   </div>
  </div>
 </div>
@endsection
