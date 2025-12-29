@extends('front.layout.app')

@section('title')
Index
@endsection

@section('main') 


    <main class="main">
      <!-- breadcrumb -->
      <div class="site-breadcrumb" style="background: url(/assets/front/img/breadcrumb/01.png)">
        <div class="container">
          <h2 class="breadcrumb-title">Courses</h2>
          <ul class="breadcrumb-menu">
            <li><a href="{{ route('front.home') }}">Home</a></li>
            <li class="active">Courses</li>
          </ul>
        </div>
      </div>
      <!-- breadcrumb end -->

      <!-- course-area -->
      <div class="course-area py-120">
        <div class="container">
          <div class="row g-4">
            <div class="col-lg-4 col-xl-3">
              <div class="course-sidebar">
                <!-- search -->
                <div class="widget mb-4">
                  <h4 class="title">Search Courses</h4>
                  <div class="search-form">
                    <form action="" method="GET">
                      <div class="form-group mb-0">
                        <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') }}" />
                        <button type="search"><i class="far fa-search"></i></button>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- category -->
                <div class="widget mb-4">
                  <h4 class="title">Category</h4>
                  <div class="category">
                    <ul>
                        @foreach ($category as $c)
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cat{{ $c->id }}" value="{{ $c->name }}" />
                                <label class="form-check-label" for="cat{{ $c->id }}">
                                    {{ $c->name }} ({{ $c->course_count }})
                                </label>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                  </div>
                </div>
                <!-- level -->
                <div class="widget mb-4">
                  <h4 class="title">Course Tag</h4>
                  <div class="level">
                    <ul>
                        @foreach ($tag as $t)
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="tag{{ $t->id }}" value="{{ $t->name }}" />
                                <label class="form-check-label" for="tag{{ $t->id }}">
                                    {{ $t->name }} ({{ $t->tag_count }})
                                </label>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                  </div>
                </div>
                <!-- price -->
                <div class="widget mb-4">
                  <h4 class="title">Course Price</h4>
                  <div class="price">
                    <ul>
                      <li>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="price" id="price1" value="all" />
                          <label class="form-check-label" for="price1"> All</label>
                        </div>
                      </li>
                      <li>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="price" id="price2" value="free" />
                          <label class="form-check-label" for="price2"> Free</label>
                        </div>
                      </li>
                      <li>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="price" id="price3" value="paid" />
                          <label class="form-check-label" for="price3"> Paid</label>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>

              </div>
            </div>
            <div class="col-lg-8 col-xl-9">
              <div class="course-sort">
                <div class="course-showing">Showing 1-10 of 50 Results</div>
                <div class="col-12 col-md-5 col-lg-4 col-xl-3">
                  <select class="courseSortSelect">
                    <option value="default">Sort By Default</option>
                    <option value="latest">Sort By Latest</option>
                    <option value="low">Sort By Low Price</option>
                    <option value="high">Sort By High Price</option>
                  </select>
                </div>
              </div>
              <div class="row g-4 itemContainer">
                @foreach($courses as $course)
                
                @php
                    if($course->tag == 'New'){
                        $tagClass = 'c1';
                    }elseif($course->tag == 'Premium'){
                        $tagClass = 'c2';
                    }else{
                        $tagClass = 'c3';
                    }
                @endphp
                  
                <div class="col-md-6 col-lg-6 col-xl-4 items" data-cat="{{ $course->category->name }}" data-level="{{ $course->tag }}" data-ptype="{{ $course->price }}" data-pamount="{{ $course->sale_price }}" data-date="{{ $course->created_at }}">
                  <div class="course-item">
                    <span class="course-tag {{ $tagClass }}">{{ $course->tag }}</span>
                    <div class="course-img">
                      <a href="{{ route('front.course-single', $course->slug) }}"><img src="{{ asset('assets/front/images/course/' . $course->image) }}" alt="{{ $course->name }}" /></a>
                    </div>
                    <div class="course-content">
                      <div class="course-meta">
                        <span class="category c1">{{ $course->category->name }}</span>
                        
                        @if($course->reviews_count > 0)
                        <div class="rating">
                          <i class="fas fa-star"></i>
                          <span>{{ $course->reviews_count }}</span>
                        </div>
                        @endif
                        
                      </div>
                      <h4 class="course-title"><a href="{{ route('front.course-single', $course->slug) }}">{{ Str::limit($course->name, 50, '...') }}</a></h4>
                      <div class="course-info">
                        <ul>
                          <li class="lecture"><i class="fad fa-book-open-reader"></i>64 Lectures</li>
                          <li class="duration"><i class="fad fa-clock-rotate-left"></i>30 Hours</li>
                        </ul>
                      </div>
                      <div class="course-bottom">
                        <a href="#">
                          <div class="course-instructor">
                            <img src="/assets/front/img/course/ins-1.jpg" alt="" />
                            <h6>Sara Wood</h6>
                          </div>
                        </a>
                        <div class="course-price">
                            @if($course->price == 'free')
                                <button class="btn-sm theme-btn p-0 ps-3 pe-3">Free</button>
                            @else
                                <del>${{ $course->old_price }}</del>
                                <span>${{ $course->sale_price }}</span>
                            @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                @endforeach
              </div>
              <!-- pagination -->
              <div class="pagination-area">
                <div aria-label="Page navigation example">
                  <ul class="pagination">
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
                      </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              
              
            </div>
          </div>
        </div>
      </div>
      <!-- course-area end -->
    </main>

