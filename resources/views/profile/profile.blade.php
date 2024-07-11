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
                    <h4 class="mb-sm-0">Profile</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4">
                <div class="card p-12">
                    <div class="card-body">
                        <h4 class="card-title">Update you profile image</h4>
                        <hr>
                        <form action="{{ route('profile.update.image') }}" method="POST" enctype="multipart/form-data" id="updateProfileImg">
                            @csrf
                            @method('patch')
                            <div class="profile-photo">
                                <label class="file_label" for="file">
                                    <span class="cprofile glyphicon glyphicon-camera"></span>
                                    <p class="cCamera"><i class="fa fa-camera"></i></p>
                                    <br>
                                    <span class="cprofile">Change Profile</span>
                                </label>
                                <input id="file" type="file" name="profile_photo"
                                    accept="image/jpg, image/jpeg, image/png" id="profile_photo"
                                    onchange="loadFile(event)" />
                                <img src="{{ ( !empty($userDetails->profile_photo) && imageExists("$userDetails->profile_photo") ) ? 'data: image/jpeg;base64,' . \base64_encode(\file_get_contents(config('constants.PROFILE_PATH') . '/' . $userDetails->profile_photo)) : asset('backend/assets/images/default_profile.jpg') }}"
                                    alt="your image" id="output" width="200" />
                            </div>
                            <a class="profileEditBtn"><i class="bi bi-pencil-square"></i></a>
                            <div class="col-md-12 text-center">
                                <button type="submit" id="upload_img"
                                    class="btn btn-success btn-rounded waves-effect waves-light   d-none  uploadBtn btn-icon"><i
                                    class="fa fa-upload" aria-hidden="true"></i></button>
                                <button type="button" id="close"
                                    class="btn btn-danger btn-rounded waves-effect waves-light d-none  uploadBtn btn-icon"><i
                                    class="fa fa-times" aria-hidden="true"></i></button>
                                <span id="imageUplaoderro" class="badge badge-danger mt-3"></span> 
                                @error('profile_photo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <h5 class="title text-primary">
                                <p><small class="title text-primary"><small></small></small></p>
                            </h5>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update your profile details</h4>
                        <hr>
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control"  
                                            placeholder="name" name="name" value="{{ old('name', $userDetails->name) }}" />
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" 
                                            placeholder="Phone" name="phone" value="{{ old('phone', $userDetails->phone) }}" />
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" 
                                            placeholder="Email" name="email" value="{{ old('email', $userDetails->email) }}" name="email"/>
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control"  
                                            placeholder="Username" value="{{ old('username', $userDetails->username) }}"  />
                                        @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit">Update</button>
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
@section('script')
<script>
    function loadFile(event) {
        $("#imageUplaoderro").html("");
        var image = document.getElementById("output");
        if (/\.(jpeg|png|jpg)$/i.test(event.target.files[0].name) === false) {
            $("#imageUplaoderro").html("Allow only jpg | jpeg | png format");
            $("#upload_img").addClass('d-none');
            $("#close").addClass('d-none');
            return false;
        }
        if (event.target.files[0].size >= 2097152) {
            $("#imageUplaoderro").html("Profile image size must be less than 2 MB");
            image.src = URL.createObjectURL(event.target.files[0]);
            $("#upload_img").addClass('d-none');
            $("#close").addClass('d-none');
            return false;
        }
        image.src = URL.createObjectURL(event.target.files[0]);
        $('#upload_img').removeClass('d-none');
        $('#close').removeClass('d-none');
    }
    
    $("#close").click(function () {
        $('#output').attr('src', "{{ ( !empty($userDetails->profile_photo) && imageExists($userDetails->profile_photo) ) ? 'data: image/jpeg;base64,' . \base64_encode(\file_get_contents(config('constants.PROFILE_PATH') . '/' . $userDetails->profile_photo)) : asset('backend/assets/images/default_profile.jpg') }}");
        $("#select_img").removeClass('d-none');
        $("#upload_img").addClass('d-none');
        $("#close").addClass('d-none');
    });
    
</script>
@endsection