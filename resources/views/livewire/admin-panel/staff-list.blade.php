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
                            <div class="col-6">staff</div>
                            <div class="col-6">
                                <a href="{{ route('admin.add_staff') }}" class="btn btn-primary text-white btn-sm" style="float: right;"><i class="mdi mdi-account-multiple-plus"></i> Add Staff</a>
                            </div>
                        </div>
                    </h4>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Full name</th>
                                <th>Email</th>
                                <th>Phone contact</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @forelse($staffs as $key => $staff)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $staff->first_name }} {{ $staff->last_name }}</td>
                                    <td>{{ $staff->email }}</td>
                                    <td> {{ $staff->phone }}</td>
{{--                                    {{ $staff->ward->district->region->name }} {{ $staff->ward->district->name }}, {{ $staff->ward->name }} ---}}
                                    {{-- <td>{{ $staff->position }}</td> --}}
                                    <td>Admin</td>
                                    <td>
                                        <a href="{{ route('admin.edit_staff', ['staff_id' => $staff->id]) }}" class="btn btn-warning btn-xs text-white"><i class="mdi mdi-pencil"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No Staff added!</td>
                                </tr>
                            @endforelse
                            <tbody>
                            </tbody>
                        </table>
                        {{ $staffs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
