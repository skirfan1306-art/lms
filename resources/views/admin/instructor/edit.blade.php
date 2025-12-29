@extends('admin.layout.app')

@section('main.content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">



            <div class="row">
                <div class="col-xxl-3">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                    
                                    <h3>Edit Instructor</h3><hr>
                                    
                                    @if($instructor->image)
                                    <img src="{{ asset('assets/front/images/instructor/'.$instructor['image']) }}" class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow">
                                    @else
                                    <img src="{{ asset('assets/front/images/users/user-dummy-img.jpg') }}" class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow">
                                    @endif
                                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                        <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                            <span class="avatar-title rounded-circle bg-light text-body material-shadow">
                                                <i class="ri-camera-fill"></i>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <h5 class="fs-16 mb-1">{{ $instructor->name }}</h5>
                                @if($instructor['status'] == '1')
                                    <label for="updateStatus" class="badge bg-success-subtle text-success text-uppercase status cursor-pointer">Active</label>
                                @elseif($instructor['status'] == '0')
                                    <label for="updateStatus" class="badge bg-danger-subtle text-danger text-uppercase status cursor-pointer">Inactive</label>
                                @else
                                    <label for="updateStatus" class="badge bg-warning-subtle text-warning text-uppercase status cursor-pointer">Pending</label>
                                @endif
                                <!--<p class="text-muted mb-0">Lead Designer / Developer</p>-->
                                
                                <form action="{{ route('admin.instructor.status') }}" method="POST" class="d-none">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $instructor['id'] }}">
                                    <input type="submit" id="updateStatus">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Portfolio</h5>
                                </div>
                                
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                    <span class="avatar-title rounded-circle fs-16 bg-primary text-white material-shadow">
                                        <i class="ri-facebook-fill"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control social" data-target="facebook" id="facebook" placeholder="www.facebook.com/instructor-123" value="{{ old('facebook', $instructor->facebook) }}">
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                    <span class="avatar-title rounded-circle fs-16 bg-info material-shadow">
                                        <i class="ri-linkedin-fill"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control social" data-target="linkedin" id="linkedin" placeholder="www.linkedin.com/in/instructor-123" value="{{ old('linkedin', $instructor->linkedin) }}">
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                    <span class="avatar-title rounded-circle fs-16 bg-dark material-shadow">
                                        <i class="ri-twitter-fill"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control social" data-target="twitter" id="twitter" placeholder="www.x.com/instructor-123" value="{{ old('twitter', $instructor->twitter) }}">
                            </div>
                            <div class="d-flex">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                    <span class="avatar-title rounded-circle fs-16 bg-danger material-shadow">
                                        <i class="ri-instagram-fill"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control social" data-target="instagram" id="instagram" placeholder="www.instagram.com/instructor-123" value="{{ old('instagram', $instructor->instagram) }}">
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
                <div class="col-xxl-9">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab" aria-selected="true">
                                        <i class="fas fa-home"></i> Personal Details
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab" aria-selected="false" tabindex="-1">
                                        <i class="far fa-user"></i> Change Password
                                    </a>
                                </li>
                                <!--<li class="nav-item" role="presentation">-->
                                <!--    <a class="nav-link" data-bs-toggle="tab" href="#experience" role="tab" aria-selected="false" tabindex="-1">-->
                                <!--        <i class="far fa-envelope"></i> Experience-->
                                <!--    </a>-->
                                <!--</li>-->
                                <!--<li class="nav-item" role="presentation">-->
                                <!--    <a class="nav-link" data-bs-toggle="tab" href="#privacy" role="tab" aria-selected="false" tabindex="-1">-->
                                <!--        <i class="far fa-envelope"></i> Privacy Policy-->
                                <!--    </a>-->
                                <!--</li>-->
                            </ul>
                        </div>
                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="personalDetails" role="tabpanel">
                                    <form action="{{ route('admin.instructor.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $instructor->id }}">
                                        <input id="profile-img-file-input" type="file" class="profile-img-file-input d-none" name="image">
                                        <!--Social Media-->
                                        <input type="hidden" name="facebook">
                                        <input type="hidden" name="linkedin">
                                        <input type="hidden" name="twitter">
                                        <input type="hidden" name="instagram">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="firstnameInput" class="form-label">Full Name</label>
                                                    <input type="text" class="form-control" id="firstnameInput" placeholder="Enter your firstname" value="{{ old('name', $instructor->name) }}" name="name">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="designation" class="form-label">Designation</label>
                                                    <input type="text" class="form-control" id="designation" placeholder="Enter your lastname" value="{{ old('designation', $instructor->designation) }}" name="designation">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="phonenumberInput" class="form-label">Phone Number</label>
                                                    <input type="text" class="form-control" id="phonenumberInput" placeholder="Enter your phone number" value="{{ old('number', $instructor->number) }}" name="number">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="emailInput" class="form-label">Email Address</label>
                                                    <input type="email" class="form-control" id="emailInput" placeholder="Enter your email" value="{{ old('email', $instructor->email) }}" name="email">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="mb-3 pb-2">
                                                    <label for="summernote" class="form-label">Description</label>
                                                    <textarea id="summernote" name="description">{{ old('description', $instructor->description ) }}</textarea>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" class="btn btn-primary">Updates</button>
                                                    <button type="button" class="btn btn-soft-success">Cancel</button>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>

                                <div class="tab-pane" id="changePassword" role="tabpanel">
                                    <form action="{{ route('admin.instructor.passupdate') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $instructor->id }}">
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <div>
                                                    <label for="newpasswordInput" class="form-label">New Password*</label>
                                                    <input type="text" class="form-control" id="newpasswordInput" placeholder="Enter new password" name="password">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div>
                                                    <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                                    <input type="password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password" name="confirm_pass">
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12 mt-3">
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-success">Change Password</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>

                                <div class="tab-pane" id="experience" role="tabpanel">
                                    <form>
                                        <div id="newlink">
                                            <div id="1">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="jobTitle" class="form-label">Job Title</label>
                                                            <input type="text" class="form-control" id="jobTitle" placeholder="Job title" value="Lead Designer / Developer">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="companyName" class="form-label">Company Name</label>
                                                            <input type="text" class="form-control" id="companyName" placeholder="Company name" value="Themesbrand">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="experienceYear" class="form-label">Experience Years</label>
                                                            <div class="row">
                                                                <div class="col-lg-5">
                                                                    <select class="form-control" data-choices="" data-choices-search-false="" name="experienceYear" id="experienceYear">
                                                                        <option value="">Select years</option>
                                                                        <option value="Choice 1">2001</option>
                                                                        <option value="Choice 2">2002</option>
                                                                        <option value="Choice 3">2003</option>
                                                                        <option value="Choice 4">2004</option>
                                                                        <option value="Choice 5">2005</option>
                                                                        <option value="Choice 6">2006</option>
                                                                        <option value="Choice 7">2007</option>
                                                                        <option value="Choice 8">2008</option>
                                                                        <option value="Choice 9">2009</option>
                                                                        <option value="Choice 10">2010</option>
                                                                        <option value="Choice 11">2011</option>
                                                                        <option value="Choice 12">2012</option>
                                                                        <option value="Choice 13">2013</option>
                                                                        <option value="Choice 14">2014</option>
                                                                        <option value="Choice 15">2015</option>
                                                                        <option value="Choice 16">2016</option>
                                                                        <option value="Choice 17" selected="">2017</option>
                                                                        <option value="Choice 18">2018</option>
                                                                        <option value="Choice 19">2019</option>
                                                                        <option value="Choice 20">2020</option>
                                                                        <option value="Choice 21">2021</option>
                                                                        <option value="Choice 22">2022</option>
                                                                    </select>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-auto align-self-center">
                                                                    to
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-lg-5">
                                                                    <select class="form-control" data-choices="" data-choices-search-false="" name="choices-single-default2">
                                                                        <option value="">Select years</option>
                                                                        <option value="Choice 1">2001</option>
                                                                        <option value="Choice 2">2002</option>
                                                                        <option value="Choice 3">2003</option>
                                                                        <option value="Choice 4">2004</option>
                                                                        <option value="Choice 5">2005</option>
                                                                        <option value="Choice 6">2006</option>
                                                                        <option value="Choice 7">2007</option>
                                                                        <option value="Choice 8">2008</option>
                                                                        <option value="Choice 9">2009</option>
                                                                        <option value="Choice 10">2010</option>
                                                                        <option value="Choice 11">2011</option>
                                                                        <option value="Choice 12">2012</option>
                                                                        <option value="Choice 13">2013</option>
                                                                        <option value="Choice 14">2014</option>
                                                                        <option value="Choice 15">2015</option>
                                                                        <option value="Choice 16">2016</option>
                                                                        <option value="Choice 17">2017</option>
                                                                        <option value="Choice 18">2018</option>
                                                                        <option value="Choice 19">2019</option>
                                                                        <option value="Choice 20" selected="">2020</option>
                                                                        <option value="Choice 21">2021</option>
                                                                        <option value="Choice 22">2022</option>
                                                                    </select>
                                                                </div>
                                                                <!--end col-->
                                                            </div>
                                                            <!--end row-->
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="jobDescription" class="form-label">Job Description</label>
                                                            <textarea class="form-control" id="jobDescription" rows="3" placeholder="Enter description">You always want to make sure that your fonts work well together and try to limit the number of fonts you use to three or less. Experiment and play around with the fonts that you already have in the software you're working with reputable font websites. </textarea>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <a class="btn btn-success" href="javascript:deleteEl(1)">Delete</a>
                                                    </div>
                                                </div>
                                                <!--end row-->
                                            </div>
                                        </div>
                                        <div id="newForm" style="display: none;">

                                        </div>
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2">
                                                <button type="submit" class="btn btn-success">Update</button>
                                                <a href="javascript:new_link()" class="btn btn-primary">Add New</a>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </form>
                                </div>
                                <!--end tab-pane-->
                                <div class="tab-pane" id="privacy" role="tabpanel">
                                    <div class="mb-4 pb-2">
                                        <h5 class="card-title text-decoration-underline mb-3">Security:</h5>
                                        <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0">
                                            <div class="flex-grow-1">
                                                <h6 class="fs-14 mb-1">Two-factor Authentication</h6>
                                                <p class="text-muted">Two-factor authentication is an enhanced security meansur. Once enabled, you'll be required to give two types of identification when you log into Google Authentication and SMS are Supported.</p>
                                            </div>
                                            <div class="flex-shrink-0 ms-sm-3">
                                                <a href="javascript:void(0);" class="btn btn-sm btn-primary">Enable Two-facor Authentication</a>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0 mt-2">
                                            <div class="flex-grow-1">
                                                <h6 class="fs-14 mb-1">Secondary Verification</h6>
                                                <p class="text-muted">The first factor is a password and the second commonly includes a text with a code sent to your smartphone, or biometrics using your fingerprint, face, or retina.</p>
                                            </div>
                                            <div class="flex-shrink-0 ms-sm-3">
                                                <a href="javascript:void(0);" class="btn btn-sm btn-primary">Set up secondary method</a>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0 mt-2">
                                            <div class="flex-grow-1">
                                                <h6 class="fs-14 mb-1">Backup Codes</h6>
                                                <p class="text-muted mb-sm-0">A backup code is automatically generated for you when you turn on two-factor authentication through your iOS or Android Twitter app. You can also generate a backup code on twitter.com.</p>
                                            </div>
                                            <div class="flex-shrink-0 ms-sm-3">
                                                <a href="javascript:void(0);" class="btn btn-sm btn-primary">Generate backup codes</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="card-title text-decoration-underline mb-3">Application Notifications:</h5>
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex">
                                                <div class="flex-grow-1">
                                                    <label for="directMessage" class="form-check-label fs-14">Direct messages</label>
                                                    <p class="text-muted">Messages from people you follow</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="directMessage" checked="">
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mt-2">
                                                <div class="flex-grow-1">
                                                    <label class="form-check-label fs-14" for="desktopNotification">
                                                        Show desktop notifications
                                                    </label>
                                                    <p class="text-muted">Choose the option you want as your default setting. Block a site: Next to "Not allowed to send notifications," click Add.</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="desktopNotification" checked="">
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mt-2">
                                                <div class="flex-grow-1">
                                                    <label class="form-check-label fs-14" for="emailNotification">
                                                        Show email notifications
                                                    </label>
                                                    <p class="text-muted"> Under Settings, choose Notifications. Under Select an account, choose the account to enable notifications for. </p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="emailNotification">
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mt-2">
                                                <div class="flex-grow-1">
                                                    <label class="form-check-label fs-14" for="chatNotification">
                                                        Show chat notifications
                                                    </label>
                                                    <p class="text-muted">To prevent duplicate mobile notifications from the Gmail and Chat apps, in settings, turn off Chat notifications.</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="chatNotification">
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mt-2">
                                                <div class="flex-grow-1">
                                                    <label class="form-check-label fs-14" for="purchaesNotification">
                                                        Show purchase notifications
                                                    </label>
                                                    <p class="text-muted">Get real-time purchase alerts to protect yourself from fraudulent charges.</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="purchaesNotification">
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h5 class="card-title text-decoration-underline mb-3">Delete This Account:</h5>
                                        <p class="text-muted">Go to the Data &amp; Privacy section of your profile Account. Scroll to "Your data &amp; privacy options." Delete your Profile Account. Follow the instructions to delete your account :</p>
                                        <div>
                                            <input type="password" class="form-control" id="passwordInput" placeholder="Enter your password" value="make@321654987" style="max-width: 265px;">
                                        </div>
                                        <div class="hstack gap-2 mt-3">
                                            <a href="javascript:void(0);" class="btn btn-soft-danger">Close &amp; Delete This Account</a>
                                            <a href="javascript:void(0);" class="btn btn-light">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                                <!--end tab-pane-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div><!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script>2025 © Velzon.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design &amp; Develop by Themesbrand
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

@endsection
@section('scripts')
<script src="{{ asset('assets/admin/js/pages/profile-setting.init.js') }}"></script>
<script>
  $(document).ready(function() {
    $('#summernote').summernote({
      placeholder: 'Write description here...',
      tabsize: 2,
      height: 300
    });
  });
  
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".social").forEach(function (input) {
        let target = input.getAttribute("data-target");
        // On load
        document.querySelector("input[name='" + target + "']").value = input.value;

        // On keyup
        input.addEventListener("keyup", function () {
            document.querySelector("input[name='" + target + "']").value = this.value;
        });
    });
});

</script>

@endsection