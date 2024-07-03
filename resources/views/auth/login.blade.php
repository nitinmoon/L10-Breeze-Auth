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
                <h4 class="text-muted text-center font-size-18"><b>Login</b></h4>
                @error('rate_error')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('rate_error')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @if (session('status'))
                    <div class="alert alert-success text-center">
                        {{ session('status') }}
                         
                    </div>
                @endif
                <div class="p-3">
                    <form method="POST" class="form-horizontal mt-3" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input class="form-control" type="text" id="login" name="login" value="{{ old('login') }}" placeholder="Email/Username">
                                @error('login')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input class="form-control" type="password" id="password" name="password"
                                    placeholder="Password">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                    <label class="form-label ms-1 fw-normal" for="customCheck1">Remember me</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3 text-center row mt-3 pt-1">
                            <div class="col-12">
                                <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>
                        <div class="form-group mb-0 row mt-2">
                            <div class="col-sm-7 mt-3">
                                <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                            </div>
                            <div class="col-sm-5 mt-3">
                                <a href="{{ route('register') }}" class="text-muted"><i class="mdi mdi-account-circle"></i> Create an account</a>
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