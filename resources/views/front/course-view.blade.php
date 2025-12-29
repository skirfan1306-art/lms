@extends('front.layout.app')

@section('title')
Course View
@endsection

@section('main') 
 <main class="main mb-3">
      <div class="course-resume-wrap">
        <div class="container-fluid">
          <div class="row g-4 flex-column-reverse flex-lg-row">
            <div class="col-lg-4">
              <!-- course-resume-sidebar -->
               <div class="course-single-tab">
                  <ul class="nav nav-underline">
                    <li class="nav-item">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#course-tab1" type="button">Description</button>
                    </li>
                    <li class="nav-item">
                      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#course-tab2" type="button">Curriculum</button>
                    </li>
                    @if(!empty($course->instructor))
                    <li class="nav-item">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#course-tab3" type="button">Instructor</button>
                    </li>
                    @endif
                    <li class="nav-item">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#course-tab4" type="button">Review</button>
                    </li>
                  </ul>

                  <div class="tab-content">
                    <!-- tab 1 -->
                    <div class="tab-pane fade" id="course-tab1">
                      <div class="course-details mt-4">
                        {!! $course->description !!}
                      </div>
                    </div>

                    <!-- tab 2 -->
                    <div class="tab-pane fade active show" id="course-tab2">
                      <div class="course-curriculum mt-4">
                        <div class="accordion accordion-flush" id="course-accordion">
                        @php
                            $purchased = auth()->check() &&
                            \App\Models\CourseOrder::where('user_id', auth()->id())->where('course_id', $course->id)->exists();
                        @endphp

                        @foreach($course->syllabus as $data)
                        @if($data->lesson->count() != 0)
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#syllabus{{ $loop->iteration }}">
                                {{ $data->name }}
                              </button>
                            </h2>
                            <div id="syllabus{{ $loop->iteration }}" class="accordion-collapse collapse {{ $loop->iteration == 1 ? 'show' : '' }}" data-bs-parent="#course-accordion">
                              <div class="accordion-body">
                                @foreach($data->lesson as $lesson)
                                <div class="curriculum-item {{ $purchased ? 'unlock' : '' }}"  data-lesson-id="{{ $lesson->id }}">
                                  <div class="left">
                                    <h6>
                                    @switch($lesson->file_type)
                                            @case('video')
                                            <i class="fad fa-play-circle"></i> 
                                                <span>Video:</span>
                                                @break
                                            @case('mcq')
                                            <i class="fad fa-file-alt"></i> 
                                                <span>MCQ:</span>
                                                @break
                                            @case('file')
                                            <i class="fad fa-file-alt"></i> 
                                                <span>File:</span>
                                                @break
                                            @default
                                            <i class="fad fa-check-circle"></i> 
                                                <span>Unknown:</span>
                                        @endswitch
                                        
                                        {{ $lesson->name }}</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">
                                        @if($lesson->file_type == 'mcq')
                                            {{ \App\Models\Mcq::where('lesson_id', $lesson->id)->count() }}
                                        @else
                                            12:50
                                        @endif
                                    </span>

                                    <span class="lock">
                                    @if($purchased)
                                        <i class="fad fa-unlock"></i>
                                    @else
                                        <i class="fad fa-lock"></i>
                                    @endif
                                    </span>

                                  </div>
                                </div>
                                @endforeach
                                
                              </div>
                            </div>
                          </div>
                        @endif
                        @endforeach
                        </div>
                      </div>
                    </div>

                    <!-- tab 3 -->
                    <div class="tab-pane fade" id="course-tab3">
                      <div class="course-instructor mt-4">
                        <div class="instructor-img">
                        @if(!empty($course->instructor->image))
                          <img src="{{ asset('assets/front/images/instructor/'.$course->instructor->image) }}" alt="{{ $course->instructor->name }}" />
                        @else
                          <img src="{{ asset('assets/front/images/users/user-dummy-img.jpg') }}" alt="{{ $course->instructor->name ?? '' }}" />
                        @endif
                        </div>
                        <div class="instructor-info">
                          <h4>{{ $course->instructor->name ?? '' }}</h4>
                          <div class="instructor-info-wrap">
                            <div class="rating">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <span>(4.5)</span>
                            </div>
                            <span class="course"><i class="fad fa-book-open"></i> 15 Courses</span>
                            <span class="enrolled"><i class="fad fa-user-friends"></i> 1.5k Enrolled</span>
                          </div>
                          <p>
                            There are many variations of passages orem psum available but the majority have suffered alteration in some
                            form, by injected humour.
                          </p>
                        </div>
                      </div>
                    </div>

                    <!-- tab 4 -->
                    <div class="tab-pane fade" id="course-tab4">
                      <div class="course-review">
                        <div class="review-wrap mt-4">
                          <!-- review-rating -->
                          <div class="review-rating">
                            <div class="rating-count">
                              <h2>4.5</h2>
                              <div class="rating-star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                              </div>
                              <p>15.5k Students Review</p>
                            </div>
                            <div class="rating-range">
                              <div class="rating-range-item">
                                <div class="rating-range-star">
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                </div>
                                <div class="rating-range-bar">
                                  <div class="progress">
                                    <div class="progress-width" style="width: 90%"></div>
                                  </div>
                                </div>
                                <div class="rating-range-percentage">
                                  <span>90%</span>
                                </div>
                              </div>
                              <div class="rating-range-item">
                                <div class="rating-range-star">
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="far fa-star"></i>
                                </div>
                                <div class="rating-range-bar">
                                  <div class="progress">
                                    <div class="progress-width" style="width: 80%"></div>
                                  </div>
                                </div>
                                <div class="rating-range-percentage">
                                  <span>80%</span>
                                </div>
                              </div>
                              <div class="rating-range-item">
                                <div class="rating-range-star">
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                </div>
                                <div class="rating-range-bar">
                                  <div class="progress">
                                    <div class="progress-width" style="width: 59%"></div>
                                  </div>
                                </div>
                                <div class="rating-range-percentage">
                                  <span>59%</span>
                                </div>
                              </div>
                              <div class="rating-range-item">
                                <div class="rating-range-star">
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                </div>
                                <div class="rating-range-bar">
                                  <div class="progress">
                                    <div class="progress-width" style="width: 70%"></div>
                                  </div>
                                </div>
                                <div class="rating-range-percentage">
                                  <span>70%</span>
                                </div>
                              </div>
                              <div class="rating-range-item">
                                <div class="rating-range-star">
                                  <i class="fas fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                </div>
                                <div class="rating-range-bar">
                                  <div class="progress">
                                    <div class="progress-width" style="width: 49%"></div>
                                  </div>
                                </div>
                                <div class="rating-range-percentage">
                                  <span>49%</span>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- review-content -->
                          <div class="review-content">
                            <h5 class="title">Reviews (1,500)</h5>
                            <div class="review-item">
                              <div class="review-author">
                                <img src="/assets/front/img/instructor/rev-1.png" alt="" />
                                <div class="info">
                                  <div>
                                    <h6>Erich T. Genao</h6>
                                    <span><i class="far fa-clock"></i> 1 day ago</span>
                                  </div>
                                  <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                  </div>
                                </div>
                              </div>
                              <p>
                                There are many variations of passages available but the majority have suffered alteration in some form by
                                injected humour randomised words. It is a long established fact that reader will be distracted by the
                                readable content of web page editors now use page when looking at its layout.
                              </p>
                            </div>
                            <div class="review-item">
                              <div class="review-author">
                                <img src="/assets/front/img/instructor/rev-2.png" alt="" />
                                <div class="info">
                                  <div>
                                    <h6>Erich T. Genao</h6>
                                    <span><i class="far fa-clock"></i> 1 day ago</span>
                                  </div>
                                  <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                  </div>
                                </div>
                              </div>
                              <p>
                                There are many variations of passages available but the majority have suffered alteration in some form by
                                injected humour randomised words. It is a long established fact that reader will be distracted by the
                                readable content of web page editors now use page when looking at its layout.
                              </p>
                            </div>
                            <div class="review-item">
                              <div class="review-author">
                                <img src="/assets/front/img/instructor/rev-1.png" alt="" />
                                <div class="info">
                                  <div>
                                    <h6>Erich T. Genao</h6>
                                    <span><i class="far fa-clock"></i> 1 day ago</span>
                                  </div>
                                  <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                  </div>
                                </div>
                              </div>
                              <p>
                                There are many variations of passages available but the majority have suffered alteration in some form by
                                injected humour randomised words. It is a long established fact that reader will be distracted by the
                                readable content of web page editors now use page when looking at its layout.
                              </p>
                            </div>
                            <div class="text-center mt-4">
                              <a href="#" class="theme-btn"> <span class="fas fa-sync-alt"></span> Load More</a>
                            </div>
                          </div>

                          <!-- review-form -->
                          <div class="review-form">
                            <h5>Leave A Review</h5>
                            <form action="#">
                              <div class="form-group">
                                <label class="form-label">Your Rating</label>
                                <select class="form-select">
                                  <option value="">Choose Your Rating</option>
                                  <option value="5">5 Stars</option>
                                  <option value="4">4 Stars</option>
                                  <option value="3">3 Stars</option>
                                  <option value="2">2 Stars</option>
                                  <option value="1">1 Star</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label class="form-label">Your Review</label>
                                <textarea class="form-control" cols="30" rows="5" placeholder="Write your review"></textarea>
                              </div>
                              <button class="theme-btn" type="button">Post Your Review<i class="far fa-arrow-right"></i></button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-lg-8">
              <!-- course-resume-content -->
              <div class="course-resume-content">
                <!-- course-resume-video -->
                <div class="course-resume-video">
                 <div class="video-area" 
                style="background-image: url({{ asset('assets/front/images/course/' . $course->image) }});background-repeat:no-repeat;background-size:cover;height:750px">
                  <div class="row">
                    <div class="col-lg-12">
                         
