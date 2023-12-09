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
                            <div class="col-6">staffs</div>
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
                                    <td>{{ $staff->phone }}</td>
                                    <td>
                                        <span class="badge bg-success rounded">
                                            {{ $staff->role->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.edit_staff', ['staff_id' => $staff->id]) }}" class="btn btn-warning btn-xs text-white"><i class="mdi mdi-pencil"></i></a>
                                        <button class="btn btn-danger btn-sm" wire:click="prepareDeleteStaff({{$staff->id}})" data-bs-toggle="modal" data-bs-target="#delete_staff_modal" title="Delete"><i class="mdi mdi-delete"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Staff added!</td>
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

    <!-- Delete age group Modal -->
    <div wire:ignore.self class="modal fade" id="delete_staff_modal" tabindex="-1" aria-labelledby="delete_staff_modal_label" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <form class="forms-sample" wire:submit.prevent="DeleteStaff">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm</h1>
                <button type="button" wire:click="clearForm" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-3">
                Do you want to Delete this Staff?
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="clearForm" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </div>
        </form>

        </div>
    </div>
    </div>

</div>

@push('js')

<script>
    // Delete modal
    document.addEventListener('livewire:load', function () {
        livewire.on('closeFrom', () => {
            $('#delete_staff_modal').modal('hide')
        });
    });
</script>
    
@endpush
