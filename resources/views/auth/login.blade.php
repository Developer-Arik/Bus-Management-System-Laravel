@extends('master')
@section('body')
<section class="h-100">
 <div class="container-fluid">
   <div class="row d-flex align-items-center">
     <div class="col-sm-6 text-black d-flex justify-content-center flex-column">
       <div class="py-2">
         <h2 class="fw-normal">Log in</h2>
       </div>
       <div class="d-flex align-items-center w-100">
         <form method="post" style="width: 23rem;" class="w-100">
            @csrf
            <div class="py-2">
              <label for="mail-log" class="form-label">Email</label>
              <input id="mail-log" name="email" type="text" class="form-control border-3 rounded-0 shadow-none" value="{{ old('email') }}" placeholder="Email" >
              @error('email')
               <label for="mail-log" class="form-label text-danger">{{ $message }}</label>
              @enderror
            </div>
            <div class="py-2">
             <label for="pad-log" class="form-label">Password</label>
              <input type="password" name="password" class="form-control border-3 rounded-0 shadow-none" id="pad-log" placeholder="Password" >
              @error('password')
               <label for="pad-log" class="form-label text-danger">{{ $message }}</label>
              @enderror
            </div>
            <div class="py-1">
             <input type="submit" value="Login" class="btn btn-outline-primary rounded-0 shadow-none border-2">
            </div>
           <p class="small mb-5 pb-lg-2"><a class="text-muted" href="{{ route('forgetPassword') }}">Forgot password?</a></p>
           <p>Don't have an account? <a href="{{ route('register') }}" class="link-info">Register here</a></p>
         </form>
       </div>
     </div>
     <div class="col-sm-6 px-0 d-none d-sm-block">
       <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img3.webp" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
     </div>
   </div>
 </div>
</section>
@endsection