<style>
  .video-wrap {
      position: relative;
      width: 100%; 
      margin: auto;
  }
  
  .video-wrap iframe {
      width: 100%;
      height: 750px;
      border: none;
      border-radius:25px;
      display:none;
  }
    
  .hide-icon {
      position: absolute;
      top: 0;
      right: 0;
      width: 70px;  
      height: 70px;
      background: transparent; 
      z-index: 99;
  }
</style>


<div class="video-wrap">
    <!--<div class="hide-icon"></div>-->
    <iframe id="googleVideoPlayer" allow="autoplay; fullscreen" allowfullscreen webkitallowfullscreen mozallowfullscreen >
    </iframe> 
    
    <iframe id="youtubeVideoPlayer" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    
</div>

                      
                     
                    </div>
                  </div>
                </div>
                </div> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>


@endsection
@section('scripts')
<script>
$(document).on('click', '.curriculum-item', function () {

    let lessonId = $(this).data('lesson-id');

    $('#youtubeVideoPlayer').hide().attr('src', '');
    $('#googleVideoPlayer').hide().attr('src', '');

    $.ajax({
        url: `/lesson/video/${lessonId}`,
        method: 'GET',

        success: function (res) {

            if (res.redirect) {
                window.location.href = res.redirect;
                return;
            }
            
            $('.video-area').css('background-image', 'none');

            if (res.type === 'youtube') {
                $('#youtubeVideoPlayer')
                    .attr('src', res.url)
                    .show();
            } 
            else if (res.type === 'google') {
                $('#googleVideoPlayer')
                    .attr('src', res.url)
                    .show();
            }
        },

        error: function (xhr) {
            let msg = xhr.responseJSON?.message || 'Something went wrong';

            if (xhr.status === 401) {
                ErrorAlert(msg);
                window.location.href = '/login';
                return;
            }

            ErrorAlert(msg);
        }
    });
});


$('.curriculum-item.unlock:first-child').trigger('click');
</script>



@endsection