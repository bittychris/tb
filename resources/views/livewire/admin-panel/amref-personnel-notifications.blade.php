<div class="d-inline">
    <li wire:ignore.self class="nav-item dropdown me-0">
        <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown"
            id="notificationDropdown" href="#" data-bs-toggle="dropdown">
            <i class="mdi mdi-bell mx-0"></i>

            @if ($notificationCounter != 0)
                <span class="count text-white"></span>
            @endif

        </a>
        <div wire:ignore.self class="dropdown-menu dropdown-menu-right navbar-dropdown"
            aria-labelledby="notificationDropdown" style="margin-top: -15px;">
            <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications <span wire:click="markAllRead"
                    class="text-primary" style="float: right; cursor: pointer;">Mark all as read</span></p>

            @forelse ($notifications as $notification)
                @php
                    $data = json_decode($notification->data);

                    $createdAt = \Carbon\Carbon::parse($notification->created_at);

                    // Format the created_at value as per your requirement
                    $formattedCreatedAt = $createdAt->format('M d, Y - H:i');

                @endphp
                <a class="dropdown-item">
                    <div class="item-thumbnail">
                        <div class="item-icon bg-info">
                            <img src="{{ !empty($data->image) ? asset('storage/user_images/' . $data->image) : asset('admin/images/faces/user_logo.jpg') }}"
                                alt="profile image" />
                            {{-- <i class="mdi mdi-account-box mx-0"></i> --}}
                        </div>
                    </div>
                    <div class="item-content">
                        <h6 class="font-weight-normal">{{ $data->name }}</h6>
                        <p class="font-weight-light small-text mb-0 text-muted">
                            {{ $data->message }}
                        </p>
                        <small class="font-weight-light small-text mb-0 text-muted">
                            <span class="me-5 text-success">{{ $formattedCreatedAt }}</span>
                            <span wire:click="markRead( '{{ $notification->id }}' )" class="text-primary mark-read-btn"
                                style="cursor: pointer;">Mark as read</span>
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
</div>