@extends('instructor.layout.app')

@section('main.content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">{{ $name ?? 'All' }} {{ $courses->count() }} Courses</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <a href="{{ route('instructor.course.add') }}" class="btn btn-info"><i class="ri-add-line align-bottom me-1"></i> Create New Course</a>
                                    </div>
                                    @if($name != 'All')
                                    <div class="col-sm-auto">
                                        <a class="btn btn-info" href="{{ route('instructor.courses') }}"><i class="ri-eye-line align-bottom me-1"></i> Show All</a>
                                    </div>
                                    @endif
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control search" placeholder="Search...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive table-card mt-3 mb-1">
                                    


<table class="table align-middle table-nowrap" id="medicineTable">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>Image</th>
            <th data-sort="name">Name</th>
            <th data-sort="five">Instructor</th>
            <th data-sort="one">Category</th>
            <th data-sort="four">Subcategory</th>
            <th data-sort="two">Tag</th>
            <th data-sort="three">Price</th>
            <th data-sort="status">Status</th>
            <th>Manage Syllabus</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="list form-check-all">
        @foreach($courses as $data)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                <img src="{{ asset('assets/front/images/course/' . $data['image']) }}" alt="{{ $data['name'] }}" class="rounded" style="height:70px">
            </td>
            <td class="name"><a href="{{ route('instructor.course.view', $data['id']) }}">{{ Str::limit($data['name'], 80) }}</a></td>
            <td class="five">{!! optional($data->instructor)->name ?? '<span class="text-danger">Undefined</span>' !!}</td>

            <td class="one">{{ $data['category']['name'] ?? 'Undefined' }}</td>
            <td class="four">{{ $data['subcategory']['name'] }}</td>
            <td class="two">{{ $data['tag'] }}</td>
            <td>@if($data->price == 'free')
                <b class="btn btn-sm btn-info three">Free</b><br>
                @else
                <s class="three">{{ $data['old_price'] }}</s><br>
                <b class="three">{{ $data['sale_price'] }}</b>
                @endif
            </td>
            <td>
                @if($data['status'] == '1')
                    <span class="badge bg-info-subtle text-info status">Active</span>
                @else
                    <span class="badge bg-danger-subtle text-danger status">Inactive</span>
                @endif
            </td>
            <td>
                <a href="{{ route('instructor.course.syllabus', $data['id']) }}" class="btn btn-sm btn-info"><b>{{ $data->syllabus_count }}</b> Syllabus <i class="bx bx-cog"></i></a>
            </td>
            <td>
                <div class="d-flex gap-2">
                    
                    <a href="{{ route('instructor.course.view', $data['id']) }}" class="btn btn-sm btn-info"> <i class="bx bx-show"></i> </a>
                @if($data['instructor_id'] == auth()->id())
                    <a href="{{ route('instructor.course.edit', $data['id']) }}" class="btn btn-sm btn-info"> <i class="bx bx-pen"></i> </a>
                    
                    <button class="btn btn-sm btn-danger remove-item-btn"
                            data-id="{{ $data['id'] }}"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteRecordModal">
                        <i class="bx bx-trash"></i>
                    </button>
                @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if($courses->isEmpty())
<div class="noresult">
    <div class="text-center">
        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
        <h5 class="mt-2">Sorry! No Result Found</h5>
    </div>
</div>
@endif
                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">

                                        <ul class="pagination listjs-pagination mb-0"></ul>

                                    </div>
                                </div>
                            </div>
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end col -->
            </div>


            <!-- Modal -->
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
                                    <p class="text-muted mx-4 mb-0">Are you Sure You want to Delete this Course ?</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('instructor.course.delete') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" id="deleteId" value="">
                                    <button class="btn w-sm btn-danger " id="delete-record">Yes, Delete It!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end modal -->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include('instructor.layout.footer')
</div>
@endsection
@section('scripts')
<script>
document.addEventListener('click', function (e) {
    var btn = e.target.closest('.remove-item-btn');
    if (!btn) return;
    var id = btn.getAttribute('data-id') || '';
    document.getElementById('deleteId').value = id;

});
</script>
@endsection