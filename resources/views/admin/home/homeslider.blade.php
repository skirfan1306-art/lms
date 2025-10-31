@extends('admin.layout.app')
@php
 
@endphp
@section('main.content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Add, Edit & Remove</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add</button>
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
                                                <th class="sort" data-sort="name">Title</th>
                                                <th class="sort" data-sort="email">Sub Title</th>
                                                <th>Desktop Image</th> 
                                                <th>mobile Image</th> 
                                                <th class="sort" data-sort="status"> Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody class="list form-check-all">
                                                @if($homebanners->isEmpty())
                                                <tr>
                                                    <td colspan="8" class="text-center text-muted">No data found</td>
                                                </tr>
                                            @else
                                            @foreach($homebanners as $homebanner)
                                            <tr>

                                                <td class="id">
                                                    <a href="javascript:void(0);" class="fw-medium link-primary">{{ $loop->iteration }}</a>
                                                </td>
                                                <td class="name">{!! $homebanner['title'] !!}</td>
                                                <td class="email">{{ $homebanner['subtitle'] }}</td>
                                                <td  ><img class="border" src="{{ asset('assets/front/images/homepage/' . $homebanner['desktop_img'])}}" height="75px"/></td> 
                                                <td  ><img class="border" src="{{ asset('assets/front/images/homepage/' . $homebanner['mobile_img'])}}" height="75px"/></td> 
                                              
                                                <td>
                                                    @if($homebanner['status'] == 'Active')
                                                    <button data-status-id="{{ $homebanner['id'] }}" type="button" class="status-btn border-0 badge bg-success-subtle text-success text-uppercase status">Active</button>
                                                    @elseif($homebanner['status'] == 'Inactive')
                                                    <button data-status-id="{{ $homebanner['id'] }}" type="button" class="status-btn border-0 badge bg-danger-subtle text-danger text-uppercase status">Inactive</button>
                                                    @else
                                                    <button data-status-id="{{ $homebanner['id'] }}" type="button" class="status-btn border-0 badge bg-warning-subtle text-warning text-uppercase status">Unknown</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <div class="edit">
                                                            <button class="btn btn-sm btn-success edit-item-btn" data-id="{{ $homebanner['id'] }}" data-title="{{ $homebanner['title'] }}" data-subtitle="{{ $homebanner['subtitle'] }}" data-deskimg="{{ $homebanner['desktop_img'] }}" data-mobileimg="{{ $homebanner['mobile_img'] }}" data-bs-toggle="modal" data-bs-target="#showeditModal">Edit</button>
                                                        </div>
                                                        <div class="remove">
                                                            <button data-delete-id="{{ $homebanner['id'] }}" class="remove-btn btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Remove</button>
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
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
                        <form class="tablelist-form" action="{{ route('admin.addbanners') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                              
                                <div class="mb-3">
                                    <label  class="form-label">Title</label>
                                    <input type="text" class="form-control" placeholder="Enter Title" name="title" />
                                    <div class="invalid-feedback">Please enter a phone.</div>
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Sub Title</label>
                                    <input type="text" class="form-control" placeholder="Enter Sub Title" name="subtitle" />
                                    <div class="invalid-feedback">Please enter a phone.</div>
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Desktop Image</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="desktopImg" 
                                            onchange="document.querySelector('#viewdesktopimg').src = window.URL.createObjectURL(this.files[0]);">
                                    </div>    
                                       <img src="{{ asset('assets/imgprev.png') }}" class="me-4 mt-2" width="auto" style="max-width:100%" height="150px" id="viewdesktopimg">
                                    <div class="invalid-feedback">Please enter a phone.</div>
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Mobile Image</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="mobileImg" 
                                            onchange="document.querySelector('#viewmobileimg').src = window.URL.createObjectURL(this.files[0]);">
                                    </div>    
                                       <img src="{{ asset('assets/imgprev.png') }}" class="me-4 mt-2" width="auto" style="max-width:100%" height="150px" id="viewmobileimg">
                                    <div class="invalid-feedback">Please enter a phone.</div>
                                </div>

 
 
                            </div>
                            <div class="modal-footer">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="add-btn">Add Banner</button>
                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
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
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
                        <form class="tablelist-form" action="{{ route('admin.updatebanners') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" value="" name="hid" id="hid"/>
                            <div class="modal-body">
                              
                                <div class="mb-3">
                                    <label  class="form-label">Title</label>
                                    <input type="text" id="edit-title" class="form-control" placeholder="Enter Title" name="title" />
                                    <div class="invalid-feedback">Please enter a phone.</div>
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Sub Title</label>
                                    <input type="text" id="edit-subtitle" class="form-control" placeholder="Enter Sub Title" name="subtitle" />
                                    <div class="invalid-feedback">Please enter a phone.</div>
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Desktop Image</label>
                                    <div class="input-group"> 
                                        <input type="file" id="edit-deskimg" class="form-control" name="desktopImg" 
                                            onchange="document.querySelector('#view-deskimg').src = window.URL.createObjectURL(this.files[0]);">
                                    </div>    
                                       <img id="view-deskimg"  src="{{ asset('assets/imgprev.png') }}" class="me-4 mt-2" width="auto" style="max-width:100%" height="150px" >
                                    <div class="invalid-feedback">Please enter a phone.</div>
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Mobile Image</label>
                                    <div class="input-group">
                                        <input type="file" id="edit-mobiimg" class="form-control" name="mobileImg" 
                                            onchange="document.querySelector('#view-mobiimg').src = window.URL.createObjectURL(this.files[0]);">
                                    </div>    
                                       <img id="view-mobiimg" src="{{ asset('assets/imgprev.png') }}" class="me-4 mt-2" width="auto" style="max-width:100%" height="150px" >
                                    <div class="invalid-feedback">Please enter a phone.</div>
                                </div>

 
 
                            </div>
                            <div class="modal-footer">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="add-btn">Update Banner</button>
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
                                    <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn w-sm btn-danger " id="delete-record">Yes, Delete It!</button>
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
var deleteId = null; 

$(document).on('click', '.status-btn', function () {
    statusId = $(this).data('status-id'); 
 
 var thisBtn = $(this);
 thisBtn.attr('disabled', true)
    if (statusId) {
        $.ajax({
           url: "{{ route('admin.homebannerstatus', ':id') }}".replace(':id', statusId),

            type: "POST",
            data : {
                _token : "{{ csrf_token() }}"
            },
            success: function (response) { 
                    if(response.status == 'Inactive'){
                        thisBtn.removeClass('bg-success-subtle text-success').addClass('bg-danger-subtle text-danger').text(response.status).attr('disabled', false);
                    }else{
                        thisBtn.removeClass('bg-danger-subtle text-danger').addClass('bg-success-subtle text-success').text(response.status).attr('disabled', false);
                        
                    }
                },
                error: function (xhr) {
                    console.error('Error: ' + xhr.responseJSON.message);
                }

        });
    }
});


$(document).on('click', '.remove-btn', function () {
    deleteId = $(this).data('delete-id');
    console.log(deleteId);
});
$(document).on('click', '.edit-item-btn', function () {
    var editId = $(this).data('id');
    var title = $(this).data('title');
    var subtitle = $(this).data('subtitle');
    var deskimg = $(this).data('deskimg');
    var mobimg = $(this).data('mobileimg'); 
    
    $('#edit-title').val(title);
    $('#edit-subtitle').val(subtitle);
    $('#hid').val(editId);


if(deskimg !== null){ $('#view-deskimg').attr('src', window.location.origin + '/assets/front/images/homepage/' + deskimg); }
if(mobimg !== null){$('#view-mobiimg').attr('src', window.location.origin + '/assets/front/images/homepage/' + mobimg); }

    
    
    
});
/* 
$('#delete-record').on('click', function () {
    if (deleteId) {
        $.ajax({
 
        });
    }
});*/
</script>

@endsection