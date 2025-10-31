@extends('admin.layout.app')

@section('main.content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Manage Admin</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#addAdmin"><i class="ri-add-line align-bottom me-1"></i> Add</button>
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
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort" data-sort="id">#</th>
                                                <th class="sort" data-sort="name">Name</th>
                                                <th class="sort" data-sort="email">Email</th>
                                                <th class="sort" data-sort="email">Role</th>
                                                <th class="sort" data-sort="status">Status</th>
                                                <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                        </thead>


                                        <tbody class="list form-check-all">
                                            @foreach($admins as $key => $a)
                                            <tr>

                                                <td class="id">
                                                    <a href="javascript:void(0);" class="fw-medium link-primary">{{ $loop->iteration }}</a>
                                                </td>
                                                <td class="name">{{ $a['name'] }}</td>
                                                <td class="email">{{ $a['email'] }}</td>
                                                <td class="email">{{ $a['role'] }}</td>
                                                <td>
                                                    @if($a['status'] == '1')
                                                        <label for="updateStatus-{{ $a['id'] }}" class="badge bg-success-subtle text-success text-uppercase status cursor-pointer">Active</label>
                                                    @elseif($a['status'] == '0')
                                                        <label for="updateStatus-{{ $a['id'] }}" class="badge bg-danger-subtle text-danger text-uppercase status cursor-pointer">Inactive</label>
                                                    @else
                                                        <label for="updateStatus-{{ $a['id'] }}" class="badge bg-warning-subtle text-warning text-uppercase status cursor-pointer">Pending</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <form action="{{ route('admin.admins.status') }}" method="POST" class="d-none">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $a['id'] }}">
                                                            <input type="submit" id="updateStatus-{{ $a['id'] }}">
                                                        </form>
                                                        <div class="edit">
                                                            <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal"
                                                            data-id="{{ $a['id'] }}"
                                                            data-name="{{ $a['name'] }}"
                                                            data-email="{{ $a['email'] }}"
                                                            data-role="{{ $a['role'] }}"
                                                            data-bs-target="#editAdmin">Edit</button>
                                                        </div>
                                                        @if ($a['role'] != 'superadmin')
                                                        <div class="remove">
                                                            <button class="btn btn-sm btn-danger remove-item-btn" data-id="{{ $a['id'] }}" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Remove</button>
                                                        </div>                                                            
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                    <div class="noresult" style="display: none">
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

            <div class="modal fade" id="addAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
                        <form class="tablelist-form" action="{{ route('admin.admins.add') }}" method="POST">
                            @csrf
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="email-field" class="form-label">Email</label>
                                    <input type="email" id="email-field" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Email" required />
                                    <div class="invalid-feedback">Please enter an email.</div>
                                </div>                                

                                <div>
                                    <label for="status-field" class="form-label">Role</label>
                                    <select class="form-control" data-trigger name="role" id="status-field" required>
                                        <option value="admin">Admin</option>
                                        <option value="superadmin">Superadmin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="add-btn">Add Admin</button>
                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
                        <form class="tablelist-form" action="{{ route('admin.admins.update') }}" method="POST">
                            @csrf
                            <div class="modal-body">                               
                                <input type="hidden" name="id" id="edit_id">
                                <div class="mb-3">
                                    <label for="edit_name" class="form-label">Name</label>
                                    <input type="text" id="edit_name" name="name" class="form-control" placeholder="Enter Name" required />
                                </div>

                                <div class="mb-3">
                                    <label for="edit_email" class="form-label">Email</label>
                                    <input type="email" id="edit_email" name="email" class="form-control" placeholder="Enter Email" required />
                                </div>                                

                                <div>
                                    <label for="edit_role" class="form-label">Role</label>
                                    <select class="form-control" data-trigger name="role" id="edit_role" required>
                                        <option value="admin">Admin</option>
                                        <option value="superadmin">Superadmin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="update-btn">Update Admin</button>
                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
                                    <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Admin ?</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('admin.admins.delete') }}" method="POST">
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

    @include('admin.layout.footer')
</div>
@endsection
@section('scripts')
<script>
document.addEventListener("click", function (e) {
    if (e.target.classList.contains("edit-item-btn")) {
        let id = e.target.getAttribute("data-id");
        let name = e.target.getAttribute("data-name");
        let email = e.target.getAttribute("data-email");
        let role = e.target.getAttribute("data-role");

        document.getElementById("edit_id").value = id;
        document.getElementById("edit_name").value = name;
        document.getElementById("edit_email").value = email;
        document.getElementById("edit_role").value = role;
    }
});

document.addEventListener("click", function (e) {
    if (e.target.classList.contains("remove-item-btn")) {
        let deleteId = e.target.getAttribute("data-id");
        document.getElementById("deleteId").value = deleteId;
    }
});
</script>

@endsection