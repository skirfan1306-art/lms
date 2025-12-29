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
                                <h4 class="mb-sm-0">Edit Lesson</h4>
                            </div>
                        </div>
                    </div>




<form action="{{ route('admin.syllabus.lesson.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="lesson_id" value="{{ $edit->id }}" required>
    <input type="hidden" name="course_id" value="{{ $edit->course_id }}">
    <input type="hidden" name="selected_type" id="selected_type" value="{{ $edit->file_type }}">

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="project-title-input">Lesson Name</label>
                        <input type="text" class="form-control" id="project-title-input" placeholder="Enter Lesson Name" name="name" value="{{ old('name', $edit->name) }}" required>
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
                                    <input class="form-check-input" type="radio" name="video_type" id="type1" value="youtube" {{ $edit->video_type == 'youtube' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="type1"> Youtube </label>
                                </div>
                                <div class="form-check form-radio-dark">
                                    <input class="form-check-input" type="radio" name="video_type" id="type2" value="google" {{ $edit->video_type == 'google' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="type2"> Google Docs </label>
                                </div>
                                </div>
                                
                                <div>
                                    <label class="form-label">Video Link</label>
                                    <textarea class="form-control" placeholder="Enter Full Video URL" rows="3" name="video_link">{{ $edit->file_type == 'video' ? $edit->file_name : '' }}</textarea>
                                    <div class="invalid-feedback">Please enter Video Link</div>
                                </div>
                                
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="steparrow-description-info" role="tabpanel" aria-labelledby="steparrow-description-info-tab">
                                <div>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Upload File</label>
                                        <input class="form-control" type="file" id="formFile" name="lesson_file">
                                    </div>
                                    
                                    @if($edit->file_type == 'file')
                                        <p class="mt-2">Current File: <a target="_blank" class="text-info" href="{{ asset('assets/media/' . $edit->file_name) }}">{{ asset('assets/media/' . $edit->file_name) }}</a></p>
                                    @endif
                                    
                                </div>
                            </div>
                            
                            
                            
    <div class="tab-pane fade" id="pills-experience" role="tabpanel" aria-labelledby="pills-experience-tab">

        <div>
            <label class="form-label">Question</label>
            <input class="form-control" type="text" name="question" id="question" value="{{ old('question', $edit->question) }}">
            <span class="text-danger error-text question_error"></span>
        </div>

        <div class="row mt-3">
            <label class="form-label">Checked the correct option</label>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-text p-0">
                        <input class="form-check-input mt-0 ms-2 me-2" type="radio" value="A" name="answer" {{ old('answer', $edit->answer) == 'A' ? 'checked' : '' }}>
                        <button class="btn btn-success" type="button">A</button>
                    </div>
                    <input type="text" class="form-control" name="option_a" id="option_a" value="{{ old('option_a', $edit->option_a) }}">
                </div>
                <span class="text-danger error-text option_a_error"></span>
            </div>

            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-text p-0">
                        <input class="form-check-input mt-0 ms-2 me-2" type="radio" value="B" name="answer" {{ old('answer', $edit->answer) == 'B' ? 'checked' : '' }}>
                        <button class="btn btn-success" type="button">B</button>
                    </div>
                    <input type="text" class="form-control" name="option_b" id="option_b" value="{{ old('option_b', $edit->option_b) }}">
                </div>
                <span class="text-danger error-text option_b_error"></span>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-text p-0">
                        <input class="form-check-input mt-0 ms-2 me-2" type="radio" value="C" name="answer" {{ old('answer', $edit->answer) == 'C' ? 'checked' : '' }}>
                        <button class="btn btn-success" type="button">C</button>
                    </div>
                    <input type="text" class="form-control" name="option_c" id="option_c" value="{{ old('option_c', $edit->option_c) }}">
                </div>
                <span class="text-danger error-text option_c_error"></span>
            </div>

            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-text p-0">
                        <input class="form-check-input mt-0 ms-2 me-2" type="radio" value="D" name="answer" {{ old('answer', $edit->answer) == 'D' ? 'checked' : '' }}>
                        <button class="btn btn-success" type="button">D</button>
                    </div>
                    <input type="text" class="form-control" name="option_d" id="option_d" value="{{ old('option_d', $edit->option_d) }}">
                </div>
                <span class="text-danger error-text option_d_error"></span>
            </div>
        </div>

        <div class="mt-3">
            <label class="form-label">Solution</label>
            <textarea class="form-control" name="solution" id="solution" rows="3">{{ old('solution', $edit->solution) }}</textarea>
            <span class="text-danger error-text solution_error"></span>
        </div>
        
        <div id="errorBox" class="mt-3"></div>
        
        <div class="text-end mt-4">
            <a href="" class="btn btn-danger w-sm">Cancel</a>
            <button type="button" class="btn btn-success w-sm" id="mcqSubmitBtn">Add MCQ</button>
        </div>

    </div>



                        </div>
                        <!-- end tab content -->
                </div>
                                
            </div>
            
            @if($edit->file_type == 'mcq')
            <!-- ******* All MCQ ******* -->
            <div class="card" id="allMcqSec">
                <div class="card-header">
                    <h5 class="card-title mb-0">All MCQS</h5>
                </div>
                <div class="card-body">
                @foreach($mcqs as $mcq)
                    <div class="card-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="fw-bold mb-2">{{ $loop->iteration }}. {{ $mcq->question }}</p>
                            
                            <div>
                                <a href="{{ route('admin.mcq.edit', $mcq->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <button type="button" data-id="{{ $mcq->id }}" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" class="btn btn-sm btn-danger deleteMcq">Delete</button>
                            </div>
                        </div>
                
                        <div class="row g-2">
                            @foreach(['A','B','C','D'] as $opt)
                                <div class="col-md-6">
                                    <div class="option-item">
                                        {{ $opt }}) {{ $mcq->{'option_'.strtolower($opt)} }}
                                        @if($mcq->answer == $opt)
                                            <span class="badge bg-success">✔ Correct</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                
                      <!-- Explanation -->
                      <div class="accordion mt-2" id="explanation1">
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed p-2 ps-3" type="button" data-bs-toggle="collapse"
                              data-bs-target="#exp{{ $loop->iteration }}">
                              Explanation
                            </button>
                          </h2>
                          <div id="exp{{ $loop->iteration }}" class="accordion-collapse collapse">
                            <div class="accordion-body ps-3 p-2">{{ $mcq->solution ?? 'N/A' }}</div>
                          </div>
                        </div>
                      </div>
                
                    </div>
                    <hr>
                @endforeach
                </div>
            </div>
            @endif
            
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
                            <option value="1" {{ old('status', $edit->status ?? null) == "1" ? 'selected' : '' }}>Publish</option>
                            <option value="0" {{ old('status', $edit->status ?? null) == "0" ? 'selected' : '' }}>Draft</option>
                        </select>
                        @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="text-end mt-4 mb-5">
                <a href="{{ route('admin.syllabus.lesson', $syllabus->id) }}" class="btn btn-dark w-sm">Back</a>
                <a href="" class="btn btn-danger w-sm">Cancel</a>
                <button type="submit" class="btn btn-success w-sm">Update</button>
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


            <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mt-2 text-center">
                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                    <h4>Are you Sure ?</h4>
                                    <p class="text-muted mx-4 mb-0">Are you Sure You want to Delete this MCQ ?</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('admin.mcq.delete') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" id="deleteId" value="">
                                    <button class="btn w-sm btn-danger " id="delete-record">Yes, Delete It!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
@section('scripts')

<script src="{{ asset('assets/admin/js/pages/project-create.init.js') }}"></script>
<script>
document.addEventListener('click', function (e) {
    var btn = e.target.closest('.deleteMcq');
    if (!btn) return;
    var id = btn.getAttribute('data-id') || '';
    var hidden = document.getElementById('deleteId');
    if (hidden) {
        hidden.value = id;
    }
});

$(document).ready(function () {

    let type = "{{ $edit->file_type }}";
    $("#selected_type").val(type);

    if (type === "video") {
        $("#steparrow-gen-info-tab").click();
    } else if (type === "mcq") {
        $("#pills-experience-tab").click();
    } else {
        $("#steparrow-description-info-tab").click();
    }

    function checkSelectedType() {
        let type = $("#selected_type").val();
        if (type === "mcq") {
            $("#allMcqSec").show();
        } else {
            $("#allMcqSec").hide();
        }
    }

    checkSelectedType();

    $("#steparrow-gen-info-tab").on("click", function () {
        $("#selected_type").val("video");
        checkSelectedType();
    });

    $("#steparrow-description-info-tab").on("click", function () {
        $("#selected_type").val("file");
        checkSelectedType();
    });

    $("#pills-experience-tab").on("click", function () {
        $("#selected_type").val("mcq");
        checkSelectedType();
    });

});



$('#mcqSubmitBtn').click(function () {

    let formData = {
        lesson_id: $('#lesson_id').val(),
        question: $('#question').val(),
        option_a: $('#option_a').val(),
        option_b: $('#option_b').val(),
        option_c: $('#option_c').val(),
        option_d: $('#option_d').val(),
        answer: $("input[name='answer']:checked").val(),
        solution: $('#solution').val(),
        _token: "{{ csrf_token() }}"
    };

    $.ajax({
        url: "{{ route('admin.mcq.store') }}",
        type: "POST",
        data: formData,
        success: function(res) {
            
            $('#errorBox').html(`
                <div class='alert alert-success'>${res.msg}</div>
            `);
            setTimeout(function() {
                location.reload();
            }, 1000);
        },
        error: function(err) {
            let errors = err.responseJSON.errors;
            let html = `<div class='alert alert-danger'><ul>`;
            $.each(errors, function(key, value) {
                html += `<li>${value}</li>`;
            });
            html += `</ul></div>`;
            $('#errorBox').html(html);
        }
    });

});

</script>

@endsection