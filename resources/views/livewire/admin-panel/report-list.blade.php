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
                            <div class="col-6">Field Data</div>
                            <div class="col-6">
                                <a href="{{ route('formattribute.export') }}" class="btn btn-primary text-white btn-sm" style="float: right;">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 17H17.01M17.4 14H18C18.9319 14 19.3978 14 19.7654 14.1522C20.2554 14.3552 20.6448 14.7446 20.8478 15.2346C21 15.6022 21 16.0681 21 17C21 17.9319 21 18.3978 20.8478 18.7654C20.6448 19.2554 20.2554 19.6448 19.7654 19.8478C19.3978 20 18.9319 20 18 20H6C5.06812 20 4.60218 20 4.23463 19.8478C3.74458 19.6448 3.35523 19.2554 3.15224 18.7654C3 18.3978 3 17.9319 3 17C3 16.0681 3 15.6022 3.15224 15.2346C3.35523 14.7446 3.74458 14.3552 4.23463 14.1522C4.60218 14 5.06812 14 6 14H6.6M12 15V4M12 15L9 12M12 15L15 12" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Download Report </a>
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
                        {{ $reports->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
