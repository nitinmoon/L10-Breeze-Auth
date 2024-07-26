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
                    <h4 class="mb-sm-0">Google Drive Upload</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Google Drive Upload</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Upload here google drive file</h4>
                        <hr>
                        <form method="POST" action="{{ route('google.drive.upload') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label for="myfile" class="form-label">Upload File</label>
                                        <input type="file" class="form-control" name="myfile" />
                                        @error('myfile')
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
                        <h4 class="card-title"><span class="badge bg-secondary">2</span> Requirement </h4>
                        <hr>
                        <ul>
                            <li><span class="highlighter-rouge">composer require google/apiclient</span></li>
                            <li><span class="highlighter-rouge">Setup credentials as per follwing reference</span></li>
                            <li><b>Reference: </b></li>
                            <li><code class="highlighter-rouge">https://www.youtube.com/watch?v=WhlIQ2Sv6s8</code></li>
                            <li><code
                                    class="highlighter-rouge">https://www.youtube.com/watch?v=eB4Rj3bh8WE&t=1780s</code>
                            </li>
                            <li><code
                                    class="highlighter-rouge">https://github.com/jumawilliam/use-google-drive-as-laravel-storage/blob/main/app/Http/Controllers/GdriveController.php</code>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection