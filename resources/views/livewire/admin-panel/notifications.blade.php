{{--  <div class="d-inline">  --}}
  @if (auth()->user()->role->name == 'Admin')

    <li class="nav-item dropdown me-4">
        <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
          <i class="mdi mdi-bell mx-0"></i>
          
          @if($notificationCounter != 0)
            <span class="count text-white"></span>

          @endif
          
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
          <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications <span wire:click="markAllRead" class="text-primary" style="float: right; cursor: pointer;">Mark all as read</span></p>
          {{--  <a class="dropdown-item">
            <div class="item-thumbnail">
              <div class="item-icon bg-success">
                <i class="mdi mdi-information mx-0"></i>
              </div>
            </div>
            <div class="item-content">
              <h6 class="font-weight-normal">Application Error</h6>
              <p class="font-weight-light small-text mb-0 text-muted">
                Just now
              </p>
            </div>
          </a>  --}}
          {{--  <a class="dropdown-item">
            <div class="item-thumbnail">
              <div class="item-icon bg-warning">
                <i class="mdi mdi-settings mx-0"></i>
              </div>
            </div>
            <div class="item-content">
              <h6 class="font-weight-normal">Settings</h6>
              <p class="font-weight-light small-text mb-0 text-muted">
                Private message
              </p>
            </div>
          </a>  --}}
              
            @forelse ($notifications as $notifacation)

              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-info">
                    <i class="mdi mdi-account-box mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">{{ $notifacation->data['name'] }}</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    {{ $notifacation->data['message'] }}
                  </p>
                  <small class="font-weight-light small-text mb-0 text-muted">
                    <span class="me-5 text-success">{{ $notifacation->created_at->format('d M, Y') }}</span> <span wire:click="markRead( '{{ $notifacation->id }}' )" class="text-primary mark-read-btn" style="cursor: pointer;">Mark as read</span>
                  </small>
                </div>
              </a>

            @empty
              
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-danger">
                    <i class="mdi mdi-information mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <p class="font-weight-light small-text mb-0 text-muted">
                    No unread nofications
                  </p>
                </div>
              </a>

            @endforelse
          
        </div>
      </li>
      
      @endif              

{{--  </div>  --}}
