@extends('admin.layout.app')

@section('main.content')

<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Edit Product &nbsp;&nbsp;&nbsp; <b>SKU: {{ $edit->sku }}</b></h4>
                            </div>
                        </div>
                    </div>




<form action="{{ route('admin.product.update', $edit->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    {{-- Product Name --}}
                    <div class="mb-3">
                        <label class="form-label" for="project-title-input">Product Name</label>
                        <input type="text" class="form-control" id="project-title-input"
                               placeholder="Enter Product Name" name="name"
                               value="{{ old('name', $edit->name) }}">
                        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label">Product Description</label>
                        <textarea id="summernote" name="description">{{ old('description', $edit->description) }}</textarea>
                        @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mt-3">
                            <label for="pack" class="form-label">Pack Size</label>
                            <input type="text" class="form-control" id="pack"
                                   placeholder="10 Products Per Pack / 100 ML / 10 Capsule Per Pack" name="pack_size"
                                   value="{{ old('pack_size', $edit->pack_size) }}">
                            @error('pack_size') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-lg-6 mt-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="text" class="form-control" id="quantity"
                                   placeholder="500" name="quantity"
                                   value="{{ old('quantity', $edit->quantity) }}">
                            @error('quantity') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Gallery Images --}}
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Attached More Images</h5>
    </div>
    <div class="card-body">
        <div id="existingGallery" class="d-flex flex-wrap gap-2 mb-3">
            @php 
                $gallery = $edit->images ? json_decode($edit->images, true) : [];
            @endphp
            @foreach($gallery as $img)
                <div class="position-relative d-inline-block existing-image">
                    <img src="{{ asset('assets/front/images/products/'.$img) }}" 
                         class="rounded border" 
                         style="width:120px; height:120px; object-fit:cover;">
                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 remove-existing" data-img="{{ $img }}">&times;</button>
                </div>
            @endforeach
        </div>

        {{-- Hidden input to send deleted old images --}}
        <input type="hidden" name="delete_images" id="deleteImages">

        {{-- Input for adding new images --}}
        <input type="file" id="imageInput" class="form-control" name="images[]" accept="image/*" multiple>

        <div id="galleryPreview" class="d-flex flex-wrap gap-2 mt-3"></div>

        @error('images.*')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>




{{-- Specifications --}}
<div class="card">
    <div class="card-body">
        <div id="specifications">
            @php
                $specs = $edit->specifications ? json_decode($edit->specifications, true) : [];
            @endphp

            @if(!empty($specs))
                @foreach($specs as $index => $spec)
                    <div class="row mb-3 spec-row">
                        <div class="col-lg-5">
                            <input type="text" name="specification[]" class="form-control"
                                   placeholder="Specification" value="{{ $spec['specification'] }}">
                        </div>
                        <div class="col-lg-5">
                            <input type="text" name="value[]" class="form-control"
                                   placeholder="Value" value="{{ $spec['value'] }}">
                        </div>
                        <div class="col-lg-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger" onclick="this.closest('.spec-row').remove()">Delete</button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row mb-3 spec-row">
                    <div class="col-lg-5">
                        <input type="text" name="specification[]" class="form-control" placeholder="Specification">
                    </div>
                    <div class="col-lg-5">
                        <input type="text" name="value[]" class="form-control" placeholder="Value">
                    </div>
                    <div class="col-lg-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger" onclick="this.closest('.spec-row').remove()">Delete</button>
                    </div>
                </div>
            @endif
        </div>

        <div class="d-flex align-items-end mb-3">
            <button type="button" class="btn btn-success" onclick="addRow()">Add</button>
        </div>

        <div class="mt-3">
            <label class="form-label">Delivery & Return Policy</label>
            <textarea id="summernote2" name="policy">{{ old('policy', $edit->policy) }}</textarea>
            @error('policy') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

        </div>

        {{-- Right Side --}}
        <div class="col-lg-4">
            {{-- Thumbnail --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Category, Prices & More</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="project-thumbnail-img">Thumbnail Image</label><br>
                        <label class="form-label cursor-pointer" for="project-thumbnail-img">
                            <img src="{{ asset('assets/front/images/products/'.$edit->thumbnail) }}" style="max-height:250px;height:auto;width:100%"
                                 id="viewImage">
                        </label>
                        <input class="form-control d-none" id="project-thumbnail-img" type="file"
                               accept="image/png, image/gif, image/jpeg" name="thumbnail"
                               onchange="document.querySelector('#viewImage').src = window.URL.createObjectURL(this.files[0]);">
                        @error('thumbnail') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- Category --}}
                    <label class="form-label">Category</label>
                    <select class="form-select" name="category_id">
                        <option disabled selected>Select a Category</option>
                        @foreach($category as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $edit->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror

                    {{-- Brand --}}
                    <div class="mt-3">
                        <label class="form-label">Brand</label>
                        <select class="form-select" name="brand_id">
                            <option disabled selected>Select a Brand</option>
                            @foreach($brand as $br)
                                <option value="{{ $br->id }}" {{ old('brand_id', $edit->brand_id) == $br->id ? 'selected' : '' }}>
                                    {{ $br->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- Format --}}
                    <div class="mt-3">
                        <label class="form-label">Format</label>
                        <select class="form-select" name="format">
                            <option disabled selected>Select a Format</option>
                            @foreach($category as $cat)
                                <option value="{{ $cat->id }}" {{ old('format') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Product --}}
                    <div class="mt-3">
                        <label class="form-label">Product</label>
                        <select class="form-select" name="product">
                            <option disabled selected>Select a Product</option>
                            @foreach($category as $cat)
                                <option value="{{ $cat->id }}" {{ old('product') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Prices --}}
                    <div class="mt-3 row">
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

            {{-- Tags --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tags</h5>
                </div>
                <div class="card-body">
                    <label class="form-label">Tag</label>
                    <input class="form-control" id="choices-text-input" data-choices
                           placeholder="e.g. Pain Relief, Antihistamine, Supplements" type="text"
                           name="tag" value="{{  old('tag', $edit->tag) }}">
                    @error('tag') <div class="text-danger">{{ $message }}</div> @enderror

                    <div class="mt-2">
                        <label class="form-label">Search Keyword</label>
                        <input class="form-control" placeholder="e.g. P-650, Bandaid, Supplements, Pan 40, fever"
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
            
            <div class="form-check form-check-outline form-check-dark mt-3">
                <input class="form-check-input" type="checkbox" id="formCheck19" name="make_webp">
                <label class="form-check-label" for="formCheck19">Convert all images to WEBP format and reduce their size by 80%.</label>
            </div>

            <div class="text-end mt-4 mb-5">
                <a href="javascript:void(0)" onclick="history.back()" class="btn btn-dark w-sm">Back</a>
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
      height: 200
    });
    $('#summernote2').summernote({
      placeholder: 'Write policy here...',
      tabsize: 2,
      height: 200
    });
  });
</script>

<script>
function addRow() {
  const container = document.getElementById("specifications");
  const row = document.createElement("div");
  row.className = "row mb-3 spec-row";
  row.innerHTML = `
    <div class="col-lg-5">
      <input type="text" name="specification[]" class="form-control" placeholder="Specification">
    </div>
    <div class="col-lg-5">
      <input type="text" name="value[]" class="form-control" placeholder="Value">
    </div>
    <div class="col-lg-2 d-flex align-items-end">
      <button type="button" class="btn btn-danger" onclick="this.closest('.spec-row').remove()">Delete</button>
    </div>`;
  container.appendChild(row);
}
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
@endsection