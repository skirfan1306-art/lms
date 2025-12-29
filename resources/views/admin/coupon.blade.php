@extends('admin.layout.app')

@section('main.content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Coupons</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#addAdmin"><i class="ri-add-line align-bottom me-1"></i> Create New Coupon</button>
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
                                                <th class="sort" data-sort="name">Code</th>
                                                <th class="sort" data-sort="one">Apply Type</th>
                                                <th class="sort" data-sort="two">Course</th>
                                                <th class="sort" data-sort="email">Discount Type</th>
                                                <th class="sort" data-sort="three"> Discount Value</th>
                                                <th class="sort" data-sort="four"> Min Purchase</th>
                                                <th class="sort" data-sort="five"> Date</th>
                                                <th class="sort" data-sort="six"> Usage Limit</th>
                                                <th class="sort" data-sort="seven"> Used Count</th>
                                                <th class="sort" data-sort="status"> Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody class="list form-check-all">
                                                @if($coupons->isEmpty())
                                                <tr>
                                                    <td colspan="8" class="text-center text-muted">No data found</td>
                                                </tr>
                                            @else
                                            @foreach($coupons as $data)
                                            <tr>

                                                <td class="id">
                                                    <a href="javascript:void(0);" class="fw-medium link-primary">{{ $loop->iteration }}</a>
                                                </td>
                                                <td class="name">{{ $data['code'] }}</td>
                                                <td class="two">{{ $data['apply_type'] }}</td>
                                                <td class="email"><a href="{{ route('admin.course.view', $data->course->id ?? '0') }}">{{ \Illuminate\Support\Str::limit($data->course->name ?? '', 50)  }}</a></td>
                                                <td class="one">{{ $data['discount_type'] }}</td>
                                                <td class="three">
                                                    @if($data['discount_type'] === 'percent')
                                                        {{ rtrim(rtrim($data['discount_value'], '0'), '.') }} %
                                                    @else
                                                        {{ $data['discount_value'] }}
                                                    @endif
                                                </td>
                                                <td class="four">{{ $data['min_purchase'] }}</td>
                                                
                                                <td class="five">Start Date: {{ $data['start_date'] }} <br> End Date: {{ $data['end_date'] }}</td>
                                                <td class="six">{{ $data['usage_limit'] }}</td>
                                                <td class="seven">{{ $data['used_count'] }}</td>

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
                                                        <form action="{{ route('admin.coupon.status') }}" method="POST" class="d-none">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $data['id'] }}">
                                                            <input type="submit" id="updateStatus-{{ $data['id'] }}">
                                                        </form>
                                                        
                                                        <button class="btn btn-sm btn-success edit-item-btn"
                                                                data-id="{{ $data->id }}"
                                                                data-code="{{ $data->code }}"
                                                                data-apply-type="{{ $data->apply_type }}"
                                                                data-course-id="{{ $data->course_id ?? '' }}"
                                                                data-discount-type="{{ $data->discount_type }}"
                                                                data-discount-value="{{ $data->discount_value }}"
                                                                data-min-purchase="{{ $data->min_purchase }}"
                                                                data-start-date="{{ $data->start_date }}"
                                                                data-end-date="{{ $data->end_date }}"
                                                                data-usage-limit="{{ $data->usage_limit }}"
                                                                data-used-count="{{ $data->used_count }}"
                                                                data-bs-toggle="modal" data-bs-target="#editAdmin">
                                                            <i class="bx bx-pen"></i>
                                                        </button>
                                                        
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
            

            <div class="modal fade" id="addAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" id="exampleModalLabel">Create New Coupon</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
