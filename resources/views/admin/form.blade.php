@extends('admin.layout.app')

@section('main.content')
<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Form Example</h4>
                                    
                                </div><!-- end card header -->
                                <form action="" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="row gy-4">
                                         
                                            <div class="col-md-6">
                                                <div>
                                                    <label for="placeholderInput" class="form-label">Input with Placeholder</label>
                                                    <input type="text" class="form-control" id="placeholderInput" placeholder="Placeholder">
                                                </div>
                                            </div>
                                       
                                            <div class="col-md-6">
                                                <div>
                                                    <label for="iconInput" class="form-label">Input with Icon</label>
                                                    <div class="form-icon">
                                                        <input type="email" class="form-control form-control-icon" id="iconInput" placeholder="example@gmail.com">
                                                        <i class="ri-mail-unread-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                          
                                            <div class="col-md-6">
                                                <div>
                                                    <label for="exampleInputdate" class="form-label">Input Date</label>
                                                    <input type="date" class="form-control" id="exampleInputdate">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputdate" class="form-label">Input Select</label>
                                                <div class="input-group">
                                                    <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                                    <select class="form-select" id="inputGroupSelect01">
                                                        <option selected>Choose...</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputdate" class="form-label">Input File</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="inputGroupFile02">
                                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-6">
                                                <div>
                                                    <label for="exampleFormControlTextarea5" class="form-label">Example Textarea</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea5" rows="3"></textarea>
                                                </div>
                                            </div>
                                           
                                        </div>
                                        <!--end row-->
                                   

                                        <a href="" class="btn btn-danger btn-label waves-effect waves-light">
                                            <i class="ri-delete-bin-5-line label-icon align-middle fs-16 me-2"></i> Cancel</a>

                                        <button type="submit" class="btn btn-success btn-label waves-effect waves-light">
                                            <i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i> Success</button>
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