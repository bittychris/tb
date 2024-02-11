<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        @if (auth()->user()->can('roles and permissions menu'))
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#roles_permissions" aria-expanded="false"
                    aria-controls="roles_permissions">
                    <i class="mdi mdi-key-change menu-icon"></i>
                    <span class="menu-title">Roles and Permissions</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="roles_permissions">
                    <ul class="nav flex-column sub-menu ">
                        @if (auth()->user()->can('all roles'))
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.roles') }}">All Roles</a>
                            </li>
                        @endif

                        @if (auth()->user()->can('all permissions'))
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.permissions') }}">All
                                    Permissions</a></li>
                        @endif

                        @if (auth()->user()->can('roles with permissions'))
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.permissions.roles') }}">Roles with Permissions</a></li>
                        @endif

                    </ul>
                </div>
            </li>
        @endif

        @if (auth()->user()->can('admins and staffs menu'))
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#admins_staffs" aria-expanded="false"
                    aria-controls="admins_staffs">
                    <i class="mdi mdi-account-multiple menu-icon"></i>
                    <span class="menu-title">Admins and Staffs</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="admins_staffs">
                    <ul class="nav flex-column sub-menu ">
                        @if (auth()->user()->can('all admins'))
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.admins') }}">Admins</a></li>
                        @endif
                        @if (auth()->user()->can('all staffs'))
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.staffs') }}">Staffs</a></li>
                        @endif
                    </ul>
                </div>
            </li>
        @endif

        @if (auth()->user()->role->name == 'Admin')
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#locations" aria-expanded="false"
                    aria-controls="locations">
                    <i class="mdi mdi-map-marker menu-icon"></i>
                    <span class="menu-title">Locations</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="locations">
                    <ul class="nav flex-column sub-menu ">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('admin.regions') }}">Regions</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('admin.districts') }}">Districts</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('admin.wards') }}">Wards</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif

        @if (auth()->user()->can('all age groups'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.age_groups') }}">
                    <i class="mdi mdi-google-circles-extended menu-icon"></i>
                    <span class="menu-title">Age groups</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->can('all attributes'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.attributes') }}">
                    <i class="mdi mdi-view-headline menu-icon"></i>
                    <span class="menu-title">Attributes</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->can('all form attributes'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.form_attributes') }}">
                    <i class="mdi mdi-chart-gantt menu-icon"></i>
                    <span class="menu-title">Form Attributes</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->can('all field data'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.report') }}">
                    <i class="mdi mdi-note menu-icon"></i>
                    <span class="menu-title">Field data</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->can('all reports'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.reporting') }}">
                    <i class="mdi mdi-file-chart menu-icon"></i>
                    <span class="menu-title">Reports</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->can('recycle bin menu'))
            <li class="nav-item mt-3">
                <a class="nav-link" data-bs-toggle="collapse" href="#recycle_bin" aria-expanded="false"
                    aria-controls="recycle_bin">
                    <i class="mdi mdi-delete menu-icon"></i>
                    <span class="menu-title">Recycle bin</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="recycle_bin">
                    <ul class="nav flex-column sub-menu ">
                        @if (auth()->user()->can('all deleted admins'))
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.deactivated.admins') }}">Admins</a></li>
                        @endif
                        @if (auth()->user()->can('all deleted staffs'))
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.deactivated.staffs') }}">Staffs</a></li>
                        @endif
                    </ul>
                </div>
            </li>
        @endif
    </ul>
</nav>
