@extends('auth.master')
@section('title')
Register
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
                <h4 class="text-muted text-center font-size-18"><b>Password Reset </b></h4>
                <div class="p-3">
                    <form method="POST" class="form-horizontal mt-3" action="{{ route('password.store') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input class="form-control" type="text" id="email" name="email" value="{{ old('email', $request->email) }}"
                                    placeholder="Email" readonly>
                                @error('name')
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
                                <input class="form-control" type="password" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirm Password">
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group text-center row mt-3 pt-1">
                            <div class="col-12">
                                <button class="btn btn-info w-100 waves-effect waves-light"
                                    type="submit">Reset Password</button>
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