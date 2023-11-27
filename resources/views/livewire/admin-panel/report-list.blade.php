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
                        <div class="row justify-content-between align-items-center">
                            <div class="col-6">Reports</div>
                            <div class="col-6">
                                <a href="{{ route('admin.create_form_data') }}" class="btn btn-primary text-white btn-sm" style="float: right;"><i class="mdi mdi-plus"></i> Create Report</a>
                            </div>
                        </div>
                    </h4>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Form</th>
                                <th>Scanning</th>
                                <th>Address</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @forelse($reports as $key => $report)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $report->form_attribute->name }}</td>
                                    <td>{{ $report->scanning_name }}</td>
                                    <td> {{ $report->address }}</td>
{{--                                    {{ $report->ward->district->region->name }} {{ $report->ward->district->name }}, {{ $report->ward->name }} ---}}
                                    <td>{{ $report->added_by->first_name }} {{ $report->added_by->last_name }}</td>
                                    <td>
                                        <a href="{{ route('admin.edit_form_data', ['form_id' => $report->id]) }}" class="btn btn-warning btn-xs text-white"><i class="mdi mdi-pencil"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No report added!</td>
                                </tr>
                            @endforelse
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
