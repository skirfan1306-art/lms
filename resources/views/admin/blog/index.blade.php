@extends('admin.layout.app')

@section('main.content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">All Blogs</h4>
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
                                                <th class="sort" data-sort="image">Images</th>
                                                <th class="sort">Alt</th>
                                                <th class="sort" data-sort="name">Title</th>
                                                <th class="sort" data-sort="one">Slug</th>
                                                <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                        </thead>


                                        <tbody class="list form-check-all">
                                            @foreach($blog as $data)
                                            <tr>
                                                <td class="image"><img src="{{ asset('assets/front/images/blog/'.$data['image']) }}" alt="{{ $data['alt'] }}" style="height:80px;width:auto"></td>
                                                <td>{{ $data['alt'] }}</td>
                                                <td class="name">{{ $data['title'] }}</td>
                                                <td class="one">{{ $data['slug'] }}</td>

                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <div>
                                                            <button class="btn btn-sm btn-info view-item-btn" data-bs-toggle="modal" data-bs-target="#myModal"
                                                            data-msg="{{ $data['excerpt'] }}">Excerpt</button>
                                                        </div>
                                                        <div>
                                                            <button class="btn btn-sm btn-dark view-item-btn2" data-bs-toggle="modal" data-bs-target="#myModal2"
                                                            data-msg="{{ $data['description'] }}">Description</button>
                                                        </div>
                                                        
                                                        <div class="edit">
                                                            <a class="btn btn-sm btn-success" href="{{ route('admin.blog.edit', $data['id']) }}"><i class="bx bx-pen"></i></a>
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
<div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Excerpt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <p class="text-muted " id="showMsg"></p>
            </div>
       

        </div>
    </div>
</div>
<div id="myModal2" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="max-width:800px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body" id="showMsg2">
            </div>
       

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
                                    <p class="text-muted mx-4 mb-0">Are you Sure You want to Delete this Blog ?</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('admin.blog.delete') }}" method="POST">
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
    if (e.target.classList.contains("view-item-btn")) {
        let msg = e.target.getAttribute("data-msg");
        document.getElementById("showMsg").textContent = msg;
    }
});
document.addEventListener("click", function (e) {
    if (e.target.classList.contains("view-item-btn2")) {
        let msg = e.target.getAttribute("data-msg");
        document.getElementById("showMsg2").innerHTML = msg;
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