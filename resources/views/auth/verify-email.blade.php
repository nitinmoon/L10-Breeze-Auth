@extends('auth.master')

@section('title')
Verify Email
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
                <h4 class="text-muted text-center font-size-18"><b>Verify Email</b></h4>
                <h4 class="text-muted text-center font-size-13"><b>Thanks for signing up! Before getting started, could
                    you verify your email address by clicking on the link we just emailed to you? If you didn\'t
                    receive the email, we will gladly send you another.</b>
                </h4>
                @if (session('status') == 'verification-link-sent')
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    A new verification link has been sent to the email address you provided during registration.
                </div>
                @endif
                <div class="p-3">
                    <form method="POST" class="form-horizontal mt-3" action="{{ route('verification.send') }}">
                        @csrf
                        <div class="form-group pb-2 text-center row mt-3">
                            <div class="col-12">
                                <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Resend Verification Email</button>
                            </div>
                        </div>
                    </form>
                    <form method="POST" class="form-horizontal mt-3" action="{{ route('logout') }}">
                        @csrf
                        <div class="form-group pb-2 text-center row mt-3">
                            <div class="col-12">
                                <button class="btn btn-danger w-100 waves-effect waves-light" type="submit">Logout</button>
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