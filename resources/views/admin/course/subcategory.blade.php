@extends('admin.layout.app')

@section('main.content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">{{ $name ?? 'All' }} {{ $subcategory->count() }} Subcategories</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#addAdmin"><i class="ri-add-line align-bottom me-1"></i> Add New Subcategory</button>
                                    </div>
                                    @if($name != 'All')
                                    <div class="col-sm-auto">
                                        <a class="btn btn-info" href="{{ route('admin.subcategory') }}"><i class="ri-eye-line align-bottom me-1"></i> Show All</a>
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
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort" data-sort="id">#</th>
                                                <th class="sort" data-sort="one">Category</th>
                                                <th class="sort" data-sort="name">Subcategory</th>
                                                <th class="sort" data-sort="two">Slug</th>
                                                <th>Show In Header</th>
                                                <th class="sort" data-sort="status">Status</th>
                                                <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                        </thead>


                                        <tbody class="list form-check-all">
                                            @foreach($subcategory as $data)
                                            <tr>

                                                <td class="id">
                                                    <a href="javascript:void(0);" class="fw-medium link-primary">{{ $loop->iteration }}</a>
                                                </td>
                                                <td class="one">{{ $data->category->name }}</td>
                                                <td class="name">{{ $data['name'] }}</td>
                                                <td class="two">{{ $data['slug'] }}</td>
                                                
                                                <td><i class="bx bx-refresh"></i>
                                                    @if($data['show_in_header'] == '1')
                                                        <label for="updateShow-{{ $data['id'] }}" class="badge bg-success-subtle text-success cursor-pointer ps-4 pe-4 pt-2 pb-2">Yes</label>
                                                    @elseif($data['show_in_header'] == '0')
                                                        <label for="updateShow-{{ $data['id'] }}" class="badge bg-danger-subtle text-danger cursor-pointer ps-4 pe-4 pt-2 pb-2">No</label>
                                                    @else
                                                        <label for="updateShow-{{ $data['id'] }}" class="badge bg-warning-subtle text-warning cursor-pointer ps-4 pe-4 pt-2 pb-2">--</label>
                                                    @endif
                                                </td>
                                                
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
                                                        
                                                        <form action="{{ route('admin.subcategory.show-in-header') }}" method="POST" class="d-none">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $data['id'] }}">
                                                            <input type="submit" id="updateShow-{{ $data['id'] }}">
                                                        </form>
                                                        
                                                        <form action="{{ route('admin.subcategory.status') }}" method="POST" class="d-none">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $data['id'] }}">
                                                            <input type="submit" id="updateStatus-{{ $data['id'] }}">
                                                        </form>
                                                        
                                                        <div class="edit">
                                                            <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal"
                                                            data-id="{{ $data['id'] }}"
                                                            data-cat="{{ $data->category->id }}"
                                                            data-name="{{ $data['name'] }}"
                                                            data-bs-target="#editAdmin"><i class="bx bx-pen"></i></button>
                                                        </div>
                                                        <div class="remove">
                                                            <button class="btn btn-sm btn-danger remove-item-btn" data-id="{{ $data['id'] }}" data-bs-toggle="modal" data-bs-target="#deleteRecordModal"><i class="bx bx-trash"></i></button>
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
            

            <div class="modal fade" id="addAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
                        <form class="tablelist-form" action="{{ route('admin.subcategory.create') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select class="form-control" name="category_id">
                                        @if(is_iterable($cat))
                                            @foreach($cat as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endif

                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Subcategory</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Subcategory Name" required />
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="add-btn">Add Subcategory</button>
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
                        <form class="tablelist-form" autocomplete="off" action="{{ route('admin.subcategory.update') }}" method="POST">
                            @csrf
                            <div class="modal-body">                               
                                <input type="hidden" name="id" id="edit_id">
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select class="form-control" name="category_id" id="edit_cat">
                                        @foreach($cat as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_name" class="form-label">Subcategory</label>
                                    <input type="text" id="edit_name" name="name" class="form-control" placeholder="Enter subcategory Name" required />
                                </div>
                               
                            </div>
                            <div class="modal-footer">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="add-btn">Update Subcategory</button>
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
                                    <p class="text-muted mx-4 mb-0">Are you Sure You want to Delete this Subcategory ?</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('admin.subcategory.delete') }}" method="POST">
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
  document.getElementById('edit_name').value = btn.dataset.name || '';

  const catSelect = document.getElementById('edit_cat');
  if (catSelect) {
    catSelect.value = btn.dataset.cat || '';
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