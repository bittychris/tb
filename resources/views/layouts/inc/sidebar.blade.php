<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#roles_permissions" aria-expanded="false" aria-controls="roles_permissions">
            <i class="mdi mdi-key-change menu-icon"></i>
            <span class="menu-title">Roles and Permissions</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="roles_permissions">
            <ul class="nav flex-column sub-menu ">
              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.roles') }}">All Roles</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.permissions') }}">All Permissions</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.permissions.roles') }}">Roles in Permissions</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#admins_staffs" aria-expanded="false" aria-controls="admins_staffs">
            <i class="mdi mdi-account-multiple menu-icon"></i>
            <span class="menu-title">Admins and Staffs</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="admins_staffs">
            <ul class="nav flex-column sub-menu ">
              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.admins') }}">Admins</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.staffs') }}">Staffs</a></li>
              {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('admin.permissions.roles') }}">Roles in Permissions</a></li> --}}
            </ul>
          </div>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.staffs') }}">
              <i class="mdi mdi-account-multiple menu-icon"></i>
              <span class="menu-title">Staffs</span>
          </a>
        </li> --}}
        {{-- <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="mdi mdi-circle-outline menu-icon"></i>
            <span class="menu-title">UI Elements</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
              <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages/forms/basic_elements.html">
            <i class="mdi mdi-view-headline menu-icon"></i>
            <span class="menu-title">Form elements</span>
          </a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.age_groups') }}">
                <i class="mdi mdi-google-circles-extended menu-icon"></i>
                <span class="menu-title">Age groups</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.attributes') }}">
                <i class="mdi mdi-view-headline menu-icon"></i>
                <span class="menu-title">Attributes</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.form_attributes') }}">
                <i class="mdi mdi-note menu-icon"></i>
                <span class="menu-title">Form Attributes</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.report') }}">
                <i class="mdi mdi-chart-gantt menu-icon"></i>
                <span class="menu-title">Fields</span>
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
              <i class="mdi mdi-file-chart menu-icon"></i>
              <span class="menu-title">Reports</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <a class="nav-link text-danger" data-bs-toggle="collapse" href="#recycle_bi" aria-expanded="false" aria-controls="recycle_bi">
            <i class="mdi mdi-delete menu-icon"></i>
            <span class="menu-title">Recycle bin</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="recycle_bi">
            <ul class="nav flex-column sub-menu ">
              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.deactivated.admins') }}">Admins</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.deactivated.staffs') }}">Staffs</a></li>
              {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('admin.permissions.roles') }}">Roles in Permissions</a></li> --}}
            </ul>
          </div>
        </li>

        {{-- <li class="nav-item">
          <a class="nav-link" href="documentation/documentation.html">
            <i class="mdi mdi-file-document-box-outline menu-icon"></i>
            <span class="menu-title">Documentation</span>
          </a>
        </li> --}}
    </ul>
</nav>
