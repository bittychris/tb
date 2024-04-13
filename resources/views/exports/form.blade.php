<table class="table table-hover table-bordered table-sm">
    <thead>
        <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Region</th>
            <th>District</th>
            <th>Ward</th>
            <th>Reginal Cordinator</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @forelse($forms as $form)
            <tr>
                <td>{{ $i++ }}</td>
                <td>
                    {{-- <a class="text-uppercase" href="{{ route('formOne.export', ['formdata_id' => $form->id]) }}"
                        style="text-decoration: none;"> --}}
                    {{ $form->form_attribute->name }}
                    {{-- </a></td> --}}
                <td>{{ $form->ward->district->region->name }}</td>
                <td>{{ $form->ward->district->name }}</td>
                <td>{{ $form->ward->name }}</td>
                <td>{{ $form->added_by->first_name }} {{ $form->added_by->last_name }}</td>
                <td>{{ $form->updated_at->format('M d, Y') }}</td>
                <td>
                    @php
                        $unread_form_comment_count = $form
                            ->comments()
                            ->where('receiver_id', auth()->user()->id)
                            ->whereNull('read_at')
                            ->count();
                    @endphp
                    <a href="{{ route('admin.reporting.view', ['form' => $form->id]) }}"
                        class="btn btn-primary }} btn-sm text-white">
                        <i class="mdi mdi-eye" title="View"></i></a>
                    <button type="button" wire:click="getReportDetails('{{ $form->id }}')"
                        class="btn btn-{{ $unread_form_comment_count > 0 ? 'success' : 'info' }} btn-sm text-white">
                        <i class="mdi mdi-message-text" title="Comment"></i>
                    </button>
                    {{-- <a href="{{ route('formOne.export', ['formdata_id' => $form->id]) }}"
                        class="btn btn-info btn-sm text-white" style="text-decoration: none;"><i
                            class="mdi mdi-message-text" title="Comment"></i> --}}
                    </a>
                    <a href="{{ route('singleFormData.export', ['form_id' => $form->id]) }}"
                        class="btn btn-danger btn-sm text-white" style="text-decoration: none;"><i
                            class="mdi mdi-download" title="Download excel"></i></a>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center" colspan="8">No report found!</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Comment Modal -->
