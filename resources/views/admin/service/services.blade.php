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
                                <form action="{{route('admin.addService')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="row gy-4">
                                            
                                             <div class="col-md-6">
                                                <div>
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="title" placeholder="Placeholder" name="title" value="{{old('title')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div>
                                                    <label for="link" class="form-label">Link</label>
                                                    <input type="text" class="form-control" id="link" placeholder="Placeholder" name="link" value="{{old('link')}}">
                                                </div>
                                            </div>
                                         
                        
                                           
                                            <div class="col-md-6">
                                                <div>
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea class="form-control" id="description" rows="3" name="description">{{old('description')}}</textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div>
                                                    <label for="svg" class="form-label">SVG</label>
                                                    <textarea class="form-control" id="svg" rows="3" name="svg">{{old('svg')}}</textarea>
                                                </div>
                                            </div>
                                             <div class="col-md-6">
                                                <div>
                                                    <label for="price" class="form-label">Price</label>
                                                    <input type="number" class="form-control" id="price" placeholder="Placeholder" name="price" value="{{old('price')}}">
                                                </div>
                                            </div>
                                             
                                             
                                            
                                             <div>
                                                    
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio" name="class" id="flexRadioDefault1" value="left-top" {{old('class') =='left-top' ? 'checked' : ''}}>
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Left Top Corner
                                                        </label>
                                                    </div>
                                                    <div class="form-check mb-4">
                                                        <input class="form-check-input" type="radio" name="class" id="flexRadioDefault2"  value="right-bottom" {{old('class') =='right-bottom' ? 'checked' : ''}}>
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            Right Bottom Corner
                                                        </label>
                                                    </div>
                                                </div>
                                           
                                        </div>
                                        <!--end row-->
                                   

                                        <a href="" class="btn btn-danger btn-label waves-effect waves-light">
                                            <i class="ri-delete-bin-5-line label-icon align-middle fs-16 me-2"></i> Cancel</a>

                                        <button type="submit" class="btn btn-success btn-label waves-effect waves-light">
                                            <i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i> Add</button>
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