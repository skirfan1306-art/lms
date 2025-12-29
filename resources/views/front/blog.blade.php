@extends('front.layout.app')

@section('title')
Blog
@endsection

@section('main') 


    <main class="main">
      <!-- breadcrumb -->
      <div class="site-breadcrumb" style="background: url(/assets/front/img//breadcrumb/01.png)">
        <div class="container">
          <h2 class="breadcrumb-title">{{ $page_title ?? 'Our Blog' }}</h2>
          <ul class="breadcrumb-menu">
             <li><a href="{{ route('front.home') }}">Home</a></li>
            <li class="active">{{ $page_title ?? 'Our Blog' }}</li>
          </ul>
        </div>
      </div>
      <!-- breadcrumb end -->

      <!-- blog-area -->
      <div class="blog-area py-120">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 mx-auto">
              <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Our Blog</span>
                <h2 class="site-title">Our Latest News <span class="text-gradient">And Blog</span></h2>
              </div>
            </div>
          </div>
          <div class="row g-4">
              @if($blog->isEmpty())
                    <div class="col-12 text-center">
                        <h4>No blog found</h4>
                    </div>
                @else
              @foreach( $blog as $data)
            <div class="col-md-6 col-lg-4">
              <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
                <div class="blog-date">{{ \Carbon\Carbon::parse($data->created_at)->format('M j, Y') }}</div>
                <div class="blog-img">
                  <a href="{{ route('front.blog-single' , $data->slug ) }}"><img src="{{ asset('assets/front/images/blog/'.$data->image) }}" alt="{{ $data->alt }}" class="blog-thumb" /></a>
                </div>
                 
                <div class="blog-info mt-3">
                  <h4 class="blog-title">
                    <a class="title-text" href="{{ route('front.blog-single' , $data->slug ) }}">{{ $data->title }}</a>
                  </h4>
                  <p class="excerpt-text">{{ $data->excerpt }}</p>
                  <a class="theme-btn" href="{{ route('front.blog-single' , $data->slug ) }}">Read More<i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
            </div>
           
             @endforeach
             @endif
          </div>
          <!-- pagination -->
           @include('front.component.pagination', ['paginator' => $blog])
          <!-- pagination end -->
        </div>
      </div>
      <!-- blog-area end -->
    </main>

@endsection