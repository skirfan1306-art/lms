@extends('front.layout.app')

@section('title')
{{ $blog->title }}
@endsection

@section('main')  
    <main class="main">
      <!-- breadcrumb -->
      <div class="site-breadcrumb" style="background: url(/assets/front/img/breadcrumb/01.png)">
        <div class="container">
          <h2 class="breadcrumb-title">{{ $blog->title }}</h2>
          <ul class="breadcrumb-menu">
            <li><a href="{{ route('front.home') }}">Home</a></li>
            <li class="active">{{ $blog->title }}</li>
          </ul>
        </div>
      </div>
      <!-- breadcrumb end -->

      <!-- blog single -->
      <div class="blog-single py-120">
        <div class="container">
          <div class="row g-4">
            <div class="col-lg-8">
              <div class="blog-single-wrap">
                <div class="blog-single-content">
                  <div class="blog-thumb-img">
                    <img src="{{ asset('assets/front/images/blog/'.$blog->image) }}" width="100%" alt="{{ $blog->alt }}" />
                  </div>
                  <div class="blog-info">
                    <div class="blog-meta">
                      <div class="blog-meta-left">
                        <ul>
                          <li><i class="far fa-newspaper"></i><a href="#">{{ $blog->category->name ?? 'Unknown' }}</a></li>
                          <li><i class="far fa-comments"></i>3.2k Comments</li>
                         <li><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($blog->created_at)->format('M j, Y') }}</li>

                        </ul>
                      </div>
                      <div class="blog-meta-right">
                        <a href="#" class="share-link"><i class="far fa-share-alt"></i>Share</a>
                      </div>
                    </div>
                    <div class="blog-details">
                      <h3 class="blog-details-title mb-20">{{ $blog->title }}</h3>
                      
                      {!! $blog->description !!}
                      
                      <hr />
                     @php
                    $tags = json_decode($blog->tags, true);
                @endphp
                
                @if(!empty($tags))
                <div class="blog-details-tag pb-20">
                    <h5>Tags :</h5>
                    <ul>
                        @foreach($tags as $tag)
                            <li><a href="{{ route('front.blog.tag', $tag) }}">{{ $tag }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif

                    </div>
                 
                  </div>
                  <div class="blog-comment">
                    <h3>Comments ({{ $blogComment->count() }})</h3>
                    <div class="blog-comment-wrap"> 
                            @if($blogComment->isEmpty())
                                <p class="text-muted mt-3">No comments yet. Be the first to comment!</p>
                            @else
                      @foreach($blogComment as $comment)
                      <div class="blog-comment-item mt-3">
                         <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                        	 width="75px" height="75px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve">
                        <path fill="#CCCCCC" d="M48.35,50.783l0.254,0.305c-4.997,4.488-11.608,7.222-18.842,7.222s-13.833-2.721-18.83-7.196l0.28-0.331
                        	c0,0,3.293-2.619,7.171-3.585c3.878-0.966,5.632-3.687,5.632-3.687v-4.755c0,0-2.823-3.776-2.428-6.395c0,0-3.496-2.327-1.068-5.721
                        	c0,0-5.62-16.134,8.633-16.299c3.611-0.038,5.403,2.708,5.403,2.708c9.65-0.966,4.488,13.591,4.488,13.591
                        	c2.428,3.395-1.068,5.721-1.068,5.721c0.394,2.619-2.428,6.395-2.428,6.395v4.755c0,0,1.755,2.721,5.632,3.687
                        	C45.057,48.164,48.35,50.783,48.35,50.783z"/>
                        <path fill="none" stroke="#555555" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="
                        	M48.35,50.783c0,0-3.293-2.619-7.171-3.585c-3.878-0.966-5.632-3.687-5.632-3.687v-4.755c0,0,2.823-3.776,2.428-6.395
                        	c0,0,3.496-2.327,1.068-5.721c0,0,5.162-14.558-4.488-13.591c0,0-1.793-2.746-5.403-2.708c-14.253,0.165-8.633,16.299-8.633,16.299
                        	c-2.428,3.395,1.068,5.721,1.068,5.721c-0.394,2.619,2.428,6.395,2.428,6.395v4.755c0,0-1.755,2.721-5.632,3.687
                        	c-3.878,0.966-7.171,3.585-7.171,3.585"/>
                        <path fill="none" stroke="#555555" stroke-width="3" stroke-miterlimit="10" d="M10.932,51.113
                        	C5.16,45.939,1.524,38.425,1.524,30.071c0-15.6,12.638-28.238,28.238-28.238C45.349,1.833,58,14.471,58,30.071
                        	c0,8.353-3.624,15.854-9.396,21.016c-4.997,4.488-11.608,7.222-18.842,7.222S15.929,55.589,10.932,51.113z"/>
                        </svg>
                        <div class="blog-comment-content">
                          <h5>{{ $comment->name }}</h5>
                          <span><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($comment->created_at)->format('M j, Y') }} </span>
                          <p>
                            {{ $comment->comment }}
                          </p>
                           
                        </div>
                      </div>
                      @endforeach
                      @endif
                    </div>
                    <div class="blog-comment-form"  id="comments">
                      <h3>Leave A Comment</h3>
                      <form action="{{ route('front.blog.commentAdd', $blog->id) }}" method="POST">
                          @csrf
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <div class="form-icon">
                                <i class="far fa-user-tie"></i>
                                <input type="text" class="form-control @error('name') is-invalid @enderror  " name="name" placeholder="Your Name*" value="{{ old('name') }}" required />
                                 @error('name') 
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <div class="form-icon">
                                <i class="far fa-envelope"></i> 
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Your Email*" required />
                                 @error('email') 
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="form-icon">
                                <i class="far fa-pen"></i>
                                <textarea
                                  name="comment"
                                  cols="30"
                                  rows="5"
                                  class="form-control @error('comment') is-invalid @enderror"
                                  placeholder="Your Comment*"
                                  value="{{ old('comment') }}"
                                  required
                                ></textarea>
                                @error('comment') 
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                            </div>
                            @if(session('success'))
                                    <div class="alert alert-success mt-2">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            <button type="submit" class="theme-btn">Post Comment <i class="far fa-paper-plane"></i></button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <aside class="blog-sidebar">
                <!-- search-->
                <div class="widget search">
                  <h5 class="widget-title">Search</h5>
                  <div class="search-form">
                    <form action="{{ route('front.blog.search') }}" method="GET">
                       
                      <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Search Here..." />
                        <button type="submit"><i class="far fa-search"></i></button>
                      </div>
                    </form>
                  </div>
                </div>

                <!-- category -->
                  @if($blogCategory->isNotEmpty())
                <div class="widget category">
                  <h5 class="widget-title">Category</h5>
                  <div class="category-list">
                       
                @foreach($blogCategory as $blogCat)
                    <a href="{{ route('front.blog.category' , $blogCat->slug ) }}">
                        <i class="far fa-arrow-right"></i>
                        {{ $blogCat->name }} <span>({{ $blogCat->blogs_count }})</span>
                    </a>
                @endforeach
                </div>

                </div>
                @endif

                <!-- recent post -->
                @if($recentBlogs->isNotEmpty())
                <div class="widget recent-post">
                  <h5 class="widget-title">Recent Post</h5>
                  
                  @foreach($recentBlogs as $recentBlog)
                  <div class="recent-post-item">
                    <div class="recent-post-img">
                      <a href="{{ route('front.blog-single' , $recentBlog->slug ) }}"><img src="{{ asset('assets/front/images/blog/'.$recentBlog->image) }}" alt="{{ $recentBlog->alt }}" /></a>
                    </div>
                    <div class="recent-post-info">
                      <h6><a href="{{ route('front.blog-single' , $recentBlog->slug ) }}">{{ $recentBlog->alt }}</a></h6>
                      <span><i class="far fa-clock"></i>{{ \Carbon\Carbon::parse($recentBlog->created_at)->format('M j, Y') }}</span>
                    </div>
                  </div>
                  @endforeach
                </div>
                @endif
                <!-- social share -->
                <div class="widget social">
                  <h5 class="widget-title">Follow Us</h5>
                  <div class="social-link">
                       @if(!empty($gs->facebook))
                    <a target="_blank" href="{{ $gs->facebook }}"><i class="fab fa-facebook-f"></i></a>
                    @endif
                     @if(!empty($gs->instagram))
                    <a target="_blank" href="{{ $gs->instagram }}"><i class="fab fa-instagram"></i></a>
                    @endif
                     @if(!empty($gs->twitter))
                    <a target="_blank" href="{{ $gs->twitter }}"><i class="fab fa-x-twitter"></i></a>
                    @endif
                     @if(!empty($gs->linkedin))
                    <a target="_blank" href="{{ $gs->linkedin }}"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                     
                  </div>
                </div>

                <!-- Tags -->
                  
                
                     @php
                        $allTags = [];
                    
                        foreach($allBlog as $blog){
                            foreach(json_decode($blog->tags) as $tag){
                                $allTags[] = $tag;
                            }
                        }
                    
                        $uniqueTags = array_unique($allTags);
                    @endphp
                    <div class="widget tag">
                  <h5 class="widget-title">Popular Tags</h5>
                  <div class="tag-list">
                   @if(!empty($uniqueTags))
                    
                    @foreach($uniqueTags as $tag)
                        <a href="{{ route('front.blog.tag' , $tag ) }}">{{ $tag }}</a>
                    @endforeach

                  </div>
                </div>
                
                @endif
              </aside>
            </div>
          </div>
        </div>
      </div>
      <!-- blog single end -->
    </main>
 
 @endsection