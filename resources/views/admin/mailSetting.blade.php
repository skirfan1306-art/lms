@extends('admin.layout.app')

@section('main.content')
<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Mail Settings</h4>
                                    
                                </div><!-- end card header -->
                                <form action="{{ route('admin.mailsetting.update') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="live-preview">
                                            <div class="row gy-4">

                                                <div class="col-md-6">
                                                    <label class="form-label">Mailer</label>
                                                    <input type="text" class="form-control" name="mailer" value="{{ $setting->mailer ?? '' }}" required>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Host</label>
                                                    <input type="text" class="form-control" name="host" value="{{ $setting->host ?? '' }}" required>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Port</label>
                                                    <input type="number" class="form-control" name="port" value="{{ $setting->port ?? '' }}" required>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Username</label>
                                                    <input type="text" class="form-control" name="username" value="{{ $setting->username ?? '' }}" required>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Password</label>
                                                    <input type="text" class="form-control" name="password" value="{{ $setting->password ?? '' }}" required>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Encryption</label>
                                                    <select class="form-control" name="encryption" required>
                                                        <option value="tls" {{ ($setting->encryption ?? '') == 'tls' ? 'selected' : '' }}>TLS</option>
                                                        <option value="ssl" {{ ($setting->encryption ?? '') == 'ssl' ? 'selected' : '' }}>SSL</option>
                                                        <option value="" {{ empty($setting->encryption) ? 'selected' : '' }}>None</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">From Address</label>
                                                    <input type="email" class="form-control" name="from_address" value="{{ $setting->from_address ?? '' }}" required>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">From Name</label>
                                                    <input type="text" class="form-control" name="from_name" value="{{ $setting->from_name ?? '' }}" required>
                                                </div>

                                            </div>
                                            <!--end row-->

                                            <div class="mt-3">
                                                <a href="{{ url()->previous() }}" class="btn btn-danger">
                                                    <i class="ri-delete-bin-5-line me-2"></i> Cancel
                                                </a>
                                                <button type="submit" class="btn btn-success">
                                                    <i class="ri-check-double-line me-2"></i> Update
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>

                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Mail Templates</h4>                                    
                                </div>
                                <div class="d-flex justify-content-between p-5">
                                    <a href="mail-templates/admin-forgot-otp" target="_blank" class="btn btn-dark bg-gradient waves-effect waves-light">Admin Forgot OTP</a>
                                    <a href="mail-templates/admin-register" target="_blank" class="btn btn-dark bg-gradient waves-effect waves-light">Admin Register</a>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->



                </div> <!-- container-fluid -->
            </div><!-- End Page-content -->

            @include('admin.layout.footer')
        </div>
@endsection