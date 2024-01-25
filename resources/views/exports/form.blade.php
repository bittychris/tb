<table class="table table-hover table-bordered table-sm">
    <thead>
        <tr>
            <th>S/N</th>
            <th>Scanning Name</th>
            <th>Region</th>
            <th>District</th>
            <th>ward</th>
            <th>Reginal Cordinator</th>
            <th>Submition date</th>
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
                <td><a href="{{ route('formOne.export', ['formdata_id' => $form->id]) }}"
                        style="text-decoration: none;">{{ $form->scanning_name }}</a></td>
                <td>{{ $form->ward->district->region->name }}</td>
                <td>{{ $form->ward->district->name }}</td>
                <td>{{ $form->ward->name }}</td>
                <td>{{ $form->added_by->first_name }} {{ $form->added_by->last_name }}</td>
                <td>{{ $form->updated_at->format('M d, Y') }}</td>
                <td>
                    <button type="button" class="btn btn btn-info btn-sm text-white" data-bs-toggle="modal"
                        data-bs-target="#commentsModal">
                        <i class="mdi mdi-message-text" title="Comment"></i>
                    </button>
                    {{-- <a href="{{ route('formOne.export', ['formdata_id' => $form->id]) }}"
                        class="btn btn-info btn-sm text-white" style="text-decoration: none;"><i
                            class="mdi mdi-message-text" title="Comment"></i> --}}
                    </a>
                    <a href="{{ route('formOne.export', ['formdata_id' => $form->id]) }}"
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
<div class="modal fade" id="commentsModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="commentsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center p-3"
                style="border-top: 4px solid #ff4747;">
                <h5 class="mb-0" id="commentsModalLabel">Report name Comments</h5>
                <div class="d-flex flex-row align-items-center">
                    <span class="badge bg-danger rounded-3 me-5">20</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body comment-box border" data-mdb-perfect-scrollbar="true"
                style="position: relative; height: 450px; overflow-y: auto;">
                <div class=" mx-3" data-mdb-perfect-scrollbar="true">
                    <div class="d-flex justify-content-between mb-2">
                        <p class="small mb-1">Timona Siera</p>
                        <p class="small mb-1 text-muted">23 Jan 2:00 pm</p>
                    </div>
                    <div class="d-flex flex-row justify-content-start mb-3">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava5-bg.webp"
                            alt="avatar 1" style="width: 45px; height: 100%;">
                        <div>
                            <p class="small p-2 ms-3 mb-3 rounded-3" style="background-color: #f5f6f7;">For what
                                reason
                                would it
                                be advisable for me to think about business content?</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <p class="small mb-1 text-muted">23 Jan 2:05 pm</p>
                        <p class="small mb-1">Johny Bullock</p>
                    </div>
                    <div class="d-flex flex-row justify-content-end mb-4 pt-1">
                        <div>
                            <p class="small p-2 me-3 mb-3 text-white rounded-3 bg-danger">Thank you
                                for your believe in
                                our
                                supports</p>
                        </div>
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                            alt="avatar 1" style="width: 45px; height: 100%;">
                    </div>

                    <div class="d-flex justify-content-between">
                        <p class="small mb-1">Timona Siera</p>
                        <p class="small mb-1 text-muted">23 Jan 5:37 pm</p>
                    </div>
                    <div class="d-flex flex-row justify-content-start">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava5-bg.webp"
                            alt="avatar 1" style="width: 45px; height: 100%;">
                        <div>
                            <p class="small p-2 ms-3 mb-3 rounded-3" style="background-color: #f5f6f7;">Lorem ipsum
                                dolor
                                sit amet
                                consectetur adipisicing elit similique quae consequatur</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <p class="small mb-1 text-muted">23 Jan 6:10 pm</p>
                        <p class="small mb-1">Johny Bullock</p>
                    </div>
                    <div class="d-flex flex-row justify-content-end mb-4 pt-1">
                        <div>
                            <p class="small p-2 me-3 mb-3 text-white rounded-3 bg-danger">Dolorum
                                quasi voluptates quas
                                amet in
                                repellendus perspiciatis fugiat</p>
                        </div>
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                            alt="avatar 1" style="width: 45px; height: 100%;">
                    </div>

                </div>
            </div>
            <form class="typing-area">
                @csrf
                <div class="modal-footer text-muted d-flex justify-content-start align-items-center">

                    <div class="input-group mb-0">

                        <input type="text" class="form-control input-field" placeholder="Type message"
                            aria-label="Recipient's username" aria-describedby="button-addon2"
                            style="border: 1px solid #ccc;" />
                        <button class="btn btn-danger text-white send-btn" type="button" id="button-addon2"
                            style="padding-top: ;">
                            <i class="mdi mdi-send" title="Send"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
