@extends('auth.master')

@section('title')
Login
@endsection

@section('content')
<div class="wrapper-page">
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">
                <div class="text-center mt-4">
                    <div class="mb-3">
                        <a href="index.html" class="auth-logo">
                        <img src="{{ asset('backend/assets/images/logo-dark.png') }}" height="30"
                            class="logo-dark mx-auto" alt="">
                        <img src="{{ asset('backend/assets/images/logo-light.png') }}" height="30"
                            class="logo-light mx-auto" alt="">
                        </a>
                    </div>
                </div>
                <h4 class="text-muted text-center font-size-18"><b>Forgot Password</b></h4>
                
                <div class="p-3">
                    <form method="POST" class="form-horizontal mt-3" action="{{ route('password.email') }}">
                    @if (session('status'))
                   
                       
                   <div class="alert alert-info alert-dismissible fade show" role="alert">
                   {{ session('status') }}
           </div>
              
           @endif
                        @csrf
                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input class="form-control" type="text" id="email" name="email" value="{{ old('email') }}" placeholder="Email/Username">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group mb-3 text-center row mt-3 pt-1">
                            <div class="col-12">
                                <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Email Password Reset Link</button>
                            </div>
                        </div>
                        <div class="form-group mb-0 row mt-2">
                           <div class="col-sm-12 mt-3 text-center">
                                <a href="{{ route('login') }}" class="text-muted"><i class="mdi mdi-account-circle"></i> Already have account?</a>
                            </div>
                        </div>
                    </form>
                    <!-- end form -->
                </div>
            </div>
            <!-- end cardbody -->
        </div>
        <!-- end card -->
    </div>
    <!-- end container -->
</div>
@endsection