@extends('layouts.app')
@section('title')
Profile
@endsection
@section('css')
<link href="{{ asset('backend/assets/custom-css/profile.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Phonepe Integration</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Phonepe Integration</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Here we can see the Phonepe Integration</h4>
                        <hr>
                        <form method="POST" action="{{ route('phonepe.initiate') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label for="amount" class="form-label">Enter Amount <span class="error">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="amount"
                                            placeholder="Enter amount" />
                                        @error('amount')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit">Initiate Payment</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Note: UAT Testing</h4>
                        <hr>

                        <ul>
                            <li><span class="badge rounded-pill badge-soft-dark">Debit Card</span></li>
                            <li><code class="highlighter-rouge">"card_number”: “4242424242424242”,</code></li>
                            <li><code class="highlighter-rouge">“card_type”: “DEBIT_CARD”,</code></li>
                            <li><code class="highlighter-rouge">“card_issuer”: “VISA”,</code></li>
                            <li><code class="highlighter-rouge">“expiry_year”: 2027,</code></li>
                            <li><code class="highlighter-rouge">“cvv”: “936”</code></li>
                            <li><code class="highlighter-rouge">“OTP”: “123456”</code></li>
                        </ul>
                        <hr>
                        <ul>
                            <li><span class="badge rounded-pill badge-soft-dark">How to verify Net Banking Flow</span>
                            </li>
                            <li><code class="highlighter-rouge">Always use “bankId”: <b>“SBIN”</b> for testing purposes.</code></li>
                            <li><code class="highlighter-rouge">Username: <b>test</b></code></li>
                            <li><code class="highlighter-rouge">Password: <b>test</b></code></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Note: Do the following changes:</h4>
                        <hr>
                        <ul>
                            <li>php artisan cache:clear</li>
                            <li>php artisan config:cache</li>
                            <li>php artisan route:cache</li>
                            <li>php artisan optimize</li>
                        </ul>
                        <hr>
                        <ul>
                            <li>Go to the config/session.php then <br> Change <br>
                                'same_site' => null, <br>instead of <br> 'same_site' => 'lax'
                            </li>
                        </ul>
                        <hr>
                        <ul>
                            <li>Go to the app/Http/Middleware/VerifyCsrfToken.php then <br> Add <br>
                                protected $except = [
                                '/admin/phonepe/callback', // Adjust this to match your callback URL route
                                ];
                                <br>
                                Because callback url is post format and in laravel we want the csrf token and it is not
                                possible so thats why we have to pass callback url in exceptso it will not check csrf
                                token for this url.
                            </li>
                        </ul>



                    </div>
                </div>
                <!-- end card -->
            </div>



        </div>
    </div>
</div>
@endsection