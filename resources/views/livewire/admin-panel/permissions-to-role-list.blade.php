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
                            <div class="col-5">Roles with Permissions</div>

                            <div class="col-4">
                                <input type="text" wire:model.live="keywords" class="form-control form-control-sm"
                                    id="keywords" placeholder="Search by role name">
                            </div>

                            @if (auth()->user()->can('assign permissions to role'))
                                <div class="col-3">
                                    <a href="{{ route('admin.add.permissions.role') }}"
                                        class="btn btn-primary btn-sm text-white" style="float: right;">Assign
                                        Permissions to Role</a>
                                </div>
                            @endif

                        </div>
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Overall Permission</th>

                                    @if (auth()->user()->can('edit assigned permissions to role') ||
                                            auth()->user()->can('delete roles permissions'))
                                        <th>Action</th>
                                    @endif

                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i = 1;
                                @endphp
                                @forelse ($Roles as $Role)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $Role->name }}</td>
                                        <td>
                                            {{-- @foreach ($RolesPermissions as $permission) --}}
                                            @if ($Role->name == 'Admin')
                                                <span class="badge rounded bg-success">
                                                    Administrate the whole system
                                                </span>
                                            @elseif ($Role->name == 'AMREF personnel')
                                                <span class="badge rounded bg-success">
                                                    Access report processes
                                                </span>
                                            @elseif ($Role->name == 'Regional coordinator')
                                                <span class="badge rounded bg-success">
                                                    Access field data processes
                                                </span>
                                            @endif
                                            {{-- @endforeach --}}
                                        </td>

                                        @if (auth()->user()->can('edit assigned permissions to role') ||
                                                auth()->user()->can('delete roles permissions'))
                                            <td class="text-center">
                                                @if (auth()->user()->can('edit assigned permissions to role'))
                                                    <a href="{{ route('admin.edit.permissions.role', ['role_id' => $Role->id]) }}"
                                                        class="btn btn-info btn-sm text-white" disabled
                                                        title="View"><i class="mdi mdi-eye"></i></a>
                                                @endif

                                                {{-- @if (auth()->user()->can('delete roles permissions'))
                                                    <button class="btn btn-danger btn-sm text-white"
                                                        wire:click="prepareDeleteRolesInPermission('{{ $Role->id }}')"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete_permissions_role_modal" title="Delete"
                                                        disabled><i class="mdi mdi-delete"></i></button>
                                                @endif --}}

                                            </td>
                                        @endif

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No Role with Permissions found</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        {{-- {{ $Roles->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete age group Modal -->
    <div wire:ignore.self class="modal fade" id="delete_permissions_role_modal" tabindex="-1"
        aria-labelledby="delete_permissions_role_modal_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="forms-sample" wire:submit.prevent="DeleteRolesInPermission">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm</h1>
                        <button type="button" wire:click="clearForm" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-3">
                        Do you want to Delete this Data?
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="clearForm" class="btn btn-warning text-white"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" wire:loading.remove wire:target="DeleteRolesInPermission"
                            class="btn btn-danger text-white">Yes, Delete</button>
                        <button type="submit" wire:loading wire:loading.attr="disabled"
                            wire:target="DeleteRolesInPermission" class="btn btn-danger text-white">Deleting...</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>

@push('js')
    <script>
        // Delete modal
        window.addEventListener('openDeleteModal', event => {
            $('#delete_permissions_role_modal').modal('show');
        });

        window.addEventListener('closeForm', event => {
            $('#delete_permissions_role_modal').modal('hide');
        });
    </script>
@endpush
