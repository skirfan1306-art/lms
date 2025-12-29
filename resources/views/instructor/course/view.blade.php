@extends('instructor.layout.app')

@section('main.content')

<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Product Details</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row gx-lg-5">
                                        <div class="col-xl-4 col-md-8 mx-auto">
                                            <div class="product-img-slider sticky-side-div">
                                                <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <img src="{{ asset('assets/front/images/course/' . $view['image']) }}" alt="" class="img-fluid d-block" />
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <!-- end col -->

                                        <div class="col-xl-8">
                                            <div class="mt-xl-0 mt-5">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <h4>{{ $view->name }}</h4>
                                                        
                                                        <div class="hstack gap-3 flex-wrap mb-3 mt-3">
                                                            <div class="text-muted">Category : <span class="text-body fw-medium">{{ $view->category->name }}</span></div>
                                                            <div class="vr"></div>
                                                            <div class="text-muted">Subcategory : <span class="text-body fw-medium">{{ $view->subcategory->name }}</span></div>
                                                            <div class="vr"></div>
                                                            <div class="text-muted">Tag : <span class="text-body fw-medium">{{ $view->tag }}</span></div>
                                                        </div>
                                                        <div class="hstack gap-3 flex-wrap">
                                                            <div class="text-muted">Published : <span class="text-body fw-medium">{{ $view->created_at->format('d M, Y \a\t g:i A') }}</span></div>
                                                            <div class="vr"></div>
                                                            <div class="text-muted">Last Update : <span class="text-body fw-medium">{{ $view->updated_at->format('d M, Y \a\t g:i A') }}</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div>
                                                            <a href="{{ route('admin.course.edit', $view->id) }}" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="ri-pencil-fill align-bottom"></i></a>
                                                        </div>
                                                    </div>
                                                </div>

@php
    $avg = round($averageRating); // Round to nearest star
@endphp

<div class="d-flex flex-wrap gap-2 align-items-center mt-3">
    <div class="text-muted fs-16">
        @for($i = 1; $i <= 5; $i++)
            @if($i <= $avg)
                <span class="mdi mdi-star text-warning"></span>
            @else
                <span class="mdi mdi-star-outline text-warning"></span>
            @endif
        @endfor
    </div>

    <div class="text-muted">
        ( {{ number_format($averageRating,1) }} From {{ $totalReviews }} Reviews )
    </div>
