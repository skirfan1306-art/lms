@extends('instructor.layout.app')

@section('main.content')

<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Create New Syllabus for - {{ $course->name }}</h4>
                            </div>
                        </div>
                    </div>




<form action="{{ route('instructor.course.syllabus.create') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="course_id" value="{{ $course->id }}" required>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    {{-- Course Name --}}
                    <div class="mb-3">
                        <label class="form-label" for="project-title-input">Syllabus Name</label>
                        <input type="text" class="form-control" id="project-title-input" placeholder="Enter Syllabus Name" name="name" value="{{ old('name') }}" required>
                        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Side --}}
        <div class="col-lg-4">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Others</h5>
                </div>
                <div class="card-body">

                    <div class="mt-2">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Publish</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Draft</option>
                        </select>
                        @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            
            <!--<div class="form-check form-check-outline form-check-dark mt-3">-->
            <!--    <input class="form-check-input" type="checkbox" id="formCheck19" name="make_webp">-->
            <!--    <label class="form-check-label" for="formCheck19">Convert all images to WEBP format and reduce their size by 80%.</label>-->
            <!--</div>-->

            <div class="text-end mt-4 mb-5">
                <a href="javascript:void(0)" onclick="history.back()" class="btn btn-dark w-sm">Back</a>
                <a href="" class="btn btn-danger w-sm">Cancel</a>
                <button type="submit" class="btn btn-success w-sm">Create</button>
            </div>
        </div>
    </div>
</form>



                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('instructor.layout.footer')
        </div>

@endsection
@section('scripts')

<script src="{{ asset('assets/admin/js/pages/project-create.init.js') }}"></script>
<script>
  $(document).ready(function() {
    $('#summernote').summernote({
      placeholder: 'Write product description here...',
      tabsize: 2,
      height: 200
    });

  });
</script>

@endsection