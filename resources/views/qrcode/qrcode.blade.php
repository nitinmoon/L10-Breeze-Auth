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
                    <h4 class="mb-sm-0">Product Import Bulk Job</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Product Import Bulk Job</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Here is the QR code</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    {!! $qrcode !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Package Used</h4>
                        <hr>
                        
                        <ul>
                            <li><span class="badge rounded-pill badge-soft-dark">composer require simplesoftwareio/simple-qrcode
                            </span>
                            </li> 
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection