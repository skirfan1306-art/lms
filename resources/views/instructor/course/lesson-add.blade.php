@extends('admin.layout.app')

@section('main.content')
<style>
    .step-arrow-nav .nav .nav-link.active::before{display:none;}
</style>
<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Create New Lesson for - {{ $syllabus->name }}</h4>
                            </div>
                        </div>
                    </div>




<form action="{{ route('admin.syllabus.lesson.create') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="course_id" value="{{ $course->id }}" required>
    <input type="hidden" name="syllabus_id" value="{{ $syllabus->id }}" required>
    <input type="hidden" name="selected_type" id="selected_type" value="video">

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="project-title-input">Lesson Name</label>
                        <input type="text" class="form-control" id="project-title-input" placeholder="Enter Lesson Name" name="name" value="{{ old('name') }}" required>
                        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
                
                <div class="card-header">
                    <h5 class="card-title mb-0">Select One</h5>
                </div>
                <div class="card-body">
                                        
                                        <div class="step-arrow-nav mb-4">

                                            <ul class="nav nav-pills custom-nav nav-justified" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="steparrow-gen-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-gen-info" type="button" role="tab" aria-controls="steparrow-gen-info" aria-selected="true" data-position="0">Video</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="steparrow-description-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-description-info" type="button" role="tab" aria-controls="steparrow-description-info" aria-selected="false" data-position="1" tabindex="-1">PDF/DOC/File</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill" data-bs-target="#pills-experience" type="button" role="tab" aria-controls="pills-experience" aria-selected="false" data-position="2" tabindex="-1">MCQ</button>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="steparrow-gen-info" role="tabpanel" aria-labelledby="steparrow-gen-info-tab">
                                                
                                                <div class="d-flex mb-3" style="font-size:16px">
                                                <div class="form-check form-radio-dark pe-5">
                                                    <input class="form-check-input" type="radio" name="video_type" id="type1" checked="" value="1">
                                                    <label class="form-check-label" for="type1"> Youtube </label>
                                                </div>
                                                <div class="form-check form-radio-dark">
                                                    <input class="form-check-input" type="radio" name="video_type" id="type2" value="2">
                                                    <label class="form-check-label" for="type2"> Google Docs </label>
                                                </div>
                                                </div>
                                                
                                                <div>
                                                    <label class="form-label">Video Link</label>
                                                    <textarea class="form-control" placeholder="Enter Full Video URL" rows="3" name="video_link">{{ old('video_link') }}</textarea>
                                                </div>
                                                
                                            </div>

                                            <div class="tab-pane fade" id="steparrow-description-info" role="tabpanel" aria-labelledby="steparrow-description-info-tab">
                                                <div>
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Upload Image</label>
                                                        <input class="form-control" type="file" id="formFile" name="lesson_file">
                                                    </div>
                                                    
                                                </div>
                                            </div>


    <div class="tab-pane fade" id="pills-experience" role="tabpanel" aria-labelledby="pills-experience-tab">

        <div>
            <label class="form-label">Question</label>
            <input class="form-control" type="text" name="question" value="{{ old('question') }}">
            <span class="text-danger error-text question_error"></span>
        </div>

        <div class="row mt-3">
            <label class="form-label">Checked the correct option</label>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-text p-0">
                        <input class="form-check-input mt-0 ms-2 me-2" type="radio" value="A" name="answer" {{ old('answer') == 'A' ? 'checked' : '' }}>
                        <button class="btn btn-success" type="button">A</button>
                    </div>
                    <input type="text" class="form-control" name="option_a" value="{{ old('option_a') }}">
                </div>
                <span class="text-danger error-text option_a_error"></span>
            </div>

            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-text p-0">
                        <input class="form-check-input mt-0 ms-2 me-2" type="radio" value="B" name="answer" {{ old('answer') == 'B' ? 'checked' : '' }}>
                        <button class="btn btn-success" type="button">B</button>
                    </div>
                    <input type="text" class="form-control" name="option_b" value="{{ old('option_b') }}">
                </div>
                <span class="text-danger error-text option_b_error"></span>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-text p-0">
                        <input class="form-check-input mt-0 ms-2 me-2" type="radio" value="C" name="answer" {{ old('answer') == 'C' ? 'checked' : '' }}>
                        <button class="btn btn-success" type="button">C</button>
                    </div>
                    <input type="text" class="form-control" name="option_c" value="{{ old('option_c') }}">
                </div>
                <span class="text-danger error-text option_c_error"></span>
            </div>

            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-text p-0">
                        <input class="form-check-input mt-0 ms-2 me-2" type="radio" value="D" name="answer" {{ old('answer') == 'D' ? 'checked' : '' }}>
                        <button class="btn btn-success" type="button">D</button>
                    </div>
                    <input type="text" class="form-control" name="option_d" value="{{ old('option_d') }}">
                </div>
                <span class="text-danger error-text option_d_error"></span>
            </div>
        </div>

        <div class="mt-3">
            <label class="form-label">Solution</label>
            <textarea class="form-control" name="solution" rows="3">{{ old('solution') }}</textarea>
            <span class="text-danger error-text solution_error"></span>
        </div>

    </div>


                                        </div>
                                        <!-- end tab content -->
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

            <div class="text-end mt-4 mb-5">
                <a href="{{ route('admin.syllabus.lesson', $syllabus->id) }}" class="btn btn-dark w-sm">Back</a>
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

            @include('admin.layout.footer')
        </div>

@endsection
@section('scripts')

<script src="{{ asset('assets/admin/js/pages/project-create.init.js') }}"></script>
<script src="{{ asset('assets/admin/js/pages/form-wizard.init.js') }}"></script>
<script>

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("selected_type").value = "video";
    document.getElementById("steparrow-gen-info-tab")
        .addEventListener("click", function () {
            document.getElementById("selected_type").value = "video";
        });
    document.getElementById("steparrow-description-info-tab")
        .addEventListener("click", function () {
            document.getElementById("selected_type").value = "file";
        });
    document.getElementById("pills-experience-tab")
        .addEventListener("click", function () {
            document.getElementById("selected_type").value = "mcq";
        });
});
</script>

@endsection