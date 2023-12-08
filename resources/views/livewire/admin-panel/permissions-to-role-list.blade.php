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
                            <div class="col-6">Roles with Permissions</div>
                            <div class="col-6">
                                <a href="{{ route('admin.add.permissions.role') }}" class="btn btn-primary btn-sm text-white" style="float: right;">Assign Permissions to Role</a>
                            </div>
                        </div>
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Permission(s)</th>
                                    <th>Action</th>
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
                                        @forelse ($RolesPermissions as $permission)
                                            @if ($Role->id == $permission->role_id)
                                                <span class="badge rounded bg-success">
                                                {{ $permission->permission_name }}
                                                </span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.edit.permissions.role', ['role_id' => $Role->id ]) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-pen"></i></a>
                                        <button class="btn btn-danger btn-sm" wire:click="prepareDeleteRolesInPermission('{{$Role->id}}')" data-bs-toggle="modal" data-bs-target="#delete_permissions_role_modal" title="Delete"><i class="mdi mdi-delete"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Role with Permissions found</td>
                                </tr>
                                @endforelse
                               
                            </tbody>
                        </table>
                        {{ $Roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
  
  <!-- Delete age group Modal -->
  <div wire:ignore.self class="modal fade" id="delete_permissions_role_modal" tabindex="-1" aria-labelledby="delete_permissions_role_modal_label" aria-hidden="true">
    <div class="modal-dialog">
     <div class="modal-content">
       <form class="forms-sample" wire:submit.prevent="DeleteRolesInPermission">
           <div class="modal-header">
               <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm</h1>
               <button type="button" wire:click="clearForm" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body px-3">
               Do you want to Delete this Data?
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
        // livewire.on('prepareDeletePermission', () => {
        //     $('#delete_permission_modal').modal('show')
        // });
        livewire.on('closeFrom', () => {
            $('#delete_permission_modal').modal('hide')
        });
    });
</script>
    
@endpush