@extends('admin.layout.app')

@section('main.content')

<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Edit Course</h4>
                            </div>
                        </div>
                    </div>




<form action="{{ route('admin.course.update', $edit->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label" for="project-title-input">Course Name</label>
                        <input type="text" class="form-control" id="project-title-input"
                               placeholder="Enter Course Name" name="name"
                               value="{{ old('name', $edit->name) }}">
                        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Instructor</label>
                        <select class="form-select" name="instructor_id" required>
                            <option disabled selected>Select a Instructor</option>
                            @foreach($instructor as $ins)
                                <option value="{{ $ins->id }}" {{ old('instructor_id', $edit->instructor_id) == $ins->id ? 'selected' : '' }}>
                                    {{ $ins->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label class="form-label">Category</label>
                            <select class="form-select" name="category_id" id="category_id">
                                <option disabled selected>Select a Category</option>
                                @foreach($category as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $edit->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        
                        
                        <div class="col-lg-4">
                            <label class="form-label">Subcategory</label>
                            <select class="form-select" name="subcategory_id" id="subcategory_id">
                                <option disabled selected>Select a Subcategory</option>
                                @foreach($subcategory as $sub_cat)
                                    <option value="{{ $sub_cat->id }}" 
                                        data-cat="{{ $sub_cat->category_id }}"
                                        {{ old('subcategory_id', $edit->subcategory_id) == $sub_cat->id ? 'selected' : '' }}>
                                        {{ $sub_cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subcategory_id') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
    
    
                        <div class="col-lg-4">
                            <label class="form-label">Tag</label>
                            <select class="form-select" name="tag">
                                <option disabled selected>Select a Tag</option>
                                @foreach($tags as $tag)
                                    <option {{ old('tag', $edit->tag) == $tag->name ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
<div class="mb-3">
<label class="form-label">Course Includes</label>
<textarea class="form-control" name="benefit" 
placeholder="Type each benefit on a new line, like:

Full Lifetime Access
Free Trial 7 Days
Certificate Of Completion" rows="5">{{ old('benefit', $edit->benefit) }}</textarea>

</div>
                    
                    <div class="mb-3">
                        <label class="form-label">Small Excerpt</label>
                        <textarea class="form-control" name="excerpt" placeholder="Enter small excerpt within 250 word" maxlength="250" required>{{ old('excerpt', $edit->excerpt) }}</textarea>
                        @error('excerpt') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Course Description</label>
                        <textarea id="summernote" name="description">{{ old('description', $edit->description) }}</textarea>
                        @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                
                </div>
            </div>

        </div>

        {{-- Right Side --}}
        <div class="col-lg-4">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Category, Prices & More</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="project-thumbnail-img">Thumbnail Image</label><br>
                        <label class="form-label cursor-pointer" for="project-thumbnail-img">
                            <img src="{{ $edit->image ? (filter_var($edit->image, FILTER_VALIDATE_URL) ? $edit->image : asset('assets/front/images/course/' . $edit->image)) : asset('assets/imgprev.png') }}" style="max-height:250px;height:auto;width:100%" id="viewImage">
                        </label>
                        <input class="form-control d-none" id="project-thumbnail-img" type="file" accept="image/png, image/gif, image/jpeg" name="thumbnail" onchange="document.querySelector('#viewImage').src = window.URL.createObjectURL(this.files[0]);">
                        @error('thumbnail') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                

                    <div class="mt-3 row">
                    <div class="col-12 mb-3">
                        <label class="form-label">Course Price</label>

                        <div class="d-flex mb-2">
                            <div class="form-check me-5">
                                <input class="form-check-input" type="radio" name="price" id="flexRadioDefault1"
                                       value="paid" {{ old('price', $edit->price) == 'paid' ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexRadioDefault1">Paid &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            </div>
                        
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="price" id="flexRadioDefault2"
                                       value="free" {{ old('price', $edit->price) == 'free' ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexRadioDefault2">Free &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <label for="old-input" class="form-label">Old Price</label>
                        <input type="text" class="form-control" id="old-input" placeholder="299"
                               name="old_price" value="{{ old('old_price', $edit->old_price) }}">
                        @error('old_price') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-6">
                        <label for="sale-input" class="form-label">Sale Price</label>
                        <input type="text" class="form-control" id="sale-input" placeholder="199"
                               name="sale_price" value="{{ old('sale_price', $edit->sale_price) }}">
                        @error('sale_price') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Others</h5>
                </div>
                <div class="card-body">
                    
                    <div class="mt-2">
                        <label class="form-label">Level</label>
                        <select class="form-select" name="level">
                            <option value="Beginner" {{ old('level', $edit->level) == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="Intermediate" {{ old('level', $edit->level) == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="Advanced" {{ old('level', $edit->level) == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                            <option value="Expert" {{ old('level', $edit->level) == 'Expert' ? 'selected' : '' }}>Expert</option>
                            <option value="Master" {{ old('level', $edit->level) == 'Master' ? 'selected' : '' }}>Master</option>
                            <option value="Elite" {{ old('level', $edit->level) == 'Elite' ? 'selected' : '' }}>Elite</option>
                        </select>
                    </div>

                    <div class="mt-2">
                        <label class="form-label">Duration</label>
                        <input class="form-control" placeholder="e.g. 3 Months" type="text" name="duration" value="{{  old('duration', $edit->duration) }}">
                    </div>
                    
                    <div class="mt-2">
                        <label class="form-label">Language</label>
                        <select class="form-select" name="language">
                            <option value="Hindi" {{ old('language', $edit->language) == 'Hindi' ? 'selected' : '' }}>Hindi</option>
                            <option value="English" {{ old('language', $edit->language) == 'English' ? 'selected' : '' }}>English</option>
                            <option value="Bengali" {{ old('language', $edit->language) == 'Bengali' ? 'selected' : '' }}>Bengali</option>
                            <option value="Telugu" {{ old('language', $edit->language) == 'Telugu' ? 'selected' : '' }}>Telugu</option>
                            <option value="Marathi" {{ old('language', $edit->language) == 'Marathi' ? 'selected' : '' }}>Marathi</option>
                            <option value="Tamil" {{ old('language', $edit->language) == 'Tamil' ? 'selected' : '' }}>Tamil</option>
                            <option value="Gujarati" {{ old('language', $edit->language) == 'Gujarati' ? 'selected' : '' }}>Gujarati</option>
                            <option value="Urdu" {{ old('language', $edit->language) == 'Urdu' ? 'selected' : '' }}>Urdu</option>
                            <option value="Kannada" {{ old('language', $edit->language) == 'Kannada' ? 'selected' : '' }}>Kannada</option>
                            <option value="Odia" {{ old('language', $edit->language) == 'Odia' ? 'selected' : '' }}>Odia</option>
                        </select>
                    </div>
                    
                    <div class="mt-2">
                        <label class="form-label">Search Keyword</label>
                        <input class="form-control" placeholder="e.g. Web Designing, Business Plan"
                               type="text" name="search" value="{{  old('search', $edit->search_keyword) }}">
                        @error('search') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mt-2">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="1" {{ old('status', $edit->status) == 1 ? 'selected' : '' }}>Publish</option>
                            <option value="0" {{ old('status', $edit->status) == 0 ? 'selected' : '' }}>Draft</option>
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
                <a href="{{ route('admin.courses') }}" class="btn btn-dark w-sm">Back</a>
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

@endsection
@section('scripts')

<script src="{{ asset('assets/admin/js/pages/project-create.init.js') }}"></script>
<script>
  $(document).ready(function() {
    $('#summernote').summernote({
      placeholder: 'Write product description here...',
      tabsize: 2,
      height: 300
    });
  });
</script>

<script>
    const imageInput = document.getElementById('imageInput');
    const galleryPreview = document.getElementById('galleryPreview');
    const deleteImagesInput = document.getElementById('deleteImages');

    let selectedFiles = [];
    let deletedImages = [];

    // handle new image preview
    imageInput.addEventListener('change', function (e) {
        const files = Array.from(e.target.files);

        files.forEach(file => {
            if (!selectedFiles.some(f => f.name === file.name && f.size === file.size)) {
                selectedFiles.push(file);
                previewFile(file);
            }
        });

        e.target.value = '';
        rebuildInput();
    });

    function previewFile(file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const wrapper = document.createElement('div');
            wrapper.classList.add('position-relative', 'd-inline-block');

            wrapper.innerHTML = `
                <img src="${e.target.result}" class="rounded border" style="width:120px; height:120px; object-fit:cover;">
                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1">&times;</button>
            `;

            wrapper.querySelector('button').addEventListener('click', () => {
                selectedFiles = selectedFiles.filter(f => f !== file);
                wrapper.remove();
                rebuildInput();
            });

            galleryPreview.appendChild(wrapper);
        };
        reader.readAsDataURL(file);
    }

    function rebuildInput() {
        let dt = new DataTransfer();
        selectedFiles.forEach(f => dt.items.add(f));
        imageInput.files = dt.files;
    }

    // handle existing image delete
    document.querySelectorAll('.remove-existing').forEach(btn => {
        btn.addEventListener('click', function () {
            const img = this.getAttribute('data-img');
            deletedImages.push(img);
            deleteImagesInput.value = JSON.stringify(deletedImages);
            this.parentElement.remove();
        });
    });
</script>
<script>
$(document).ready(function() {
    function filterSubcategories(reset = false) {
        var selectedCategory = $('#category_id').val();
        var selectedSubcategory = "{{ old('subcategory_id', $edit->subcategory_id) }}";

        $('#subcategory_id option').hide();

        $('#subcategory_id option[disabled]').show().prop('selected', true);

        $('#subcategory_id option[data-cat="' + selectedCategory + '"]').show();

        if (!reset && selectedSubcategory) {
            $('#subcategory_id').val(selectedSubcategory);
        }
    }

    filterSubcategories();

    $('#category_id').change(function() {
        filterSubcategories(true);
    });
});
</script>

@endsection