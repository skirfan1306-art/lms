@extends('admin.layout.app')

@section('main.content')

<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Create New Blog</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <form action="{{ route('admin.blog.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mt-2 mb-3">
                                        <img src="{{ asset('assets/admin/images/small/img-4.jpg') }}" id="viewthumbnail" style="max-height:120px; width:auto; height:auto">
                                    </div>
                                    <div class="mb-3 row">
                                    <div class="col-lg-6">
                                        <label for="choices-text-input" class="form-label">Thumbnail Image</label>
                                        <input class="form-control" type="file" accept="image/*" required name="image"
                                         onchange="document.querySelector('#viewthumbnail').src = window.URL.createObjectURL(this.files[0]);" >
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <label class="form-label" for="alt">Image Alt</label>
                                        <input type="text" class="form-control" id="alt" placeholder="Enter image alt" name="alt" required value="{{ old('alt') }}">
                                    </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label" for="project-title-input">Blog Title</label>
                                        <input type="text" class="form-control" id="project-title-input" placeholder="Enter blog title" name="title" required value="{{ old('title') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Blog Description</label>
                                        <textarea id="summernote" name="description" required>{{ old('description') }}</textarea>
                                    </div>

                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->


                        </div>
                        <!-- end col -->
                        <div class="col-lg-4">
                            
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Publication</h5>
                                </div>
                                <div class="card-body">
                                    
                                    <div>
                                        <label for="choices-text-input" class="form-label">Excerpt</label>
                                        <textarea class="form-control" maxlength="180" rows="5" name="excerpt" placeholder="Write a short excerpt (max 180 characters)..." required>{{ old('excerpt') }}</textarea>
                                    </div>
                                    <div class="row mt-2">
                                    <div class="col-6">
                                        <label for="choices-status-input" class="form-label" >Status</label>
                                        <select class="form-select" id="choices-status-input" name="status">
                                            <option value="1" selected>Publish</option>
                                            <option value="0">Draft</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Created at</label>
                                        <input class="form-control" type="date" name="created_at" value="{{ date('Y-m-d') }}">
                                    </div>
                                    </div>
                                    <div class="form-check form-check-outline form-check-dark mt-3">
                                        <input class="form-check-input" type="checkbox" id="formCheck19" name="make_webp">
                                        <label class="form-check-label" for="formCheck19">Convert all images to WEBP format and reduce their size by 80%.</label>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                            
                            <div class="text-end mb-4">
                                <a href="" class="btn btn-danger w-sm">Delete</a>
                                <button type="submit" class="btn btn-success w-sm">Create</button>
                            </div>

                        </div>
                        <!-- end col -->
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
      placeholder: 'Write blog description here...',
      tabsize: 2,
      height: 300
    });
  });
</script>


@endsection