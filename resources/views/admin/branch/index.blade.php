@extends('admin.layout.app')
@section('main.content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Branches</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add Branch</button>
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
                                    <table class="table align-middle table-no-wrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort" data-sort="id"># </th>
                                                <th>Image</th> 
                                                <th class="sort" data-sort="name">Name</th>
                                                <th class="sort" data-sort="two">Number</th>
                                                <th class="sort" data-sort="email">Mail</th>
                                                <th class="sort" data-sort="one">Address</th>
                                                <th class="sort" data-sort="status"> Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody class="list form-check-all">
                                                @if($branch->isEmpty())
                                                <tr>
                                                    <td colspan="8" class="text-center text-muted">No data found</td>
                                                </tr>
                                            @else
                                            @foreach($branch as $data)
                                            <tr>

                                                <td class="id">
                                                    <a href="javascript:void(0);" class="fw-medium link-primary">{{ $loop->iteration }}</a>
                                                </td>
                                                <td><img class="border" src="{{ asset('assets/front/images/branch/' . $data['image'])}}" height="75px"/></td> 
                                                <td class="name">{!! $data['name'] !!}</td>
                                                <td class="two">{{ $data['number'] }}</td>
                                                <td class="email">{{ $data['mail'] }}</td>
                                                <td class="one">{{ $data['address'] }}</td>

                                                <td>
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
                                                        <form action="{{ route('admin.branch.status') }}" method="POST" class="d-none">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $data['id'] }}">
                                                            <input type="submit" id="updateStatus-{{ $data['id'] }}">
                                                        </form>
                                                        <div class="edit">
                                                            <button class="btn btn-sm btn-success edit-item-btn" 
                                                            data-id="{{ $data['id'] }}" 
                                                            data-name="{{ $data['name'] }}" 
                                                            data-number="{{ $data['number'] }}" 
                                                            data-mail="{{ $data['mail'] }}" 
                                                            data-address="{{ $data['address'] }}" 
                                                            data-img="{{ $data['image'] }}" 
                                                            data-bs-toggle="modal" data-bs-target="#showeditModal"><i class="bx bx-pen"></i></button>
                                                        </div>
                                                        
                                                        <div class="remove">
                                                            <button class="btn btn-sm btn-danger remove-item-btn" data-id="{{ $data['id'] }}" data-bs-toggle="modal" data-bs-target="#deleteRecordModal"><i class="bx bx-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
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

            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" id="exampleModalLabel">Add Branch</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
                        <form class="tablelist-form" action="{{ route('admin.branch.create') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label  class="form-label">Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Branch Name" name="name" required />
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Number</label>
                                    <input type="number" class="form-control" placeholder="Enter Branch Number" name="number" required />
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Mail</label>
                                    <div class="form-icon">
                                        <input type="email" class="form-control form-control-icon" name="mail" placeholder="example@gmail.com" required>
                                        <i class="ri-mail-unread-line"></i>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Address</label>
                                    <input type="text" class="form-control" placeholder="Enter Branch Address" name="address" required />
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Image</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="image" required
                                            onchange="document.querySelector('#viewdesktopimg').src = window.URL.createObjectURL(this.files[0]);">
                                    </div>    
                                       <img src="{{ asset('assets/imgprev.png') }}" class="me-4 mt-2" width="auto" style="max-width:100%" height="150px" id="viewdesktopimg">
                                </div>
                                <div class="form-check form-check-outline form-check-dark mt-3">
                                    <input class="form-check-input" type="checkbox" id="formCheck19" name="make_webp">
                                    <label class="form-check-label" for="formCheck19">Convert all images to WEBP format and reduce their size by 80%.</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="add-btn">Add Branch</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="showeditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Branch</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
                        <form class="tablelist-form" action="{{ route('admin.branch.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="" name="id" id="hid"/>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label  class="form-label">Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Branch Name" id="edit_name" name="name" />
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Number</label>
                                    <input type="number" class="form-control" placeholder="Enter Branch Number" id="edit_number" name="number" />
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Mail</label>
                                    <div class="form-icon">
                                        <input type="email" class="form-control form-control-icon" name="mail" id="edit_mail" placeholder="example@gmail.com">
                                        <i class="ri-mail-unread-line"></i>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Address</label>
                                    <input type="text" class="form-control" placeholder="Enter Branch Address" id="edit_address" name="address" />
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Image</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="image" 
                                            onchange="document.querySelector('#viewEditImg').src = window.URL.createObjectURL(this.files[0]);">
                                    </div>    
                                       <img src="{{ asset('assets/imgprev.png') }}" class="me-4 mt-2" width="auto" style="max-width:100%" height="150px" id="viewEditImg">
                                </div>
                                <div class="form-check form-check-outline form-check-dark mt-3">
                                    <input class="form-check-input" type="checkbox" id="formCheck19" name="make_webp">
                                    <label class="form-check-label" for="formCheck19">Convert all images to WEBP format and reduce their size by 80%.</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="add-btn">Update Branch</button>
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
                                    <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Branch ?</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('admin.branch.delete') }}" method="POST">
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
.
@section('scripts')
<script>
document.addEventListener("click", function (e) {
    if (e.target.classList.contains("remove-item-btn")) {
        let deleteId = e.target.getAttribute("data-id");
        document.getElementById("deleteId").value = deleteId;
    }
});

$(document).on('click', '.edit-item-btn', function () {
    var editId = $(this).data('id');
    var name = $(this).data('name');
    var number = $(this).data('number');
    var mail = $(this).data('mail');
    var address = $(this).data('address'); 
    var img = $(this).data('img'); 

    $('#edit_name').val(name);
    $('#edit_number').val(number);
    $('#edit_mail').val(mail);
    $('#edit_address').val(address);
    $('#hid').val(editId);


if(img !== null){ $('#viewEditImg').attr('src', window.location.origin + '/assets/front/images/branch/' + img); }

});

</script>
@endsection