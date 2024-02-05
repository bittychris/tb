<div>
    <div class="row">
        <div class="col-lg-12">
            @if (session()->has('success'))
                @include('partial.alert')
            @elseif (session()->has('warning'))
                @include('partial.alert')
            @elseif (session()->has('error'))
                @include('partial.alert')
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-7">Field Data</div>
                            {{-- @if (auth()->user()->can('download reports')) --}}
                            <div class="col-5 d-flex justify-content-between">
                                <a href="{{ empty($keywords) ? route('field_data.export', ['keywords' => 0, 'submission_status' => $submission_status, 'startDate' => $startDate, 'endDate' => $endDate]) : route('form.export', ['keywords' => $keywords, 'submission_status' => $submission_status, 'startDate' => $startDate, 'endDate' => $endDate]) }}"
                                    class="bbtn btn-danger btn-sm text-white d-flex align-items-center text-decoration-none ">
                                    {{-- <svg width="20px" height="20px" viewBox="0 3 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-2">
                                        <path d="M17 17H17.01M17.4 14H18C18.9319 14 19.3978 14 19.7654 14.1522C20.2554 14.3552 20.6448 14.7446 20.8478 15.2346C21 15.6022 21 16.0681 21 17C21 17.9319 21 18.3978 20.8478 18.7654C20.6448 19.2554 20.2554 19.6448 19.7654 19.8478C19.3978 20 18.9319 20 18 20H6C5.06812 20 4.60218 20 4.23463 19.8478C3.74458 19.6448 3.35523 19.2554 3.15224 18.7654C3 18.3978 3 17.9319 3 17C3 16.0681 3 15.6022 3.15224 15.2346C3.35523 14.7446 3.74458 14.3552 4.23463 14.1522C4.60218 14 5.06812 14 6 14H6.6M12 15V4M12 15L9 12M12 15L15 12" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg> --}}
                                    <i class="mdi mdi-download me-2 mt-1"></i>
                                    Download Field Data
                                </a>
                                {{-- @endif --}}
                                {{-- <div class="col-4 text-center">Region: <span
                                    class="text-danger">{{ auth()->user()->region->name }}</span></div> --}}
                                {{-- <div class="col-3">RC: <span
                                    class="text-danger text-uppercase-start">{{ ucfirst(auth()->user()->first_name) }}
                                    {{ ucfirst(auth()->user()->last_name) }}</span></div> --}}
                                @if (auth()->user()->can('add field data'))
                                    <a href="{{ route('admin.create_form_data') }}"
                                        class="btn btn-primary text-white btn-sm mt-0" style="float: right;"><span
                                            class="me-2" style="font-size: 18px;">+</span> Add Field data</a>
                                @endif
                            </div>
                        </div>
                        <div class="row justify-content-between align-items-center mt-4">
                            <div class="col-4">
                                <input type="text" wire:model.live="keywords" class="form-control form-control-sm"
                                    id="keywords" placeholder="Search by form name, district, ward, or RC names">
                            </div>
                            <div class="col-md-5 d-flex align-items-center">
                                <label for="startDate">From:</label>
                                <input type="date" class="form-control form-control-sm ms-2 me-3" id="startDate"
                                    wire:model.live="startDate">

                                <label for="endDate">To:</label>
                                <input type="date" class="form-control form-control-sm ms-2" id="endDate"
                                    wire:model.live="endDate">
                            </div>
                            {{-- <div class="col-3">
                                <input type="date" wire:model.live="date" class="form-control form-control-sm"
                                    id="date" placeholder="Filter by date" style="float: left;">
                            </div> --}}
                            <div class="col-3">
                                <select wire:model.live="submission_status"
                                    class="form-control form-control-sm text-dark pt-3" id="role_id">
                                    <option value="all" class="fw-bold" selected>All Field data</option>
                                    <option value="submitted" class="fw-bold">Submitted Field data</option>
                                    <option value="not_submitted" class="fw-bold">Unsubmitted Field data</option>
                                </select>
                            </div>
                        </div>
                    </h4>

                    <div class="table-responsive">
                        <div hidden>
                            @include('exports.rc_form_export')
                        </div>

                        <table class="table table-hover table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Form</th>
                                    {{-- <th>Scanning name</th> --}}
                                    <th>District</th>
                                    <th>Ward</th>
                                    <th>Address</th>
                                    {{-- <th>Created By</th> --}}
                                    <th>Status</th>
                                    @if (auth()->user()->can('edit field data') &&
                                            auth()->user()->can('submit field data'))
                                        <th>Action</th>
                                    @endif

                                </tr>
                            </thead>
                            @forelse($reports as $key => $report)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    {{-- <td>{{ $report->form_attribute->name }}</td> --}}
                                    <td style="overflow-x: hidden;" class="text-break">{{ $report->scanning_name }}</td>
                                    <td>{{ $report->ward->district->name }}</td>
                                    <td>{{ $report->ward->name }}</td>
                                    <td>{{ $report->address }}</td>
                                    {{-- <td>{{ $report->added_by->first_name }} {{ $report->added_by->last_name }}</td> --}}
                                    <td>
                                        <span
                                            class="badge rounded bg-{{ $report->status == 0 ? 'danger' : 'success' }}">
                                            {{ $report->status == 0 ? 'Not submitted' : 'Submited' }}
                                        </span>
                                    </td>

                                    @if (auth()->user()->can('edit field data') &&
                                            auth()->user()->can('submit field data'))
                                        <td>
                                            @php
                                                $unread_form_comment_count = $report
                                                    ->comments()
                                                    ->where('receiver_id', auth()->user()->id)
                                                    ->whereNull('read_at')
                                                    ->count();

                                                $form_comment_count = $report
                                                    ->comments()
                                                    ->where('receiver_id', auth()->user()->id)
                                                    ->count();
                                            @endphp
                                            <a href="{{ route('admin.reporting.view', ['form' => $report->id]) }}"
                                                class="btn btn-primary }} btn-sm text-white">
                                                <i class="mdi mdi-eye" title="View"></i></a>
                                            @if (auth()->user()->can('edit field data'))
                                                @if ($report->status == 0)
                                                    <a href="{{ route('admin.edit_form_data', ['form_id' => $report->id]) }}"
                                                        class="btn btn-warning btn-xs text-white"><i
                                                            class="mdi mdi-pencil"></i></a>
                                                @endif
                                                @if ($report->status == 1)
                                                    <button type="button"
                                                        wire:click="getReportDetails('{{ $report->id }}')"
                                                        class="btn {{ $unread_form_comment_count > 0 ? 'btn-success' : 'btn-info' }} btn-xs text-white"
                                                        {{ $form_comment_count > 0 ? '' : 'disabled' }}>
                                                        <i class="mdi mdi-message-text" title="Comment"></i>
                                                    </button>
                                                @endif
                                            @endif

                                            @if (auth()->user()->can('submit field data'))
                                                <button type="button"
                                                    class="btn btn-{{ $report->status == 0 ? 'danger' : 'success' }} btn-xs text-white"
                                                    wire:click="getFormData('{{ $report->id }}')"
                                                    {{ $report->status == 0 ? '' : 'disabled' }} title="Submit"><i
                                                        class="mdi mdi-{{ $report->status == 0 ? 'send' : 'check' }}"></i></button>
                                            @endif
                                        </td>
                                    @endif

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No field data found!</td>
                                </tr>
                            @endforelse
                            <tbody>
                            </tbody>
                        </table>
                        {{ $reports->links() }}
                    </div>

                    <!-- Delete age group Modal -->
                    <div wire:ignore.self class="modal fade" id="submit_data_model" tabindex="-1"
                        aria-labelledby="submit_data_model_label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form class="forms-sample" wire:submit.prevent="submitData">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm</h1>
                                        <button type="button" wire:click="clearForm" class="btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body px-3">
                                        Do you want to Submit <span class="fw-bold">{{ $report_name }}</span> Field
                                        data?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" wire:click="clearForm" class="btn btn-danger text-white"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" wire:loading.remove wire:target="submitData"
                                            class="btn btn-success text-white">Yes, Submit</button>
                                        <button type="submit" wire:loading wire:loading.attr="disabled"
                                            wire:target="submitData"
                                            class="btn btn-success text-white">Submitting...</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- Comment Modal -->
                    <div wire:ignore.self class="modal fade" id="commentsModal" tabindex="-1"
                        data-bs-backdrop="static" aria-labelledby="commentsModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header d-flex justify-content-between align-items-center p-3"
                                    style="border-top: 4px solid #ff4747;">
                                    <h5 class="mb-0" id="commentsModalLabel">
                                        <span class="text-uppercase text-danger">
                                            {{-- {{ $report_name }}
                                        </span> Report  --}}
                                            Comments
                                    </h5>
                                    <div class="d-flex flex-row align-items-center">
                                        <span wire:poll.1000ms="reloadComments"
                                            class="badge bg-danger text-white rounded-3 me-5" title="Refresh"
                                            style="font-size: 15px; display: none;"><i class="mdi mdi-refresh"></i>
                                        </span>
                                        @if ($unread_comment_count > 0)
                                            <span class="badge bg-danger rounded-3 me-5"
                                                style="font-size: 15px;">{{ $unread_comment_count }}</span>
                                        @endif
                                        <button type="button" class="btn-close"
                                            wire:click="closeCommentModel"></button>
                                    </div>
                                </div>
                                <div class="modal-body mx-1 comment-box border" data-mdb-perfect-scrollbar="true"
                                    style="position: relative; height: 450px; overflow-y: auto; background: #dad9d9f8;">
                                    <div class="mx-2" data-mdb-perfect-scrollbar="true">

                                        @foreach ($comments as $comment)
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
                                                                {{ $comment->content }}
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
                                                                <span class="text-danger fw-bold">ASP: </span>
                                                                {{ $comment->sender->first_name }}
                                                                {{ $comment->sender->last_name }}
                                                            </div>
                                                            <div class="col-12 mt-2">
                                                                @if ($comment->content === 'edit_report-' . $comment->form_id . '')
                                                                    <a href="{{ route('admin.edit_form_data', ['form_id' => $comment->form_id]) }}"
                                                                        class="text-danger"
                                                                        style="font-size: 13px;">Click to edit this
                                                                        report</a>
                                                                @else
                                                                    {{ $comment->content }}
                                                                @endif
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
                                        @endforeach
                                    </div>
                                </div>
                                <form class="typing-area" wire:submit.prevent="sendComment">
                                    @csrf
                                    <div
                                        class="modal-footer text-muted d-flex justify-content-start align-items-center">
                                        <div class="input-group mb-0">
                                            <input type="text" wire:model="content"
                                                class="form-control input-field" placeholder="Type comment"
                                                aria-label="Recipient's username" aria-describedby="button-addon2"
                                                style="border: 1px solid #ccc;" />
                                            <button class="btn btn-danger text-white send-btn" type="submit"
                                                id="button-addon2" style="padding-top: ;">
                                                <i class="mdi mdi-send" title="Send"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        window.addEventListener('openSubmitDataModel', event => {
            $('#submit_data_model').modal('show');
        });

        window.addEventListener('closeModel', event => {
            $('#submit_data_model').modal('hide');
        });

        // Report modal
        window.addEventListener('openCommentModel', event => {
            $('#commentsModal').modal('show');
        });

        window.addEventListener('closeCommentModel', event => {
            $('#commentsModal').modal('hide');
        });
    </script>
@endpush
