<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center">
      <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
        <a class="navbar-brand brand-logo fw-bold h-100 w-100" href="{{ route('admin.dashboard') }}" style="font-size: 16px;">
          <img src="{{ asset('admin/images/amref logo.png') }}" class="" alt="logo" style="object-fit: ; width: 95px !important; height: 50px !important; margin-left: 25px !important;"/>
        </a>
        <a class="navbar-brand brand-logo-mini text-bold" href="{{ route('admin.dashboard') }}" style="font-size: 13px;">USAID
          {{-- <img src="{{ asset('admin/images/logo-mini.svg') }}" alt="logo"/> --}}
        </a>
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-sort-variant"></span>
        </button>
      </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      {{--  <ul class="navbar-nav mr-lg-4 w-100">
        <li class="nav-item nav-search d-none d-lg-block w-75">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="search">
                <i class="mdi mdi-magnify"></i>
              </span>
            </div>
            <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
          </div>
        </li>
      </ul>  --}}
      <ul class="navbar-nav navbar-nav-right">
         @if (auth()->user()->can('view notifications')) 
          {{--  notification  --}}
          <div class="mt-2">
            <livewire:admin-panel.notifications />
          </div>
         @endif 

        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
            <img src="{{ !empty(auth()->user()->image) ? asset('storage/user_images/'.auth()->user()->image) : asset('admin/images/faces/user_logo.jpg') }}" alt="profile image" />
            <span class="nav-profile-name">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <a href="{{ route('user.profile') }}" class="dropdown-item">
              <i class="mdi mdi-account text-danger"></i>
              My profile
            </a>
            <a href="{{ route('user.change_password') }}" class="dropdown-item" disabled="true">
              <i class="mdi mdi-lock text-danger"></i>
              Change password
            </a>
            <!-- item-->

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <a href="{{ route('logout') }}"
              onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();"
              class="dropdown-item">
              <i class="mdi mdi-logout text-danger me-1"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
</nav>