<form class="tablelist-form" action="{{ route('admin.coupon.create') }}" method="POST">
    @csrf
    <div class="modal-body">

        <div class="mb-3">
            <label class="form-label">Coupon Code</label>
            <input type="text" class="form-control" placeholder="Enter Coupon Code" name="code" required />
        </div>

        <div class="mb-3">
            <label class="form-label">Apply Type</label>
            <select class="form-control" name="apply_type" id="applyType">
                <option value="cart">Cart</option>
                <option value="course">Course</option>
            </select>
        </div>

        <div class="mb-3" id="courseBox" style="display:none;">
            <label class="form-label">Select Course</label>
            <select class="form-control" name="course_id">
                <option value="" disabled>-- Select Course --</option>
                @foreach($courses as $course)
                    <option value="{{$course->id}}">
                        {{ \Illuminate\Support\Str::limit($course->name, 50) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Discount Type</label>
            <select class="form-control" name="discount_type" required>
                <option value="percent">Percentage (%)</option>
                <option value="fixed">Fixed Amount</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Discount Value</label>
            <input type="number" class="form-control" name="discount_value" placeholder="Enter Discount Value" />
        </div>
        
        <div class="mb-3">
            <label class="form-label">Minimum Purchase</label>
            <input type="number" class="form-control" name="min_purchase" placeholder="Enter Minimum Purchase Amount" />
        </div>

        <div class="row">
        <div class="mb-3 col-6">
            <label class="form-label">Start Date</label>
            <input type="date" class="form-control" name="start_date" required />
        </div>

        <div class="mb-3 col-6">
            <label class="form-label">End Date</label>
            <input type="date" class="form-control" name="end_date" required />
        </div>

        <div class="mb-3 col-6">
            <label class="form-label">Usage Limit</label>
            <input type="number" class="form-control" name="usage_limit" placeholder="How many times can use?" required />
        </div>

        <div class="mb-3 col-6">
            <label class="form-label">Used Count</label>
            <input type="number" class="form-control" name="used_count" value="0" readonly />
        </div>
        </div>

    </div>

    <div class="modal-footer">
        <div class="hstack gap-2 justify-content-end">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Add Coupon</button>
        </div>
    </div>
</form>
                    </div>
                </div>
            </div>


<!-- Edit Modal -->
<div class="modal fade" id="editAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light p-3">
        <h5 class="modal-title" id="exampleModalLabel">Edit Coupon</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
      </div>

      <form class="tablelist-form" action="{{ route('admin.coupon.update') }}" method="POST" id="editCouponForm">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="id" id="edit_id" />

          <div class="mb-3">
            <label class="form-label">Coupon Code</label>
            <input id="edit_code" type="text" class="form-control" name="code" required />
          </div>

          <div class="mb-3">
            <label class="form-label">Apply Type</label>
            <select id="edit_apply_type" name="apply_type" class="form-control">
              <option value="cart">Cart</option>
              <option value="course">Course</option>
            </select>
          </div>

          <div class="mb-3" id="courseBox2" style="display:none;">
            <label class="form-label">Select Course</label>
            <select id="edit_course_id" name="course_id" class="form-control">
              <option value="" disabled>-- Select Course --</option>
              @foreach($courses as $course)
                <option value="{{ $course->id }}">{{ \Illuminate\Support\Str::limit($course->name, 50) }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Discount Type</label>
            <select id="edit_discount_type" name="discount_type" class="form-control" required>
              <option value="percent">Percentage (%)</option>
              <option value="fixed">Fixed Amount</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Discount Value</label>
            <input id="edit_discount_value" type="number" class="form-control" name="discount_value" />
          </div>

          <div class="mb-3">
            <label class="form-label">Minimum Purchase</label>
            <input id="edit_min_purchase" type="number" class="form-control" name="min_purchase" />
          </div>
          
          <div class="row">
          <div class="mb-3 col-6">
            <label class="form-label">Start Date</label>
            <input id="edit_start_date" type="date" class="form-control" name="start_date" required />
          </div>

          <div class="mb-3 col-6">
            <label class="form-label">End Date</label>
            <input id="edit_end_date" type="date" class="form-control" name="end_date" required />
          </div>

          <div class="mb-3 col-6">
            <label class="form-label">Usage Limit</label>
            <input id="edit_usage_limit" type="number" class="form-control" name="usage_limit" required />
          </div>

          <div class="mb-3 col-6">
            <label class="form-label">Used Count</label>
            <input id="edit_used_count" type="number" class="form-control" name="used_count" readonly />
          </div>
          </div>
        </div>

        <div class="modal-footer">
          <div class="hstack gap-2 justify-content-end">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Update Coupon</button>
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
                                    <p class="text-muted mx-4 mb-0">Are you Sure You want to Delete this Coupon ?</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('admin.coupon.delete') }}" method="POST">
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
document.addEventListener('DOMContentLoaded', function () {

  const $ = id => document.getElementById(id);

  function selectOptionByValue(selectEl, value) {
    if (!selectEl) return;
    const v = (value ?? '').toString().trim().toLowerCase();
    let found = false;
    for (let i = 0; i < selectEl.options.length; i++) {
      const optVal = (selectEl.options[i].value ?? '').toString().trim().toLowerCase();
      const optText = (selectEl.options[i].text ?? '').toString().trim().toLowerCase();
      if (optVal === v || optText === v) {
        selectEl.selectedIndex = i;
        found = true;
        break;
      }
    }
    if (!found) {
      if (selectEl.options.length) selectEl.selectedIndex = 0;
    }
    selectEl.dispatchEvent(new Event('change', { bubbles: true }));
  }

  function toggleCourseBox(value) {
    const box = $('courseBox2');
    if (!box) return;
    box.style.display = (value && value.toString().trim().toLowerCase() === 'course') ? 'block' : 'none';
  }

  document.addEventListener('click', function (e) {
    const btn = e.target.closest('.edit-item-btn');
    if (!btn) return;

    const get = name => (btn.getAttribute('data-' + name) ?? '').toString();

    $('edit_id').value = get('id');
    $('edit_code').value = get('code');

    selectOptionByValue($('edit_apply_type'), get('apply-type'));

    selectOptionByValue($('edit_discount_type'), get('discount-type'));
    $('edit_discount_value').value = get('discount-value') || '';
    $('edit_min_purchase').value = get('min-purchase') || '';
    $('edit_start_date').value = get('start-date') || '';
    $('edit_end_date').value = get('end-date') || '';
    $('edit_usage_limit').value = get('usage-limit') || '';
    $('edit_used_count').value = get('used-count') || 0;

    selectOptionByValue($('edit_course_id'), get('course-id'));

    const currentApply = ($('edit_apply_type').value ?? '').toString();
    toggleCourseBox(currentApply);
  }, false);

  const applyEl = $('edit_apply_type');
  if (applyEl) {
    applyEl.addEventListener('change', function () {
      toggleCourseBox(this.value);
    });
  }

  const modalEl = $('editAdmin');
  if (modalEl) {
    modalEl.addEventListener('shown.bs.modal', function () {
      const current = applyEl ? applyEl.value : 'Cart';
      toggleCourseBox(current);
    });
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