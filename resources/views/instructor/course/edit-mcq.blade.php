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
                                <h4 class="mb-sm-0">Edit MCQ</h4>
                            </div>
                        </div>
                    </div>




<form action="{{ route('admin.mcq.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $edit->id }}" required>

            <div class="card">

                <div class="card-body">


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
            <a href="{{ route('admin.syllabus.lesson.edit', $edit->lesson_id) }}" class="btn btn-dark w-sm">Back</a>
            <a href="" class="btn btn-danger w-sm">Cancel</a>
            <button type="submit" class="btn btn-success w-sm">Update MCQ</button>
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
<script>


</script>

@endsection