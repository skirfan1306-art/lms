<style>
.nav-link,
.navbar-menu,
.navbar-brand-box,
.menu-dropdown{
    background: #3B2AA8 !important;
}

</style>

<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="/" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/logo/' . $gs->footer_logo) }}" alt="" style="width: 75%">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/logo/' . $gs->footer_logo) }}" alt="" style="width: 75%">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="/" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/logo/' . $gs->footer_logo) }}" alt="" style="width: 75%">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/logo/' . $gs->footer_logo) }}" alt="" style="width: 75%">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>
    
            <div class="dropdown sidebar-user m-1 rounded">
                <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-flex align-items-center gap-2">
                        <img class="rounded header-profile-user" src="{{ asset('assets/admin/images/users/user-dummy-img.jpg') }}" alt="Header Avatar">
                        <span class="text-start">
                            <span class="d-block fw-medium sidebar-user-name-text">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
                            <span class="d-block fs-14 sidebar-user-name-sub-text"><i class="ri ri-circle-fill fs-10 text-success align-baseline"></i> <span class="align-middle">Online</span></span>
                        </span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <h6 class="dropdown-header">Welcome {{ Auth::guard('admin')->user()->name ?? 'Admin' }}!</h6>
                    <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                    <a class="dropdown-item" href="apps-chat.html"><i class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Messages</span></a>
                    <a class="dropdown-item" href="apps-tasks-kanban.html"><i class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Taskboard</span></a>
                    <a class="dropdown-item" href="pages-faqs.html"><i class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Help</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Balance : <b>$5971.67</b></span></a>
                    <a class="dropdown-item" href="pages-profile-settings.html"><span class="badge bg-success-subtle text-success mt-1 float-end">New</span><i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Settings</span></a>
                    <a class="dropdown-item" href="auth-lockscreen-basic.html"><i class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Lock screen</span></a>
                    <a class="dropdown-item" href="auth-logout-basic.html"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                </div>
            </div>
            <div id="scrollbar">
                <div class="container-fluid">


                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Home</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarDashboards">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('instructor.dashboard') }}" class="nav-link" data-key="t-analytics"> Dashboard </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/" class="nav-link" data-key="t-crm"> Website </a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </li>



                        <li class="nav-item">
                            @php
                                $courseRoutes = ['instructor.subcategory','instructor.category','instructor.tag', 'instructor.course*', 'instructor.courses'];
                            @endphp
                            <a class="nav-link menu-link {{ request()->routeIs($courseRoutes) ? 'active' : '' }}" href="#course" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="category">
                                <i class="ri-dashboard-2-line"></i> <span>Course</span>
                            </a>
                            <div class="collapse menu-dropdown {{ request()->routeIs($courseRoutes) ? 'show' : '' }}" id="course">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('instructor.category') }}" class="nav-link {{ request()->routeIs('instructor.category') ? 'active' : '' }}"> Category </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('instructor.subcategory') }}" class="nav-link {{ request()->routeIs('instructor.subcategory') ? 'active' : '' }}"> Subcategory </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('instructor.tag') }}" class="nav-link {{ request()->routeIs('instructor.tag') ? 'active' : '' }}"> Tag </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('instructor.course.add') }}" class="nav-link {{ request()->routeIs('instructor.course.add') ? 'active' : '' }}"> Create New </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('instructor.courses') }}" class="nav-link {{ request()->routeIs('instructor.courses') ? 'active' : '' }}"> My Courses </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('instructor.logout') ? 'active' : '' }}" href="{{ route('instructor.logout') }}">
                                <i class="ri-honour-line"></i> <span>Logout</span>
                            </a>
                        </li>


                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>