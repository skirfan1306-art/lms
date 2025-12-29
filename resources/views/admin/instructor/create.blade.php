@extends('admin.layout.app')

@section('main.content')

<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Add New Instructor</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <form action="{{ route('admin.instructor.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                        <div class="card">
                                <div class="card-body">
                                    <div class="mt-2 mb-3 row">
                                    <div class="col-lg-4">
                                        <label for="img" class="form-label m2-2">Instructor Image</label><br>
                                        <label for="img" class="form-label cursor-pointer">
                                            <img src="{{ asset('assets/imgprev.png') }}" id="viewthumbnail" style="max-height:120px; width:auto; height:auto">
                                        </label>
                                        <input class="form-control d-none" id="img" type="file" accept="image/*" name="image"
                                         onchange="document.querySelector('#viewthumbnail').src = window.URL.createObjectURL(this.files[0]);" >
                                    </div>
                                    
                                    <div class="col-lg-8">
                                        <label class="form-label" for="name">Instructor Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter instructor name" name="name" required value="{{ old('name') }}">
                                
                                        <label class="form-label mt-3" >Instructor Designation</label>
                                        <input type="text" class="form-control" placeholder="Enter instructor designation" name="designation" required value="{{ old('designation') }}">
                                    </div>
                                    
                                    <div class="col-lg-4 mt-3">
                                        <label class="form-label">Instructor Email</label>
                                        <input type="email" class="form-control" placeholder="Enter instructor email" name="email" required value="{{ old('email') }}">
                                    </div>
                                    
                                    <div class="col-lg-4 mt-3">
                                        <label class="form-label">Instructor Number</label>
                                        <input type="text" class="form-control" placeholder="Enter instructor number" name="number" required value="{{ old('number') }}">
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                        <label class="form-label">Instructor Password</label>
                                        <input type="text" class="form-control" placeholder="******" minlength="6" name="password" value="{{ old('password') }}">
                                    </div>
                                    
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Instructor Description</label>
                                        <textarea id="summernote" name="description">{{ old('description') }}</textarea>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <a href="" class="btn btn-danger w-sm">Cancel</a>
                                        <button type="submit" class="btn btn-success w-sm">Add Instructor </button>
                                    </div>

                                </div>
                                <!-- end card body -->
                            </div>


                    </form>
                    <!-- end row -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('admin.layout.footer')
        </div>

@endsection
@section('scripts')

<script src="{{ asset('assets/admin/libs/dropzone/dropzone-min.js') }}"></script>
<script src="{{ asset('assets/admin/js/pages/project-create.init.js') }}"></script>
<script>
  $(document).ready(function() {
    $('#summernote').summernote({
      placeholder: 'Write description here...',
      tabsize: 2,
      height: 300
    });
  });
</script>


@endsection