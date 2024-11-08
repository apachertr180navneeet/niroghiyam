<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png'); }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8;" />
        <span class="brand-text font-weight-light">Niroghyam Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg'); }}" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $user_data->name;  }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" />
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.customer.list') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Customer
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.allergy.list') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Allergy
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.addiction.list') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Addiction
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.blood_group.list') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Blood Group
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.category.list') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.membership.list') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Membership
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.cms.list') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Content Managment System
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.complains.list') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Complains
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.vaccination.list') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Vaccination
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.transiction.list') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Payments
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.logs') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Logs
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.banner.list') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Banner
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.setting') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Setting
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
