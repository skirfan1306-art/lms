@extends('admin.layout.app')

@section('main.content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">



            <div class="row">
                <div class="col-xxl-3">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                    
                                    <h3>Instructor Details</h3><hr>
                                    
                                    @if($instructor->image)
                                    <img src="{{ asset('assets/front/images/instructor/'.$instructor['image']) }}" class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow">
                                    @else
                                    <img src="{{ asset('assets/front/images/users/user-dummy-img.jpg') }}" class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow">
                                    @endif
                                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                        <a href="{{ route('admin.instructor.edit', $instructor['id']) }}" class="profile-photo-edit avatar-xs">
                                            <span class="avatar-title rounded-circle bg-light text-body material-shadow">
                                                <i class="bx bx-pen"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <h5 class="fs-16 mb-1">{{ $instructor->name }}</h5>
                                @if($instructor['status'] == '1')
                                    <label class="badge bg-success-subtle text-success">Active</label>
                                @elseif($instructor['status'] == '0')
                                    <label class="badge bg-danger-subtle text-danger">Inactive</label>
                                @else
                                    <label class="badge bg-warning-subtle text-warning">Pending</label>
                                @endif
                                <!--<p class="text-muted mb-0">Lead Designer / Developer</p>-->

                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Portfolio</h5>
                                </div>
                                
                            </div>
                            @if(!empty($instructor->facebook))
                            <div class="mb-3 d-flex align-items-center">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                    <span class="avatar-title rounded-circle fs-16 bg-primary text-white material-shadow">
                                        <i class="ri-facebook-fill"></i>
                                    </span>
                                </div>
                                <a href="{{ $instructor->facebook }}" target="_blank">{{ $instructor->facebook }}</a>
                            </div>
                            @endif
                            @if(!empty($instructor->linkedin))
                            <div class="mb-3 d-flex align-items-center">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                    <span class="avatar-title rounded-circle fs-16 bg-info material-shadow">
                                        <i class="ri-linkedin-fill"></i>
                                    </span>
                                </div>
                                <a href="{{ $instructor->linkedin }}" target="_blank">{{ $instructor->linkedin }}</a>
                            </div>
                            @endif
                            @if(!empty($instructor->twitter))
                            <div class="mb-3 d-flex align-items-center">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                    <span class="avatar-title rounded-circle fs-16 bg-dark material-shadow">
                                        <i class="ri-twitter-fill"></i>
                                    </span>
                                </div>
                                <a href="{{ $instructor->twitter }}" target="_blank">{{ $instructor->twitter }}</a>
                            </div>
                            @endif
                            @if(!empty($instructor->instagram))
                            <div class="d-flex align-items-center">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                    <span class="avatar-title rounded-circle fs-16 bg-danger material-shadow">
                                        <i class="ri-instagram-fill"></i>
                                    </span>
                                </div>
                                <a href="{{ $instructor->instagram }}" target="_blank">{{ $instructor->instagram }}</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
                <div class="col-xxl-9">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab" aria-selected="true">
                                        <i class="fas fa-home"></i> Personal Details
                                    </a>
                                </li>
                                
                                
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#privacy" role="tab" aria-selected="false" tabindex="-1">
                                        <i class="far fa-envelope"></i>{{ $courses->count() }} Courses
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="personalDetails" role="tabpanel">

                                    <div class="card">
                                
                                        <div class="card-body">
                                
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label fw-bold">Name:</label>
                                                <div class="col-sm-9 pt-2">
                                                    {{ $instructor->name ?? 'N/A' }}
                                                </div>
                                            </div>
                                
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label fw-bold">Email:</label>
                                                <div class="col-sm-9 pt-2">
                                                    {{ $instructor->email ?? 'N/A' }}
                                                </div>
                                            </div>
                                
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label fw-bold">Number:</label>
                                                <div class="col-sm-9 pt-2">
                                                    {{ $instructor->number ?? 'N/A' }}
                                                </div>
                                            </div>
                                
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label fw-bold">Description:</label>
                                                <div class="col-sm-9 pt-2">
                                                    {!! $instructor->description ?? 'No Description Available' !!}
                                                </div>
                                            </div>
                                
                                        </div>
                                    </div>
                                
                                </div>

                                
                                
                                <div class="tab-pane" id="privacy" role="tabpanel">
                                    
                                    
                                    <table class="table align-middle table-nowrap" id="medicineTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th data-sort="name">Name</th>
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
                                                <td><a href="{{ asset('assets/front/images/course/' . $data['image']) }}" target="_blank">
                                                    <img src="{{ asset('assets/front/images/course/' . $data['image']) }}" class="rounded" style="height:50px"></a>
                                                </td>
                                                <td class="name"><a href="{{ route('admin.course.view', $data['id']) }}">{{ Str::limit($data['name'], 40) }}</a></td>

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
                                                        <span class="badge bg-success-subtle text-success status">Active</span>
                                                    @else
                                                        <span class="badge bg-danger-subtle text-danger status">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.course.syllabus', $data['id']) }}" class="btn btn-sm btn-success"><b>{{ $data->syllabus_count }}</b> Syllabus <i class="bx bx-cog"></i></a>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        
                                                        <a href="{{ route('admin.course.view', $data['id']) }}" class="btn btn-sm btn-info"> <i class="bx bx-show"></i> </a>
                                                        <a href="{{ route('admin.course.edit', $data['id']) }}" class="btn btn-sm btn-success"> <i class="bx bx-pen"></i> </a>
                                                        
                                                        
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
                                <!--end tab-pane-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div><!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script>2025 © Velzon.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design &amp; Develop by Themesbrand
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

@endsection
@section('scripts')
<script src="{{ asset('assets/admin/js/pages/profile-setting.init.js') }}"></script>
<script>

</script>

@endsection