<div>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h2>Welcome to <span class="text-danger"><span style="color: #012a6c;">US</span><span
                                    style="color: #c2113b;">AID</span></span> Afya Shirikishi,</h2>
                        <p class="mb-md-0">Your dashboard for tracking data for <span class="text-danger"><span
                                    style="color: #012a6c;">US</span><span style="color: #c2113b;">AID</span></span>
                            Afya Shirikishi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body dashboard-tabs p-0">
                    <ul class="nav nav-tabs px-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview"
                                role="tab" aria-controls="overview" aria-selected="true">Visits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="sales-tab" data-bs-toggle="tab" href="#sales" role="tab"
                                aria-controls="sales" aria-selected="false">Reports</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="purchases-tab" data-bs-toggle="tab" href="#purchases" role="tab"
                                aria-controls="purchases" aria-selected="false">ACF</a>
                        </li> --}}
                    </ul>
                    <div class="tab-content py-0 px-0">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel"
                            aria-labelledby="overview-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                {{-- <div
                                    class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-account-multiple icon-lg me-3 text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Reginal Corrdinators</small>
                                        <div class="dropdown"> --}}
                                {{-- <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium"
                                                href="#" role="button" id="dropdownMenuLinkA"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> --}}
                                {{-- <h5 class="mb-0 d-inline-block">{{ $rcs_count }}
                                            </h5> --}}
                                {{-- </a> --}}
                                {{-- <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                                <a class="dropdown-item" href="#">12 Aug 2018</a>
                                                <a class="dropdown-item" href="#">22 Sep 2018</a>
                                                <a class="dropdown-item" href="#">21 Oct 2018</a>
                                            </div> --}}
                                {{-- </div>
                                    </div>
                                </div> --}}
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    {{-- <i class="mdi mdi-location me-3 icon-lg text-danger"></i> --}}
                                    <img src="{{ asset('admin/images/map-marker.png') }}" alt="" srcset=""
                                        width="40px" class="me-3">
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Region</small>
                                        <h5 class="me-2 mb-0 text-uppercase">{{ auth()->user()->region->name }}</h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    {{-- <i class="mdi mdi-eye me-3 icon-lg text-success"></i> --}}
                                    <img src="{{ asset('admin/images/map-pinpoint.png') }}" alt=""
                                        srcset="" width="45px" class="me-3">
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Visited Districts</small>
                                        <h5 class="me-2 mb-0">{{ $district_count }} / {{ $total_districts }}</h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    {{-- <i class="mdi mdi-download me-3 icon-lg text-warning"></i> --}}
                                    <img src="{{ asset('admin/images/place-marker.png') }}" alt=""
                                        srcset="" width="45px" class="me-3">
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Visited Wards</small>
                                        <h5 class="me-2 mb-0">{{ $ward_count }} / {{ $total_wards }}</h5>
                                    </div>
                                </div>
                                {{-- <div
                                    class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Presumptive TB tested</small>
                                        <h5 class="me-2 mb-0">3497843</h5>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div
                                    class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-file-multiple icon-lg me-3 text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted"> All Reports</small>
                                        <div class="dropdown">
                                            {{-- <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium"
                                                href="#" role="button" id="dropdownMenuLinkA"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> --}}
                                            <h5 class="mb-0 d-inline-block">{{ $total_reports_count }}</h5>
                                            {{-- </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                                <a class="dropdown-item" href="#">12 Aug 2018</a>
                                                <a class="dropdown-item" href="#">22 Sep 2018</a>
                                                <a class="dropdown-item" href="#">21 Oct 2018</a>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-file-check me-3 icon-lg text-success"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Submitted Reports</small>
                                        <h5 class="me-2 mb-0">{{ $submitted_report_count }}</h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-file me-3 icon-lg text-primary"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Reports in Fields</small>
                                        <h5 class="me-2 mb-0">{{ $reports_in_field_count }}</h5>
                                    </div>
                                </div>
                                {{-- <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Presumptive TB referred</small>
                                        <h5 class="me-2 mb-0">$577545</h5>
                                    </div>
                                </div> --}}
                                {{-- <div
                                    class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Presumptive TB tested</small>
                                        <h5 class="me-2 mb-0">3497843</h5>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="purchases" role="tabpanel" aria-labelledby="purchases-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div
                                    class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Received Education</small>
                                        <div class="dropdown">
                                            <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium"
                                                href="#" role="button" id="dropdownMenuLinkA"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                                <a class="dropdown-item" href="#">12 Aug 2018</a>
                                                <a class="dropdown-item" href="#">22 Sep 2018</a>
                                                <a class="dropdown-item" href="#">21 Oct 2018</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Screened for TB</small>
                                        <h5 class="me-2 mb-0">$577545</h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Presumptive TB identified</small>
                                        <h5 class="me-2 mb-0">9833550</h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Presumptive TB referred</small>
                                        <h5 class="me-2 mb-0">2233783</h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Presumptive TB tested</small>
                                        <h5 class="me-2 mb-0">3497843</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-4">Recent Field Data</div>
                            {{-- <div class="col-4 text-center">Region: <span
                                    class="text-danger">{{ auth()->user()->region->name }}</span></div> --}}
                            {{-- <div class="col-3">RC: <span
                                    class="text-danger text-uppercase-start">{{ ucfirst(auth()->user()->first_name) }}
                                    {{ ucfirst(auth()->user()->last_name) }}</span>
                            </div> --}}
                            @if (auth()->user()->can('add field data'))
                                <div class="col-4">
                                    <a href="{{ route('admin.create_form_data') }}"
                                        class="btn btn-primary text-white btn-sm mt-0 " style="float: right;"><span
                                            class="me-2" style="font-size: 18px;">+</span> Add Field
                                        data</a>
                                </div>
                            @endif
                        </div>
                        <div class="row justify-content-between align-items-center mt-4">
                            <div class="col-5">
                                <input type="text" wire:model.live="keywords" class="form-control form-control-sm"
                                    id="keywords"
                                    placeholder="Search by form name, ward, or Reginal coordinator names">
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

                            {{-- @if (auth()->user()->can('download reports'))
                                <div class="col-4">
                                    <a href="{{ route('formattribute.export') }}"
                                        class="bbtn btn-danger btn-sm text-white text-white d-flex align-items-center text-decoration-none"
                                        style="float: right;"> --}}
                            {{-- <svg width="20px" height="20px" viewBox="0 3 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-2">
                                        <path d="M17 17H17.01M17.4 14H18C18.9319 14 19.3978 14 19.7654 14.1522C20.2554 14.3552 20.6448 14.7446 20.8478 15.2346C21 15.6022 21 16.0681 21 17C21 17.9319 21 18.3978 20.8478 18.7654C20.6448 19.2554 20.2554 19.6448 19.7654 19.8478C19.3978 20 18.9319 20 18 20H6C5.06812 20 4.60218 20 4.23463 19.8478C3.74458 19.6448 3.35523 19.2554 3.15224 18.7654C3 18.3978 3 17.9319 3 17C3 16.0681 3 15.6022 3.15224 15.2346C3.35523 14.7446 3.74458 14.3552 4.23463 14.1522C4.60218 14 5.06812 14 6 14H6.6M12 15V4M12 15L9 12M12 15L15 12" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg> --}}
                            {{-- <i class="mdi mdi-download me-2 mt-1"></i>
                                        Download Reports Titles
                                    </a>
                                </div>
                            @endif --}}
                        </div>
                    </h4>

                    <div class="table-responsive">
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
                                    <th>Created on</th>
                                    <th>Status</th>
                                    @if (auth()->user()->can('edit field data') && auth()->user()->can('submit field data'))
                                        <th>Action</th>
                                    @endif

                                </tr>
                            </thead>
                            @forelse($field_data as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ Str::limit($data->form_attribute->name, 20) }}</td>
                                    {{-- <td>{{ $data->scanning_name }}</td> --}}
                                    <td>{{ $data->ward->district->name }}</td>
                                    <td>{{ $data->ward->name }}</td>
                                    <td>{{ $data->address }}</td>
                                    <td>{{ $data->created_at->format('d/m/Y') }}</td>
                                    {{-- <td>{{ $report->added_by->first_name }} {{ $report->added_by->last_name }}</td> --}}
                                    <td>
                                        <span
                                            class="badge rounded bg-{{ $data->status == 0 ? 'danger' : 'success' }}">
                                            {{ $data->status == 0 ? 'Not submitted' : 'Submited' }}
                                        </span>
                                    </td>

                                    @if (auth()->user()->can('edit field data') && auth()->user()->can('submit field data'))
                                        <td>
                                            @if (auth()->user()->can('edit field data'))
                                                @if ($data->status == 0)
                                                    <a href="{{ route('admin.edit_form_data', ['form_id' => $data->id]) }}"
                                                        class="btn btn-warning btn-xs text-white"><i
                                                            class="mdi mdi-pencil"></i></a>
                                                @endif
                                            @endif
                                            @if (auth()->user()->can('submit field data'))
                                                <button type="button"
                                                    class="btn btn-{{ $data->status == 0 ? 'danger' : 'success' }} btn-xs text-white"
                                                    wire:click="getFormData('{{ $data->id }}')"
                                                    {{ $data->status == 0 ? '' : 'disabled' }} title="Submit"><i
                                                        class="mdi mdi-{{ $data->status == 0 ? 'send' : 'check' }}"></i></button>
                                            @endif
                                        </td>
                                    @endif

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No field data found!</td>
                                </tr>
                            @endforelse
                            <tbody>
                            </tbody>
                        </table>
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
                                        <button type="button" wire:click="clearForm"
                                            class="btn btn-danger text-white" data-bs-dismiss="modal">Cancel</button>
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
                </div>
            </div>
        </div>
    </div>
</div>
