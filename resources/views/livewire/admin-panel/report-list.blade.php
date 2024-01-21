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
                        <div class="row">
                            <div class="col-8">Field Data</div>
                            @if (auth()->user()->can('add field data'))
                                <div class="col-4">
                                    <a href="{{ route('admin.create_form_data') }}"
                                        class="btn btn-primary text-white btn-sm" style="float: right;"><span
                                            class="me-2" style="font-size: 18px;">+</span> Add Field data</a>
                                </div>
                            @endif
                        </div>
                        <div class="row justify-content-between align-items-center mt-4">
                            <div class="col-5">
                                <input type="text" wire:model.live="keywords" class="form-control form-control-sm"
                                    id="keywords"
                                    placeholder="Search by form name, ward, or Reginal coordinator names">
                            </div>
                            <div class="col-3">
                                <input type="date" wire:model.live="date" class="form-control form-control-sm"
                                    id="date" placeholder="Filter by date">
                            </div>
                            @if (auth()->user()->can('download reports'))
                                <div class="col-4">
                                    <a href="{{ route('formattribute.export') }}"
                                        class="btn btn-danger text-white btn-sm mb-0" style="float: right;">
                                        {{-- <svg width="20px" height="20px" viewBox="0 3 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-2">
                                        <path d="M17 17H17.01M17.4 14H18C18.9319 14 19.3978 14 19.7654 14.1522C20.2554 14.3552 20.6448 14.7446 20.8478 15.2346C21 15.6022 21 16.0681 21 17C21 17.9319 21 18.3978 20.8478 18.7654C20.6448 19.2554 20.2554 19.6448 19.7654 19.8478C19.3978 20 18.9319 20 18 20H6C5.06812 20 4.60218 20 4.23463 19.8478C3.74458 19.6448 3.35523 19.2554 3.15224 18.7654C3 18.3978 3 17.9319 3 17C3 16.0681 3 15.6022 3.15224 15.2346C3.35523 14.7446 3.74458 14.3552 4.23463 14.1522C4.60218 14 5.06812 14 6 14H6.6M12 15V4M12 15L9 12M12 15L15 12" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg> --}}
                                        Download Reports Titles
                                    </a>
                                </div>
                            @endif
                        </div>
                    </h4>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Form</th>
                                    <th>Scanning name</th>
                                    <th>Address</th>
                                    <th>Created By</th>
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
                                    <td>{{ $report->form_attribute->name }}</td>
                                    <td>{{ $report->scanning_name }}</td>
                                    <td>{{ $report->ward->name }}, {{ $report->address }}</td>
                                    <td>{{ $report->added_by->first_name }} {{ $report->added_by->last_name }}</td>
                                    <td>
                                        <span
                                            class="badge rounded bg-{{ $report->status == 0 ? 'danger' : 'success' }}">
                                            {{ $report->status == 0 ? 'Not submitted' : 'Submited' }}
                                        </span>
                                    </td>

                                    @if (auth()->user()->can('edit field data') &&
                                            auth()->user()->can('submit field data'))
                                        <td>
                                            @if (auth()->user()->can('edit field data'))
                                                <a href="{{ route('admin.edit_form_data', ['form_id' => $report->id]) }}"
                                                    class="btn btn-warning btn-xs text-white"><i
                                                        class="mdi mdi-pencil"></i></a>
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
                                    <td colspan="6" class="text-center">No field data found!</td>
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
    </script>
@endpush
