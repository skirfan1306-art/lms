@extends('admin.layout.app')

@section('main.content')
<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Site Settings</h4>
                                    
                                </div><!-- end card header -->
                                <form action="{{ route('admin.sitesetting.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="row gy-4">
                                         
                                            <div class="col-md-6">
                                                <div>
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="title" placeholder="Enter Site Title" name="title" value="{{ $setting->title }}" required>
                                                </div>
                                            </div>
                                       
                                            <div class="col-md-6">
                                                <div>
                                                    <label for="email" class="form-label">Email</label>
                                                    <div class="form-icon">
                                                        <input type="email" class="form-control form-control-icon" id="email" placeholder="info@domain.com" name="email" value="{{ $setting->email }}" required>
                                                        <i class="ri-mail-unread-line"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div>
                                                    <label for="placeholderInput" class="form-label">Number</label>
                                                    <input type="text" class="form-control" id="placeholderInput" placeholder="Enter Number" name="number" value="{{ $setting->number }}" required>
                                                </div>
                                            </div>                                         
                                           
                                            <div class="col-md-6">
                                                <label for="fav" class="form-label">Favicon</label>
                                                <div class="input-group">
                                                    <img src="{{ asset('assets/logo/' . $setting->favicon) }}" 
                                                        class="me-4" height="50px" width="50px" id="viewFav">

                                                    <input type="file" class="form-control" id="fav" name="favicon" 
                                                        onchange="document.querySelector('#viewFav').src = window.URL.createObjectURL(this.files[0]);">

                                                    <label class="input-group-text" for="fav">Upload</label>
                                                </div>                                                
                                            </div>

                                            <div class="col-md-6">
                                                <label for="logo" class="form-label">Header Logo</label>
                                                <div class="input-group">
                                                    <img src="{{ asset('assets/logo/' . $setting->logo) }}" 
                                                        class="me-4" height="50px" width="auto" id="viewlogo">

                                                    <input type="file" class="form-control" id="logo" name="logo" 
                                                        onchange="document.querySelector('#viewlogo').src = window.URL.createObjectURL(this.files[0]);">

                                                    <label class="input-group-text" for="logo">Upload</label>
                                                </div>                                                
                                            </div>
                                            <div class="col-md-6">
                                                <label for="footer_logo" class="form-label">Footer Logo</label>
                                                <div class="input-group">
                                                    <img src="{{ asset('assets/logo/' . $setting->footer_logo) }}" 
                                                        class="me-4" height="50px" width="auto" id="viewlogo2" style="background:black">

                                                    <input type="file" class="form-control" id="footer_logo" name="footer_logo" 
                                                        onchange="document.querySelector('#viewlogo2').src = window.URL.createObjectURL(this.files[0]);">

                                                    <label class="input-group-text" for="footer_logo">Upload</label>
                                                </div>                                                
                                            </div>
                                           
                                           
                                        </div>
                                        <!--end row-->
                                   
                                        <div class="mt-3">
                                        <a href="" class="btn btn-danger btn-label waves-effect waves-light">
                                            <i class="ri-delete-bin-5-line label-icon align-middle fs-16 me-2"></i> Cancel</a>

                                        <button type="submit" class="btn btn-success btn-label waves-effect waves-light">
                                            <i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i> Update</button>
                                        </div>
                                    </div>
                                    
                                </div>
                                </form>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->



                </div> <!-- container-fluid -->
            </div><!-- End Page-content -->

            @include('admin.layout.footer')
        </div>
@endsection