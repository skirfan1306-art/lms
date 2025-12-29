  @extends('front.layout.app')
@section('title')
Forget Password
@endsection
@section('main')

    <main class="main">
     

      <!-- user profile -->
      <div class="user-account py-70">
        <div class="container">
          <div class="row g-4">
             @include('user.layout.sidebar')
            <div class="col-lg-8 col-xl-9">
              <div class="user-wrapper"> 
                <div class="row g-4">
                  <div class="col-lg-12">
                    <div class="user-card">
                      <h4 class="title">Profile Info</h4>
                      <div class="user-form">
                        <form action="{{ route('user.profileUpdate') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" class="form-control" value="{{ Auth::user()->id }}" required />
                          <div class="row">
                              <div class="user-sidebar border-0 mb-3">
                              <div class="sidebar-top border-0 pb-0 mb-0">
                                  <div class="profile-img select-profile-img mb-0" style="width:250px;height:250px;border-radius:50%;">
                                     @if( Auth::user()->image )
                                        <img src="/assets/front/images/users/{{ Auth::user()->image }}" alt="" style="height:237px;width:237px;object-fit:cover;" />
                                        @else
                                        <img src="/assets/front/images/users/user-dummy-img.jpg" alt=""  style="height:237px;width:237px;object-fit:cover;"/>
                                        @endif
                                    <button type="button" class="profile-img-btn" style="right:20px;bottom:20px;"><i class="far fa-camera"></i></button>
                                    <input type="file" name="image" class="profile-img-file select-profile">
                                     <p class="text-danger text-center mt-3">@error('image') {{ $message }} @enderror</p>
                                  </div>
                                   
                                </div>
                                </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid  @enderror" value="{{ Auth::user()->name }}" placeholder="First Name" required />
                                <p class="text-danger">@error('name') {{ $message }} @enderror</p>
                              </div>
                            </div>
                             
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control @error('email') is-invalid  @enderror" value="{{ Auth::user()->email }}" placeholder="Email" readonly required />
                                <p class="text-danger">@error('email') {{ $message }} @enderror</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="number" class="form-control @error('number') is-invalid  @enderror" value="{{ Auth::user()->number }}" placeholder="Phone Number"  required/>
                                <p class="text-danger">@error('number') {{ $message }} @enderror</p>
                              </div>
                            </div>
                            
                          </div>
                          <button type="submit" class="theme-btn"><span class="far fa-save"></span> Save Changes</button>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="user-card">
                      <h4 class="title">Change Password</h4>
                      <div class="col-lg-12">
                        <div class="user-form">
                          <form action="{{ route('user.passwordUpdate') }}" method="post">
                              @csrf
                            <div class="row">
                                 <input type="hidden" name="id" class="form-control" value="{{ Auth::user()->id }}" required />
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label">New Password</label>
                                  <input name="password" type="password" class="form-control  @error('password') is-invalid  @enderror" placeholder="New Password" />
                                   <p class="text-danger">@error('password') {{ $message }} @enderror</p>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label">Re-Type Password</label>
                                  <input name="password_confirmation" type="password" class="form-control  @error('password_confirmation') is-invalid  @enderror" placeholder="Re-Type Password" />
                                   <p class="text-danger">@error('password_confirmation') {{ $message }} @enderror</p>
                                </div>
                              </div>
                            </div>
                            <button type="submit" class="theme-btn"><span class="far fa-key"></span> Change Password</button>
                          </form>
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
      <!-- user profile end -->
    </main>
 
   <script>
document.querySelector('.select-profile').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
    
            document.querySelector('.select-profile-img img').setAttribute('src', e.target.result);
        };

        reader.readAsDataURL(file);
    }
});
</script>

   @endsection