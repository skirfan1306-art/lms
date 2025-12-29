@extends('instructor.layout.app')

@section('main.content')
<style>
tr.dragging {
    background: #e8ffe8 !important;   /* light green */
    transition: background 0.2s ease;
}

tr.dragging td {
    opacity: 0.8;
}
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-2">Course Name - {{ $course->name }}</h4>
                            <h4 class="card-title mb-0">All {{ $syllabus->count() }} Syllabus</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="javascript:void(0)" onclick="history.back()" class="btn btn-dark"> <i class="ri-arrow-left-line"></i> Go Back</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="{{ route('instructor.course.syllabus.add', $course['id']) }}" class="btn btn-info"><i class="ri-add-line align-bottom me-1"></i> Create New Syllabus</a>
                                        </div>
                                    </div>
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
<table class="table align-middle table-nowrap">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th data-sort="name">Name</th>
            <th data-sort="two">Slug</th>
            <th data-sort="status">Status</th>
            <th>Manage Lesson</th>
            <th>Last Update</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="list form-check-all" id="syllabusSortable">
        @foreach($syllabus as $data)
        <tr class="handle" data-id="{{ $data['id'] }}">
            
            <td class="drag-handle" draggable="true" style="cursor:move">
              <i class="bx bx-expand-vertical"></i> {{ $loop->iteration }}
            </td>
            
            <td class="name">{{ $data['name'] }}</td>
            <td class="two">{{ $data['slug'] }}</td>
           
            <td>
                @if($data['status'] == '1')
                    <span class="badge bg-info-subtle text-info status">Active</span>
                @else
                    <span class="badge bg-danger-subtle text-danger status">Inactive</span>
                @endif
            </td>
            <td>
                <a href="{{ route('instructor.syllabus.lesson', $data['id']) }}" class="btn btn-sm btn-info">{{ $data->lesson_count }} Lesson <i class="bx bx-cog"></i></a>
            </td>
            <td>{{ $data['updated_at'] }}</td>
            <td>
                <div class="d-flex gap-2">
                    
                    <a href="{{ route('instructor.course.syllabus.edit', $data['id']) }}" class="btn btn-sm btn-info"> <i class="bx bx-pen"></i> </a>
                    
                    <button class="btn btn-sm btn-danger remove-item-btn"
                            data-id="{{ $data['id'] }}"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteRecordModal">
                        <i class="bx bx-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if($syllabus->isEmpty())
<div class="noresult">
    <div class="text-center">
        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
        <h5 class="mt-2">Sorry! No Result Found</h5>
    </div>
</div>
@endif
<div class="noresult" style="display:none">
    <div class="text-center">
        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
        <h5 class="mt-2">Sorry! No Result Found</h5>
    </div>
</div>
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
                                    <p class="text-muted mx-4 mb-0">Are you Sure You want to Delete this Syllabus ?</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('instructor.course.syllabus.delete') }}" method="POST">
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
    var hidden = document.getElementById('deleteId');
    if (hidden) {
        hidden.value = id;
    }
});

// --- DRAG HANDLE ONLY (draggable on the handle td only) ---
document.addEventListener('DOMContentLoaded', function () {
    var tbody = document.getElementById('syllabusSortable');
    if (!tbody) return;

    var draggingRow = null;

    tbody.addEventListener('dragstart', function (e) {
        var handle = e.target.closest('.drag-handle');
        if (!handle) {
            e.preventDefault();
            return;
        }

        var row = handle.closest('tr');
        if (!row) {
            e.preventDefault();
            return;
        }

        draggingRow = row;
        row.classList.add('dragging');
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/plain', row.getAttribute('data-id') || '');
    });

    tbody.addEventListener('dragend', function () {
        if (draggingRow) {
            draggingRow.classList.remove('dragging');
            draggingRow = null;
        }
    });

    tbody.addEventListener('dragover', function (e) {
        if (!draggingRow) return;
        e.preventDefault(); // allow drop

        var targetRow = e.target.closest('tr');
        if (!targetRow || targetRow === draggingRow) return;

        var rect = targetRow.getBoundingClientRect();
        var offset = e.clientY - rect.top;

        if (offset < rect.height / 2) {
            if (targetRow.previousSibling !== draggingRow) {
                tbody.insertBefore(draggingRow, targetRow);
            }
        } else {
            if (targetRow.nextSibling !== draggingRow) {
                tbody.insertBefore(draggingRow, targetRow.nextSibling);
            }
        }
    });

    tbody.addEventListener('drop', function (e) {
        e.preventDefault();
        saveNewOrder(tbody);
    });

    function saveNewOrder(tbody) {
        var order = [];
        tbody.querySelectorAll('tr').forEach(function (row) {
            var id = row.getAttribute('data-id');
            if (id) order.push(id);
        });

        if (!order.length) return;

        fetch("{{ route('instructor.course.syllabus.sort') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ order: order })
        })
        .then(function (res) { return res.json(); })
        .then(function (data) {
            showAlert('success', 'Sequence updated successfully!');
        })
        .catch(function (err) {
            console.error('Sort save error:', err);
        });
    }
});
</script>
@endsection
