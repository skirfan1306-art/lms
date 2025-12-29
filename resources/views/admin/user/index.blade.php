@extends('admin.layout.app')

@section('main.content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">All Users</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="{{ route('admin.blog.form') }}" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i> Create New Blog</a>
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
                                                <th>Image</th>
                                                <th class="sort" data-sort="name">Name</th>
                                                <th class="sort" data-sort="one">Email</th>
                                                <th class="sort" data-sort="two">Number</th>
                                                <th class="sort" data-sort="status">Status</th>
                                                <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                        </thead>


                                        <tbody class="list form-check-all">
                                            @foreach($users as $data)
                                            <tr>
                                                <td>@if($data->image)
                                                    <a href="{{ asset('assets/front/images/users/'.$data['image']) }}" target="_blank"><img src="{{ asset('assets/front/images/users/'.$data['image']) }}" style="height:50px;width:auto" class="rounded"></a>
                                                    @else
                                                    <img src="{{ asset('assets/front/images/users/user-dummy-img.jpg') }}" style="height:50px;width:auto">
                                                    @endif
                                                </td>
                                                <td class="name">{{ $data->name }}</td>
                                                
                                                <td class="one">
                                                    {{ $data->email }}
                                                    @if(!$data->email_verified_at)
                                                        <span class="badge bg-danger-subtle text-danger badge-border" title="Not Verified"><i class="bx bx-x"></i></span>
                                                    @else
                                                        <span class="badge bg-success-subtle text-success badge-border" title="Verified"><i class="bx bx-check"></i></span>
                                                    @endif

                                                    @php
                                                        $isSubscriber = \App\Models\Subscriber::where('email', $data->email)->exists();
                                                    @endphp
                                                
                                                    @if($isSubscriber)
                                                        <br><span class="badge badge-gradient-success">Subscriber</span>
                                                    @endif
                                                </td>

                                                
                                                <td class="two">{{ $data->number }}</td>
                                                
                                                <td><i class="bx bx-refresh"></i>
                                                    @if($data['status'] == '1')
                                                        <label for="updateStatus-{{ $data['id'] }}" class="badge bg-success-subtle text-success text-uppercase status cursor-pointer">Active</label>
                                                    @elseif($data['status'] == '0')
                                                        <label for="updateStatus-{{ $data['id'] }}" class="badge bg-danger-subtle text-danger text-uppercase status cursor-pointer">Inactive</label>
                                                    @else
                                                        <label for="updateStatus-{{ $data['id'] }}" class="badge bg-warning-subtle text-warning text-uppercase status cursor-pointer">Pending</label>
                                                    @endif
                                                </td>


                                                <td>
                                                    <div class="d-flex gap-2">
                                                        
                                                        <form action="{{ route('admin.user.status') }}" method="POST" class="d-none">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $data['id'] }}">
                                                            <input type="submit" id="updateStatus-{{ $data['id'] }}">
                                                        </form>
                                                        
                                                        <div class="edit">
                                                            <a class="btn btn-sm btn-success" href="{{ route('admin.user.edit', $data['id']) }}"><i class="bx bx-pen"></i></a>
                                                        </div>
                                                        
                                                        <div class="edit">
                                                            <button class="btn btn-sm btn-warning edit-item-btn" data-bs-toggle="modal"
                                                            data-id="{{ $data['id'] }}"
                                                            data-name="{{ $data['name'] }}"
                                                            data-email="{{ $data['email'] }}"
                                                            data-bs-target="#editPass"><i class="bx bx-key"></i></button>
                                                        </div>
                                                        
                                                        <div class="remove">
                                                            <button class="btn btn-sm btn-danger remove-item-btn" data-id="{{ $data['id'] }}" data-bs-toggle="modal" data-bs-target="#deleteRecordModal"> <i class="bx bx-trash"></i> </button>
                                                        </div>                                                            
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
            
            <!-- Default Modals -->
<div class="modal fade" id="editPass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form class="tablelist-form" autocomplete="off" action="{{ route('admin.updateCategory') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">                               
                    <input type="hidden" name="id" id="edit_id">
                    
                    <div class="mb-3">
                        <h6 id="edit_name">Demo User</h6>
                        <h6 id="edit_email">Demo@gmail.com</h6>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="text" id="pass" name="password" class="form-control" required />
                        <p id="passError" class="text-danger passErrs">Password must contain at least 1 capital letter, 1 number, 1 special character and minimum 8 characters.</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" id="c_pass" name="confirm_password" class="form-control" required />
                        <p id="confirmError" class="text-danger passErrs">Confirm Password does not match!</p>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="update-pass">Update Password</button>
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
                                <div class="mt-4 pt-2 fs-15">
                                    <h4>Are you Sure ?</h4>
                                    <p class="text-muted mx-4 mb-0">Are you Sure You want to Delete this User ?</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('admin.user.delete') }}" method="POST">
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
document.addEventListener('click', e => {
  const btn = e.target.closest('.edit-item-btn');
  if (!btn) return;

  document.getElementById('edit_id').value = btn.dataset.id || '';
  document.getElementById('pass').value = '';
  document.getElementById('c_pass').value = '';
  document.getElementById('edit_name').textContent = btn.dataset.name || '';
  document.getElementById('edit_email').textContent = btn.dataset.email || '';
});


document.addEventListener("click", function (e) {
    if (e.target.classList.contains("remove-item-btn")) {
        let deleteId = e.target.getAttribute("data-id");
        document.getElementById("deleteId").value = deleteId;
    }
});

$(document).ready(function(){
    $(".passErrs").hide();
    const $pass = $("#pass");
    const $cPass = $("#c_pass");
    const $updateBtn = $("#update-pass");
    const $passError = $("#passError");
    const $confirmError = $("#confirmError");
    $pass.attr("type", "password");
    
    function validatePassword() {
        const password = $pass.val();
        const regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if (regex.test(password)) {
            $passError.hide();
            return true;
        } else {
            $passError.show();
            return false;
        }
    }
    
    function confirmPassword() {
        const password = $pass.val();
        const confirm = $cPass.val();
        
        if (password === confirm && password.length > 0) {
            $confirmError.hide();
            return true;
        } else {
            $confirmError.show();
            return false;
        }
    }
    
    function updateButtonState() {
        const isValid = validatePassword() && confirmPassword();
        $updateBtn.prop("disabled", !isValid);
    }
    
    $pass.on("input", updateButtonState);
    $cPass.on("input", updateButtonState);
    
    updateButtonState();
});
</script>

@endsection