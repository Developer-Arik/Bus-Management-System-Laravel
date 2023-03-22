@extends('master')
@section('body')
<div class="container py-3">
 <div class="row">
  <div class="col-12 col-md-6 offset-md-3">
    <h1>Forgot Password</h1>
    <div class="py-2"></div>
    <div class="msg-box"></div>
    <form id="forgot-box" method="post" class="w-100">
        <div class="py-2">
        <label for="email-log" class="form-label">Email</label>
        <input type="text" name="code" class="form-control border-3 rounded-0 shadow-none" id="email-log" placeholder="Your Email" >
        </div>
        <div class="py-1">
        <input type="submit" value="Send Email" class="btn btn-outline-primary rounded-0 shadow-none border-2">
        </div>
    </form>
    <form id="otp-box" class="w-100">
        <div class="py-2">
        <label for="pad-log" class="form-label">OTP</label>
        <input type="number" name="code" class="form-control border-3 rounded-0 shadow-none" id="pad-log" placeholder="VERIFICATION CODE" >
        </div>
        <div class="py-1">
        <input type="submit" value="Verify" class="btn btn-outline-primary rounded-0 shadow-none border-2">
        <input id="forgot-password-resend-email" type="button" value="Resend" class="btn btn-success rounded-0 shadow-none border-2 disabled">
        </div>
    </form>
  </div>
 </div>
</div>
@endsection
