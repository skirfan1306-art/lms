@extends('admin.layout.app')

@section('main.content')
<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Contact Page Settings</h4>
                                    
                                </div><!-- end card header -->
                                <form action="{{ route('admin.contactSetting.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="row gy-4">
                                            
                                            <div class="col-md-6">
                                                <label for="banner" class="form-label">Banner Image</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="banner" name="banner" 
                                                        onchange="document.querySelector('#viewImage').src = window.URL.createObjectURL(this.files[0]);">

                                                    <label class="input-group-text" for="fav">Upload</label>
                                                </div>                                                
                                            </div>
                                            <div class="col-md-6">
                                                <img src="{{ asset('assets/front/images/contactpage/' . $contact->banner) }}" class="me-4" height="auto" width="100%" style="max-height:200px" id="viewImage" alt="No Banner Image Found">                                              
                                            </div>
                                         
                                            <div class="col-md-6">
                                                <div>
                                                    <label for="alt" class="form-label">Banner Image Alt</label>
                                                    <input type="text" class="form-control" id="alt" placeholder="Enter Banner Alt" name="banner_alt" value="{{ $contact->banner_alt }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div>
                                                    <label for="title" class="form-label">Banner Title</label>
                                                    <input type="text" class="form-control" id="title" placeholder="Enter Banner Title" name="bannerh1" value="{{ $contact->bannerh1 }}" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div>
                                                    <label for="sec1h1" class="form-label">Sec 1 Title</label>
                                                    <input type="text" class="form-control" id="sec1h1" placeholder="Enter Section 1 Title" name="sec1h1" value="{{ $contact->sec1h1 }}" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div>
                                                    <label for="sec1h1" class="form-label">Map Link</label>
                                                    <textarea class="form-control" id="sec1h1" rows="3" name="map_link">{{ $contact->map_link }}</textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="form-check form-check-outline form-check-dark mb-3 col-12">
                                                <input class="form-check-input" type="checkbox" id="formCheck19" name="make_webp">
                                                <label class="form-check-label" for="formCheck19">Convert all images to WEBP format and reduce their size by 80%.</label>
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