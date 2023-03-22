@extends('master')
@section('body')
<section class="h-100">
 <div class="container-fluid">
   <div class="row d-flex align-items-center">
     <div class="col-sm-6 text-black d-flex justify-content-center flex-column">
       <div class="py-2">
         <h2 class="fw-normal">Create Account</h2>
       </div>
       <div class="d-flex align-items-center">
         <form method="post" style="width: 23rem;" class="w-100">
          @csrf
            <div class="py-2">
              <label for="fnam-log" class="form-label">Name</label>
              <input id="fnam-log" name="name" type="text" class="form-control border-3 rounded-0 shadow-none" value="{{ old('name') }}" placeholder="First Name">
              @error('name')
               <label for="fnam-log" class="form-label text-danger">{{ $message }}</label>
              @enderror
            </div>
            <div class="py-2">
              <label for="enam-log" class="form-label">Email</label>
              <input id="enam-log" name="email" type="text" class="form-control border-3 rounded-0 shadow-none" value="{{ old('email') }}" placeholder="Email">
              @error('email')
               <label for="enam-log" class="form-label text-danger">{{ $message }}</label>
              @enderror
            </div>
            <div class="py-2">
              <label for="pwd-log" class="form-label">Password</label>
              <input id="pwd-log" name="password" type="password" class="form-control border-3 rounded-0 shadow-none" value="{{ old('password') }}" placeholder="Password">
              @error('password')
               <label for="pwd-log" class="form-label text-danger">{{ $message }}</label>
              @enderror
            </div>
            <div class="py-2">
              <label for="cnfp-log" class="form-label">Confirm Password</label>
              <input id="cnfp-log" name="confirm_password" type="password" class="form-control border-3 rounded-0 shadow-none" placeholder="Confirm Password">
              @error('confirm_password')
               <label for="cnfp-log" class="form-label text-danger">{{ $message }}</label>
              @enderror
            </div>
            <div class="py-1">
             <input type="submit" value="Create Account" class="btn btn-outline-primary rounded-0 shadow-none border-2">
            </div>
           <p class="my-3"><a class="text-muted" href="{{ route('forgetPassword') }}">Forgot password?</a></p>
           <p>Already have an account? <a href="{{ route('login') }}" class="link-info">Login</a></p>
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