@endsection

@section('scripts')

<script>

$(function(){

  // --- CONFIG ---
  var itemsPerPage = 3;
  var $itemsContainer = $('.itemContainer'); 
  var $itemSelector = '.items';

  var $allItems = $itemsContainer.find($itemSelector);
  var $searchInput = $('input[name="search"]');
  var $sortSelect = $('.courseSortSelect');
  var $showingText = $('.course-showing');
  var $paginationArea = $('.pagination-area .pagination');
  
  var state = { page: 1 };

  function cleanLabelText(text){
    if(!text) return '';
    return text.replace(/\s*\(\s*\d+\s*\)\s*$/,'').toLowerCase().trim();
  }

  function ensureInputValues(){
    $('.category .form-check').each(function(){
      var $input = $(this).find('input[type="checkbox"]');
      if($input.length && (!$input.val() || $input.val() === 'on')){
        var txt = cleanLabelText($(this).find('label').text());
        $input.val(txt);
      }
    });
    $('.level .form-check').each(function(){
      var $input = $(this).find('input[type="checkbox"]');
      if($input.length && (!$input.val() || $input.val() === 'on')){
        var txt = cleanLabelText($(this).find('label').text());
        $input.val(txt);
      }
    });
    $('.price .form-check').each(function(i){
      var $r = $(this).find('input[type="radio"]');
      if($r.length && (!$r.val() || $r.val() === 'on')){
        var txt = $(this).find('label').text().toLowerCase().trim();
        if(txt.indexOf('free') !== -1) $r.val('free');
        else if(txt.indexOf('paid') !== -1) $r.val('paid');
        else $r.val('all');
      }
    });
  }

  function getSelectedCategories(){
    var arr = [];
    $('.category input[type="checkbox"]').each(function(){
      if($(this).prop('checked')){
        arr.push( ($(this).val() || '').toString().toLowerCase().trim() );
      }
    });
    return arr;
  }

  function getSelectedLevels(){
    var arr = [];
    $('.level input[type="checkbox"]').each(function(){
      if($(this).prop('checked')){
        arr.push( ($(this).val() || '').toString().toLowerCase().trim() );
      }
    });
    return arr;
  }

  function getSelectedPriceType(){
    var sel = $('.price input[type="radio"]:checked').val();
    if(!sel) return 'all';
    sel = sel.toString().toLowerCase().trim();
    if(sel.indexOf('free') !== -1) return 'free';
    if(sel.indexOf('paid') !== -1) return 'paid';
    return 'all';
  }

  function getSearchTerm(){
    return ($searchInput.val() || '').toLowerCase().trim();
  }

  function parseDateAttr(str){
    if(!str) return NaN;
    // try ISO first
    var d = Date.parse(str);
    if(!isNaN(d)) return d;
    var withT = str.replace(' ', 'T');
    d = Date.parse(withT);
    if(!isNaN(d)) return d;
    try {
      return new Date(str).getTime();
    } catch(e) {
      return NaN;
    }
  }

  function filterAndPaginate(){
    var cats = getSelectedCategories();
    var levels = getSelectedLevels();
    var priceType = getSelectedPriceType();
    var search = getSearchTerm();
    var sortBy = ($sortSelect.val() || 'default').toString();
    var page = state.page || 1;
    
    var filtered = [];

    var orderMap = {};
    $allItems.each(function(i){
      orderMap[$(this).get(0)] = i;
    });

    $allItems.each(function(){
      var $col = $(this);
      var itemCat = ( ($col.attr('data-cat') || '') ).toString().toLowerCase().trim();
      var itemLevel = ( ($col.attr('data-level') || '') ).toString().toLowerCase().trim();
      var itemPType = ( ($col.attr('data-ptype') || '') ).toString().toLowerCase().trim();
      var itemPAmountRaw = $col.attr('data-pamount') || $col.attr('data-p-amount') || '';
      var itemPAmount = parseFloat((itemPAmountRaw+'').replace(/[^0-9.\-]/g,'')); // strip non-numeric
      if(isNaN(itemPAmount)) itemPAmount = 0;

      var itemDateRaw = $col.attr('data-date') || $col.attr('data-created') || '';
      var itemDateTs = parseDateAttr(itemDateRaw); // timestamp or NaN

      itemCat = cleanLabelText(itemCat);
      itemLevel = cleanLabelText(itemLevel);

      var title = ($col.find('.course-title').text() || '').toLowerCase();
      var instructor = ($col.find('.course-instructor h6').text() || '').toLowerCase();

      if(cats.length > 0){
        if(cats.indexOf(itemCat) === -1) return;
      }
      
      if(levels.length > 0){
        if(levels.indexOf(itemLevel) === -1) return;
      }

      if(priceType === 'free'){
        if(!(itemPType === 'free' || itemPAmount === 0)) return;
      } else if(priceType === 'paid'){
        if(itemPType === 'free' || itemPAmount === 0) return;
      }

      if(search){
        var hay = (title + ' ' + instructor + ' ' + itemCat + ' ' + itemLevel).toLowerCase();
        if(hay.indexOf(search) === -1) return;
      }

      filtered.push({
        $el: $col,
        price: itemPAmount,
        dateTs: isNaN(itemDateTs) ? null : itemDateTs,
        order: orderMap[$col.get(0)] || 0
      });

    }); // end each item

    if(sortBy === 'low'){
      filtered.sort(function(a,b){
        return (a.price || 0) - (b.price || 0);
      });
    } else if(sortBy === 'high'){
      filtered.sort(function(a,b){
        return (b.price || 0) - (a.price || 0);
      });
    } else if(sortBy === 'latest'){
      filtered.sort(function(a,b){
        var at = a.dateTs, bt = b.dateTs;
        if(at === null && bt === null) return a.order - b.order;
        if(at === null) return 1; // items without date go after
        if(bt === null) return -1;
        return bt - at; // newest first
      });
    } else {
      filtered.sort(function(a,b){ return a.order - b.order; });
    }

    $allItems.hide();

    // Pagination
    var total = filtered.length;
    var totalPages = Math.max(1, Math.ceil(total / itemsPerPage));
    if(page > totalPages) page = totalPages;
    if(page < 1) page = 1;
    state.page = page;

    var start = (page - 1) * itemsPerPage;
    var end = Math.min(start + itemsPerPage, total);

    for(var i=0;i<filtered.length;i++){
      var obj = filtered[i];
      if(i >= start && i < end) obj.$el.show();
      else obj.$el.hide();
    }

    // Update showing text
    if(total === 0){
      $showingText.text('Showing 0 of 0 Results');
    } else {
      $showingText.text('Showing ' + (start + 1) + ' - ' + end + ' of ' + total + ' Results');
    }

    // Render pagination
    renderPagination(totalPages, page);

  } // end filterAndPaginate

  function renderPagination(totalPages, currentPage){
    $paginationArea.empty();
    var $prev = $('<li class="page-item ' + (currentPage === 1 ? 'disabled' : '') + '"><a class="page-link" href="#" data-page="prev" aria-label="Previous"><span aria-hidden="true"><i class="fas fa-arrow-left"></i></span></a></li>');
    $paginationArea.append($prev);

    var maxButtons = 7;
    var start = 1, end = totalPages;
    if(totalPages > maxButtons){
      var half = Math.floor(maxButtons/2);
      start = Math.max(1, currentPage - half);
      end = start + maxButtons - 1;
      if(end > totalPages){
        end = totalPages;
        start = Math.max(1, end - maxButtons + 1);
      }
    }

    if(start > 1){
      $paginationArea.append('<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>');
      if(start > 2) $paginationArea.append('<li class="page-item disabled"><span class="page-link">...</span></li>');
    }

    for(var p = start; p <= end; p++){
      var active = p === currentPage ? ' active' : '';
      $paginationArea.append('<li class="page-item' + active + '"><a class="page-link" href="#" data-page="' + p + '">' + p + '</a></li>');
    }

    if(end < totalPages){
      if(end < totalPages - 1) $paginationArea.append('<li class="page-item disabled"><span class="page-link">...</span></li>');
      $paginationArea.append('<li class="page-item"><a class="page-link" href="#" data-page="' + totalPages + '">' + totalPages + '</a></li>');
    }

    var $next = $('<li class="page-item ' + (currentPage === totalPages ? 'disabled' : '') + '"><a class="page-link" href="#" data-page="next" aria-label="Next"><span aria-hidden="true"><i class="fas fa-arrow-right"></i></span></a></li>');
    $paginationArea.append($next);
  }

  // Event wiring
  ensureInputValues();

  $(document).on('change', '.category input[type="checkbox"]', function(){ state.page = 1; filterAndPaginate(); });
  $(document).on('change', '.level input[type="checkbox"]', function(){ state.page = 1; filterAndPaginate(); });
  $(document).on('change', '.price input[type="radio"]', function(){ state.page = 1; filterAndPaginate(); });

  var typing;
  $searchInput.on('input', function(){ clearTimeout(typing); typing = setTimeout(function(){ state.page = 1; filterAndPaginate(); }, 250); });
  
  $('.courseSortSelect').on('change', function(){
        state.page = 1;
        filterAndPaginate();
    });

  $paginationArea.on('click', 'a.page-link', function(e){
    e.preventDefault();
    var dp = $(this).data('page');
    var cur = state.page || 1;
    if(dp === 'prev') state.page = Math.max(1, cur - 1);
    else if(dp === 'next') state.page = cur + 1;
    else {
      var pnum = parseInt(dp, 10);
      if(!isNaN(pnum)) state.page = pnum;
    }
    filterAndPaginate();
  });

  // initial run
  filterAndPaginate();

});
</script>

@endsection