<div wire:ignore.self class="modal fade" id="commentsModal" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="commentsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center p-3"
                style="border-top: 4px solid #ff4747;">
                <h5 class="mb-0" id="commentsModalLabel">
                    {{-- <span class="text-uppercase text-danger">
                        {{ $report_name }}
                    </span> Report  --}}
                    Comments
                </h5>
                <div class="d-flex flex-row align-items-center">
                    <span wire:click="sendEditLink" class="badge bg-danger text-white rounded-3 me-5" title="Refresh"
                        style="font-size: 12px; cursor: pointer;">Send edit link</span>
                    <span wire:poll.1000ms="reloadComments" class="badge bg-danger text-white rounded-3 me-5"
                        title="Refresh" style="font-size: 15px; display: none;"><i class="mdi mdi-refresh"></i>
                    </span>
                    @if ($unread_comment_count > 0)
                        <span class="badge bg-danger rounded-3 me-5"
                            style="font-size: 15px;">{{ $unread_comment_count }}</span>
                    @endif
                    <button type="button" class="btn-close" wire:click="closeCommentModel"></button>
                </div>
            </div>
            <div class="modal-body mx-1 comment-box border" data-mdb-perfect-scrollbar="true"
                style="position: relative; height: 450px; overflow-y: auto; background: #dad9d9f8;">
                <div class=" mx-2" data-mdb-perfect-scrollbar="true">

                    @forelse ($comments as $comment)
                        @if ($comment->sender->id == auth()->user()->id)
                            <div class="d-flex flex-row justify-content-end mb-1 pt-1">
                                <div>
                                    <div class="row border-danger border-right border-3 small p-2 ms-2 mb-3 rounded-3 bg-white"
                                        style="background-color: #f5f6f7;">
                                        <div class="col-12 border-dark border-bottom pb-1 small"
                                            style="font-size: 12px;">
                                            <span style="float: right;">You</span>
                                            {{-- RC:
                                            {{ $comment->sender->first_name }}
                                            {{ $comment->sender->last_name }} --}}
                                        </div>
                                        <div class="col-12 mt-2">
                                            @if ($comment->content === 'edit_report-' . $comment->form_id . '')
                                                <a href="{{ route('admin.edit_form_data', ['form_id' => $comment->form_id]) }}"
                                                    class="text-danger" style="font-size: 13px;">RC can now edit this
                                                    report</a>
                                            @else
                                                {{ $comment->content }}
                                            @endif
                                            {{-- {{ html_entity_decode($comment->content) }} --}}
                                            {{-- {!! $comment->content !!} --}}

                                        </div>
                                        <div class="col-12">
                                            <p class="small text-muted mt-1"
                                                style="font-size: 12px; float: right; margin-bottom: -5px;">

                                                {{ $comment->created_at->format('d M, h:m a') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                {{-- <img src="{{ !empty($comment->sender->image) ? asset('storage/user_images/' . $comment->sender->image) : asset('admin/images/faces/user_logo.jpg') }}"
                                    alt="profile image" style="width: 45px; height: 45px; border-radius: 100%;" /> --}}
                            </div>
                        @elseif ($comment->receiver_id == auth()->user()->id)
                            <div class="d-flex flex-row justify-content-start mb-1">
                                {{-- <img src="{{ !empty($comment->sender->image) ? asset('storage/user_images/' . $comment->sender->image) : asset('admin/images/faces/user_logo.jpg') }}"
                                    alt="profile image" style="width: 45px; height: 45px; border-radius: 100%;" /> --}}
                                <div>
                                    <div class="row border-dark border-left border-3 small p-2 me-2 mb-3 rounded-3"
                                        style="background-color: #f5f6f7;">
                                        <div class="col-12 border-secondary border-bottom pb-1 small"
                                            style="font-size: 12px;">
                                            <span class="text-danger fw-bold">RC: </span>
                                            {{ $comment->sender->first_name }}
                                            {{ $comment->sender->last_name }}
                                        </div>
                                        <div class="col-12 mt-2">
                                            {{ $comment->content }}
                                            {{-- {{ html_entity_decode($comment->content) }} --}}
                                            {{-- {!! $comment->content !!} --}}

                                        </div>
                                        <div class="col-12">
                                            <p class="small text-muted mt-1"
                                                style="font-size: 12px; float: right; margin-bottom: -5px;">

                                                {{ $comment->created_at->format('d M, h:m a') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="mt-5 text-center pt-3">
                            <p>Send comments about <br /> <span
                                    class="text-uppercase text-danger fw-bold">{{ $report_name }}</span> report </p>

                            <center class="mt-3 mb-2">
                                <img src="{{ !empty($rc_image) ? asset('storage/user_images/' . $rc_image) : asset('admin/images/faces/user_logo.jpg') }}"
                                    alt="profile image"
                                    style="width: 150px; height: 150px; border-radius: 10px 0 10px 0 ; border: 2px solid red;" />
                            </center>
                            <p>RC: <span class="text-danger fw-bold mt-2">{{ $rc }}</span></p>
                        </div>
                    @endforelse
                </div>
            </div>
            <form class="typing-area" wire:submit.prevent="sendComment">
                @csrf
                <div class="modal-footer text-muted d-flex justify-content-start align-items-center">
                    <div class="input-group mb-0">
                        <input type="text" wire:model="content" class="form-control input-field"
                            placeholder="Type comment" aria-label="Recipient's username"
                            aria-describedby="button-addon2" style="border: 1px solid #ccc;" />
                        <button class="btn btn-danger text-white send-btn" type="submit" id="button-addon2"
                            title="Send">
                            <i class="mdi mdi-send"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
