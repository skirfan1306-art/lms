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
                                        <a href="{{ route('admin.dashboard') }}" class="nav-link" data-key="t-analytics"> Dashboard </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/" class="nav-link" data-key="t-crm"> Website </a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </li> <!-- end Dashboard Menu -->
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs(['admin.blogs', 'admin.blog.form', 'admin.blog.edit']) ? 'active' : '' }}" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                                <i class="ri-apps-2-line"></i> <span data-key="t-apps">Blog</span>
                            </a>
                            <div class="collapse menu-dropdown {{ request()->routeIs(['admin.blogs', 'admin.blog.form', 'admin.blog.edit']) ? 'show' : '' }}" id="sidebarApps">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.blog.form') }}" class="nav-link {{ request()->routeIs('admin.blog.form') ? 'active' : '' }}" data-key="t-chat"> Create Blog </a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a href="{{ route('admin.blogs') }}" class="nav-link {{ request()->routeIs('admin.blogs') ? 'active' : '' }}" data-key="t-api-key">Blogs</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.appointment*') ? 'active' : '' }}" href="{{ route('admin.appointment') }}">
                                <i class="ri-honour-line"></i> <span>Appointments</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.contactForm') ? 'active' : '' }}" href="{{ route('admin.contactForm') }}">
                                <i class="ri-honour-line"></i> <span>Contact Form</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.subscribers') ? 'active' : '' }}" href="{{ route('admin.subscribers') }}">
                                <i class="ri-honour-line"></i> <span>Subscribers</span>
                            </a>
                        </li>

                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Products & Services</span></li>                        

                        <li class="nav-item">
                            @php
                                $productRoutes = ['admin.brand','admin.category', 'admin.product.add', 'admin.products'];
                            @endphp
                            <a class="nav-link menu-link {{ request()->routeIs($productRoutes) ? 'active' : '' }}" href="#category" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="category">
                                <i class="ri-dashboard-2-line"></i> <span>Product</span>
                            </a>
                            <div class="collapse menu-dropdown {{ request()->routeIs($productRoutes) ? 'show' : '' }}" id="category">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.brand') }}" class="nav-link {{ request()->routeIs('admin.brand') ? 'active' : '' }}"> Brand </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.category') }}" class="nav-link {{ request()->routeIs('admin.category') ? 'active' : '' }}"> Category </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.product.add') }}" class="nav-link {{ request()->routeIs('admin.product.add') ? 'active' : '' }}"> Create New </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.products') }}" class="nav-link {{ request()->routeIs('admin.products') ? 'active' : '' }}"> Products </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        <li class="nav-item">
                            @php
                                $serviceRoutes = ['admin.serviceForm','admin.serviceTable'];
                            @endphp
                            <a class="nav-link menu-link {{ request()->routeIs($serviceRoutes) ? 'active' : '' }}" href="#service" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="service">
                                <i class="ri-dashboard-2-line"></i> <span>Service</span>
                            </a>
                            <div class="collapse menu-dropdown {{ request()->routeIs($serviceRoutes) ? 'show' : '' }}" id="service">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.serviceForm') }}" class="nav-link {{ request()->routeIs('admin.serviceForm') ? 'active' : '' }}"> Create New </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.serviceTable') }}" class="nav-link {{ request()->routeIs('admin.serviceTable') ? 'active' : '' }}"> Services </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.branch') ? 'active' : '' }}" href="{{ route('admin.branch') }}">
                                <i class="ri-honour-line"></i> <span>Branch</span>
                            </a>
                        </li>

                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Page Settings</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarLanding" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                                <i class="ri-rocket-line"></i> <span data-key="t-landing">Landing</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarLanding">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="landing.html" class="nav-link" data-key="t-one-page"> One Page </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="nft-landing.html" class="nav-link" data-key="t-nft-landing"> NFT Landing </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="job-landing.html" class="nav-link" data-key="t-job">Job</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.contactPageSetting') ? 'active' : '' }}" href="{{ route('admin.contactPageSetting') }}">
                                <i class="ri-honour-line"></i> <span>Contact</span>
                            </a>
                        </li>
                        
                        @if(Auth::guard('admin')->user()->role == "superadmin")
                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Settings</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('admin.admins') }}">
                                <i class="ri-honour-line"></i> <span data-key="t-widgets">Manage Admin</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('admin.sitesetting') }}">
                                <i class="ri-honour-line"></i> <span data-key="t-widgets">Site Setting</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('admin.mailsetting') }}">
                                <i class="ri-honour-line"></i> <span data-key="t-widgets">Mail Setting</span>
                            </a>
                        </li>
                        @endif


                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>