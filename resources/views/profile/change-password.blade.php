@extends('layouts.app')
@section('title')
Change Password
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
                    <h4 class="mb-sm-0">Change Password</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
           
            <!-- end col -->
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update your password</h4>
                        <hr>
                        <form method="POST" action="{{ route('admin.password.update') }}">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 position-relative">
                                        <label for="password" class="form-label">Name</label>
                                        <input type="password" class="form-control"  
                                            placeholder="Current Password" name="current_password" minlength="6" maxlength="12" />
                                        @error('current_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 position-relative">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="password" class="form-control" 
                                            placeholder="Password" name="password" minlength="6" maxlength="12" />
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                          
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 position-relative">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="password" class="form-control" 
                                            placeholder="Confirm Password" name="confirm_password" />
                                        @error('confirm_password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <button class="btn btn-primary" type="submit">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
    </div>
</div>
@endsection
 