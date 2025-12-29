@extends('admin.layout.app')

@section('main.content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
<h3>#{{ $order->order_no }} Order View</h3>
  <div class="row">

    <!-- Left: Course Details (8 cols) -->
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-header fw-semibold">Purchased Courses</div>
        <div class="table-responsive">
          <table class="table mb-0 course-table">
            <thead class="table-light">
              <tr>
                <th>Course Name</th>
                <th>Instructor</th>
                <th>Price</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
              <tr class="course-row">
                <td><a href="{{ route('admin.course.view', $item->course->id) }}" target="_blank">{{$item->course->name}}</a></td>
                <td>{{$item->course->instructor->name}}</td>
                <td>₹{{$item->course_amount}}</td>
                <td><span class="badge bg-success">Active</span></td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Right: Order Details (4 cols) -->
    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-header fw-semibold">Order Details</div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between">
              <span>Order No</span>
              <strong>#{{ $order->order_no }}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total Courses</span>
              <strong>{{ $items->count() }}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total Amount</span>
              <strong>₹{{ $order->total_amount }}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Discount</span>
              <strong>₹{{ $order->coupon_discount ?? 0.00 }}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Pay Amount</span>
              <strong>₹{{ $order->pay_amount }}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Transaction ID</span>
              <strong>{{ $order->transaction_id }}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Payment</span>
              
              <span>
                    {{ $order->payment_method }} &nbsp;
                    @if($order['payment_status'] == 'paid')
                        <label class="badge bg-success-subtle text-success">Paid</label>
                    @elseif($order['payment_status'] == 'failed')
                        <label class="badge bg-danger-subtle text-danger">Failed</label>
                    @elseif($order['payment_status'] == 'refunded')
                        <label class="badge bg-info-subtle text-info">Refunded</label>
                    @else
                        <label class="badge bg-warning-subtle text-warning">Pending</label>
                    @endif
              </span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Purchase Date</span>
              <strong>{{ $order->created_at }}</strong>
            </li>
          </ul>
        </div>
      </div>
    </div>

  </div>

            

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include('admin.layout.footer')
</div>
@endsection
@section('scripts')

@endsection