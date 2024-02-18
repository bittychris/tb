<div>
    <li class="nav-item dropdown me-1">
        <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
            id="messageDropdown" href="#" data-bs-toggle="dropdown">
            <i class="mdi mdi-message-text mx-0"></i>
            @if ($unread_comment_count != 0)
                <span class="count"></span>
            @endif
            @if ($unread_comment_count == 0)
                <span wire:poll.7000ms="reloadComments" class="badge bg-danger text-white rounded-3 me-5" title="Refresh"
                    style="font-size: 15px; display: none;"><i class="mdi mdi-refresh"></i></span>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown"
            style="margin-top: -15px;">
            <p class="mb-0 font-weight-normal float-left dropdown-header">Comments</p>
            @forelse ($comments as $comment)
                <a class="dropdown-item">
                    <div class="item-thumbnail">
                        <img src="{{ !empty($comment->sender->image) ? asset('storage/user_images/' . $comment->sender->image) : asset('admin/images/faces/user_logo.jpg') }}"
                            alt="image" class="profile-pic">
                    </div>
                    <div class="item-content flex-grow">
                        <h6 class="ellipsis font-weight-normal">{{ $comment->sender->first_name }}
                            {{ $comment->sender->last_name }}
                        </h6>

                        @if (auth()->user()->role->name == 'Regional coordinator')
                            <p class="font-weight-light small-text text-muted mb-0">
                                Comment about {{ $comment->form->scanning_name }} Report
                            </p>
                        @elseif (auth()->user()->role->name == 'AMREF personnel')
                            <p class="font-weight-light small-text text-muted mb-0">
                                Replied about {{ $comment->form->scanning_name }} Report comment
                            </p>
                        @else
                            <p class="font-weight-light small-text text-muted mb-0">
                                Comment about {{ $comment->form->scanning_name }} Report
                            </p>
                        @endif

                        <small class="font-weight-light small-text mb-0 text-muted">
                            <span class="me-5 text-success">{{ $comment->created_at->format('M d, Y - H:i') }}</span>
                            <span wire:click="goToReport( '{{ $comment->form_id }}' )"
                                class="text-primary mark-read-btn" style="cursor: pointer; float: right;">View</span>
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
                    <div class="item-content flex-grow">
                        {{-- <h6 class="ellipsis font-weight-normal">David Grey
                        </h6> --}}
                        <p class="font-weight-light small-text text-muted mb-0">
                            No unread Comment found
                        </p>
                    </div>
                </a>
            @endforelse

        </div>
    </li>
</div>
