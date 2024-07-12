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
                        <h4 class="card-title"> <span class="badge bg-secondary">1</span> Download CSV file for testing purpose  <a class="btn btn-sm btn-success float-right" download="" href="{{ asset('backend/ImportBulkCSV/product.csv') }}"><i class="fa fa-file-excel"></i> CSV File</a></h4>
                        <hr>
                        <form method="POST" action="{{ route('product.storeBulk') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label for="csv_file" class="form-label">Upload File</label>
                                        <input type="file" class="form-control" name="csv_file" accept=".csv" />
                                        @error('csv_file')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit">Import</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

            <div class="col-xl-6">
            <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><span class="badge bg-secondary">2</span> Here we are sending emails using queue job just hit following link </h4>
                        <hr>
                        <a class="btn btn-sm btn-primary float-right" href="{{ route('product.sendProductJobQueue') }}"><i class="fa fa-file-excel"></i> Click here to send email vai queue</a>
                      
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
 