</div>



                                                <div class="row mt-4">
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div class="p-2 border border-dashed rounded">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm me-2">
                                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                        <i class="ri-money-dollar-circle-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <p class="text-muted mb-1">Old Price :</p>
                                                                    <h5 class="mb-0">{{ $view->old_price }}</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div class="p-2 border border-dashed rounded">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm me-2">
                                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                        <i class="ri-money-dollar-circle-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <p class="text-muted mb-1">Sale Price :</p>
                                                                    <h5 class="mb-0">{{ $view->sale_price }}</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div class="p-2 border border-dashed rounded">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm me-2">
                                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                        <i class="ri-file-copy-2-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <p class="text-muted mb-1">No. of Orders :</p>
                                                                    <h5 class="mb-0">2,234</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div class="p-2 border border-dashed rounded">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm me-2">
                                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                        <i class="ri-stack-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <p class="text-muted mb-1">Available Stocks :</p>
                                                                    <h5 class="mb-0">{{ $view->quantity }}</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                    
                                                </div>

                                                <div class="mt-4 text-muted">
                                                    <h5 class="fs-14">Description :</h5>
                                                    {!! $view->description !!}
                                                </div>


                                                <div class="product-content mt-5">
                                                    <nav>
                                                        <ul class="nav nav-tabs nav-tabs-custom nav-success" id="nav-tab" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" id="nav-speci-tab" data-bs-toggle="tab" href="#nav-speci" role="tab" aria-controls="nav-speci" aria-selected="true">Syllabus & Lesson</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="nav-detail-tab" data-bs-toggle="tab" href="#nav-detail" role="tab" aria-controls="nav-detail" aria-selected="false">Policy</a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                    <div class="tab-content border border-top-0 p-4" id="nav-tabContent">
                                                        <div class="tab-pane fade show active" id="nav-speci" role="tabpanel" aria-labelledby="nav-speci-tab">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-striped align-middle">
                                                                    <thead class="table-dark">
                                                                        <tr>
                                                                            <th width="220">Syllabus</th>
                                                                            <th>Lessons</th>
                                                                        </tr>
                                                                    </thead>
                                                                
                                                                    <tbody>
                                                                        @foreach($syllabus as $s)
                                                                        <tr>
                                                                            <th>
                                                                                @if($s->status == 1)
                                                                                    <span class="bg-success rounded-circle" style="height:10px; width:10px; display:inline-block;" title="Active"></span>
                                                                                @else
                                                                                    <span class="bg-danger rounded-circle" style="height:10px; width:10px; display:inline-block;" title="Inactive"></span>
                                                                                @endif
                                                                                &nbsp;{{ $s->name }}
                                                                            </th>

                                                                            <td>
                                                                                @if($s->lesson->count() > 0)
                                                                                    <ul class="mb-0" style="list-style: none; padding-left:0px">
                                                                                        @foreach($s->lesson as $l)
                                                                                            <li>
                                                                                                @if($l->status == 1)
                                                                                                    <span class="bg-success rounded-circle" style="height:8px; width:8px; display:inline-block;" title="Active"></span>
                                                                                                @else
                                                                                                    <span class="bg-danger rounded-circle" style="height:8px; width:8px; display:inline-block;" title="Inactive"></span>
                                                                                                @endif
                                                                                                &nbsp;{{ $l->name }}
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                @else
                                                                                    <span class="text-muted">No lessons available</span>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="nav-detail" role="tabpanel" aria-labelledby="nav-detail-tab">
                                                            <div>
                                                                {!! $view['policy'] !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- product-content -->

<div class="mt-5">
    <div>
        <h5 class="fs-14 mb-3">Ratings & Reviews</h5>
    </div>

    @php
        $avg = number_format($averageRating, 1);
        $rounded = floor($averageRating); // full stars
        $half = ($averageRating - $rounded) >= 0.5; // half star
    @endphp

    <div class="row gy-4 gx-0">
        <div class="col-lg-4">
            <div>
                <div class="pb-3">
                    <div class="bg-light px-3 py-2 rounded-2 mb-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="fs-16 align-middle text-warning">
                                    @for($i = 1; $i <= $rounded; $i++)
                                        <i class="ri-star-fill"></i>
                                    @endfor

                                    @if($half)
                                        <i class="ri-star-half-fill"></i>
                                    @endif

                                    @for($i = ($rounded + $half); $i < 5; $i++)
                                        <i class="ri-star-line"></i>
                                    @endfor
                                </div>
                            </div>

                            <div class="flex-shrink-0">
                                <h6 class="mb-0">{{ $avg }} out of 5</h6>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <div class="text-muted">
                            Total <span class="fw-medium">{{ $totalReviews }}</span> reviews
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    @foreach([5,4,3,2,1] as $star)
                        @php
                            $count = $ratingCounts[$star];
                            $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                            $barColor = $star >= 4 ? 'bg-success' : ($star >= 2 ? 'bg-warning' : 'bg-danger');
                        @endphp

                        <div class="row align-items-center g-2 mb-2">
                            <div class="col-auto">
                                <h6 class="mb-0">{{ $star }} star</h6>
                            </div>
                            <div class="col">
                                <div class="progress animated-progress progress-sm">
                                    <div class="progress-bar {{ $barColor }}" role="progressbar"
                                        style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <h6 class="mb-0 text-muted">{{ $count }}</h6>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Review List -->
        <div class="col-lg-8">
            <div class="ps-lg-4">
                <h5 class="fs-14">Reviews:</h5>

                <div class="me-lg-n3 pe-lg-4" data-simplebar style="max-height: 225px;">
                    <ul class="list-unstyled mb-0">

                        @foreach($reviews as $r)
                            @php
                                $bgColor = $r->rating >= 4 ? 'bg-success' : ($r->rating >= 2 ? 'bg-warning' : 'bg-danger');
                            @endphp
                            <li class="py-2">
                                <div class="border border-dashed rounded p-3">
                                    <h5 class="fs-14 mb-2">{{ $r->user->name ?? 'User' }}
                                        <div class="badge rounded-pill {{ $bgColor }} mb-0">
                                            <i class="mdi mdi-star"></i> {{ $r->rating }}
                                        </div>
                                    </h5>
                                    <p class="text-muted mb-0">{{ $r->msg }}</p>
                                </div>
                            </li>
                        @endforeach


                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

                                                <!-- end card body -->
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('instructor.layout.footer')
        </div>

@endsection
@section('scripts')
<script src="{{ asset('assets/admin/js/pages/ecommerce-product-details.init.js') }}"></script>
@endsection