@extends('admin.layout.app')
@php
$customers = [
['id' => '#VZ2101','name' => 'Mary Cousar','email' => 'marycousar@velzon.com','phone' => '580-464-4694','date' => '06 Apr, 2021','status' => 'Active'],
['id' => '#VZ2102','name' => 'John Smith','email' => 'johnsmith@example.com','phone' => '212-555-0189','date' => '15 Apr, 2021','status' => 'Inactive'],
['id' => '#VZ2103','name' => 'Linda Johnson','email' => 'lindaj@demo.com','phone' => '305-222-4456','date' => '21 May, 2021','status' => 'Pending'],
['id' => '#VZ2104','name' => 'David Brown','email' => 'davidbrown@mail.com','phone' => '415-784-5521','date' => '10 Jun, 2021','status' => 'Active'],
['id' => '#VZ2105','name' => 'Emma Wilson','email' => 'emmawilson@mail.com','phone' => '718-665-1122','date' => '22 Jul, 2021','status' => 'Inactive'],
['id' => '#VZ2106','name' => 'Michael Scott','email' => 'mscott@dundermifflin.com','phone' => '213-778-2244','date' => '02 Aug, 2021','status' => 'Active'],
['id' => '#VZ2107','name' => 'Sophia Lee','email' => 'sophia.lee@mail.com','phone' => '917-442-8899','date' => '19 Aug, 2021','status' => 'Pending'],
['id' => '#VZ2108','name' => 'Daniel Garcia','email' => 'danielg@mail.com','phone' => '646-335-7788','date' => '25 Sep, 2021','status' => 'Active'],
['id' => '#VZ2109','name' => 'Olivia Miller','email' => 'oliviamiller@mail.com','phone' => '312-445-9988','date' => '06 Oct, 2021','status' => 'Inactive'],
['id' => '#VZ2110','name' => 'James Taylor','email' => 'jamestaylor@mail.com','phone' => '917-225-6677','date' => '14 Nov, 2021','status' => 'Active'],
['id' => '#VZ2111','name' => 'Ava Martinez','email' => 'ava.martinez@mail.com','phone' => '305-774-5566','date' => '22 Nov, 2021','status' => 'Pending'],
['id' => '#VZ2112','name' => 'William Harris','email' => 'will.harris@mail.com','phone' => '213-998-7744','date' => '05 Dec, 2021','status' => 'Inactive'],
['id' => '#VZ2113','name' => 'Mia Clark','email' => 'miac@mail.com','phone' => '646-441-2255','date' => '14 Dec, 2021','status' => 'Active'],
['id' => '#VZ2114','name' => 'Benjamin Lewis','email' => 'benlewis@mail.com','phone' => '718-882-3344','date' => '06 Jan, 2022','status' => 'Active'],
['id' => '#VZ2115','name' => 'Charlotte Hall','email' => 'charlotte.h@mail.com','phone' => '917-778-6622','date' => '18 Jan, 2022','status' => 'Inactive'],
['id' => '#VZ2116','name' => 'Henry Walker','email' => 'henryw@mail.com','phone' => '415-224-6633','date' => '05 Feb, 2022','status' => 'Pending'],
['id' => '#VZ2117','name' => 'Amelia Young','email' => 'ameliay@mail.com','phone' => '305-221-8899','date' => '14 Feb, 2022','status' => 'Active'],
['id' => '#VZ2118','name' => 'Lucas Allen','email' => 'lucasallen@mail.com','phone' => '212-774-9988','date' => '28 Feb, 2022','status' => 'Inactive'],
['id' => '#VZ2119','name' => 'Harper King','email' => 'harperking@mail.com','phone' => '646-224-4455','date' => '12 Mar, 2022','status' => 'Pending'],
['id' => '#VZ2120','name' => 'Ethan Wright','email' => 'ethanw@mail.com','phone' => '917-334-5566','date' => '24 Mar, 2022','status' => 'Active'],
['id' => '#VZ2121','name' => 'Ella Green','email' => 'ellag@mail.com','phone' => '718-442-7788','date' => '02 Apr, 2022','status' => 'Inactive'],
['id' => '#VZ2122','name' => 'Alexander Adams','email' => 'alexadams@mail.com','phone' => '213-667-4455','date' => '11 Apr, 2022','status' => 'Active'],
['id' => '#VZ2123','name' => 'Abigail Baker','email' => 'abigailb@mail.com','phone' => '415-667-7788','date' => '20 Apr, 2022','status' => 'Pending'],
['id' => '#VZ2124','name' => 'Matthew Nelson','email' => 'mattn@mail.com','phone' => '646-774-9988','date' => '01 May, 2022','status' => 'Active'],
['id' => '#VZ2125','name' => 'Sofia Perez','email' => 'sofiap@mail.com','phone' => '917-882-3344','date' => '12 May, 2022','status' => 'Inactive'],
];
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
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort" data-sort="id">#</th>
                                                <th class="sort" data-sort="name">Customer</th>
                                                <th class="sort" data-sort="email">Email</th>
                                                <th class="sort" data-sort="phone">Phone</th>
                                                <th class="sort" data-sort="date">Joining Date</th>
                                                <th class="sort" data-sort="status">Delivery Status</th>
                                                <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                        </thead>


                                        <tbody class="list form-check-all">
                                            @foreach($customers as $key => $customer)
                                            <tr>

                                                <td class="id">
                                                    <a href="javascript:void(0);" class="fw-medium link-primary">{{ $customer['id'] }}</a>
                                                </td>
                                                <td class="name">{{ $customer['name'] }}</td>
                                                <td class="email">{{ $customer['email'] }}</td>
                                                <td class="phone">{{ $customer['phone'] }}</td>
                                                <td class="date">{{ $customer['date'] }}</td>
                                                <td class="status">
                                                    @if($customer['status'] == 'Active')
                                                    <span class="badge bg-success-subtle text-success text-uppercase">Active</span>
                                                    @elseif($customer['status'] == 'Inactive')
                                                    <span class="badge bg-danger-subtle text-danger text-uppercase">Inactive</span>
                                                    @else
                                                    <span class="badge bg-warning-subtle text-warning text-uppercase">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <div class="edit">
                                                            <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal">Edit</button>
                                                        </div>
                                                        <div class="remove">
                                                            <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Remove</button>
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

            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
                        <form class="tablelist-form" autocomplete="off">
                            <div class="modal-body">
                                <div class="mb-3" id="modal-id" style="display: none;">
                                    <label for="id-field" class="form-label">ID</label>
                                    <input type="text" id="id-field" class="form-control" placeholder="ID" readonly />
                                </div>

                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Customer Name</label>
                                    <input type="text" id="customername-field" class="form-control" placeholder="Enter Name" required />
                                    <div class="invalid-feedback">Please enter a customer name.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="email-field" class="form-label">Email</label>
                                    <input type="email" id="email-field" class="form-control" placeholder="Enter Email" required />
                                    <div class="invalid-feedback">Please enter an email.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="phone-field" class="form-label">Phone</label>
                                    <input type="text" id="phone-field" class="form-control" placeholder="Enter Phone no." required />
                                    <div class="invalid-feedback">Please enter a phone.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="date-field" class="form-label">Joining Date</label>
                                    <input type="text" id="date-field" class="form-control" placeholder="Select Date" required />
                                    <div class="invalid-feedback">Please select a date.</div>
                                </div>

                                <div>
                                    <label for="status-field" class="form-label">Status</label>
                                    <select class="form-control" data-trigger name="status-field" id="status-field" required>
                                        <option value="">Status</option>
                                        <option value="Active">Active</option>
                                        <option value="Block">Block</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="add-btn">Add Customer</button>
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