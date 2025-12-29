@extends('front.layout.app')
@section('title')
Dashboard
@endsection
@section('main')

    <main class="main">
       

      <!-- user dashboard -->
      <div class="user-account py-70">
        <div class="container">
          <div class="row g-4">
            @include('user.layout.sidebar')
            <div class="col-lg-8 col-xl-9">
              <div class="user-wrapper">
                <div class="user-card">
                  <h4 class="title">Summary</h4>
                  <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-4">
                      <div class="user-widget c1">
                        <div class="info">
                          <h1>50</h1>
                          <span>Pending Orders</span>
                        </div>
                        <div class="icon">
                          <i class="fa fa-list"></i>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-4">
                      <div class="user-widget c2">
                        <div class="info">
                          <h1>25k</h1>
                          <span>Enrolled Students</span>
                        </div>
                        <div class="icon">
                          <i class="fa fa-user-tie-hair"></i>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-4">
                      <div class="user-widget c3">
                        <div class="info">
                          <h1>$900</h1>
                          <span>My Balance</span>
                        </div>
                        <div class="icon">
                          <i class="fa fa-wallet"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  
                  <div class="col-lg-12">
                    <div class="user-card mb-0">
                      <div class="header">
                        <h4 class="title">Recent Orders</h4>
                        <div class="header-right">
                          <a href="order-list.html" class="theme-btn">View All<i class="fas fa-arrow-right"></i></a>
                        </div>
                      </div>
                      <div class="user-table table-responsive">
                        <table class="table table-borderless text-nowrap">
                          <thead>
                            <tr>
                              <th>#Order No</th>
                              <th>Purchased Date</th>
                              <th>Paid Amount</th>
                              <th>Course</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($orders as $ord)
                            <tr>
                              <td><span class="code">#{{$ord->order_no}}</span></td>
                              <td>{{ $ord->created_at->format('F d, Y') }}</td>
                              <td>${{$ord->pay_amount}}</td>
                              <td><span class="badge badge-success">{{ \App\Models\CourseOrder::where('order_no', $ord->order_no)->count() }}</span></td>
                              <td>
                                <div class="action-dropdown dropdown">
                                  <a class="action-icon-btn" href="{{route('user.orderDetails', $ord->order_no)}}" >
                                    <i class="far fa-eye"></i>
                                  </a>
                                </div>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- user dashboard end -->
    </main>
 
 
@endsection