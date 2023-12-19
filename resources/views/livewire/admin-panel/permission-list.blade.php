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
                            <div class="col-6">Permissions</div>
                            <div class="col-6">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <button type="button" class="btn btn-success btn-sm text-white" data-bs-toggle="modal" data-bs-target="#export_permission_modal">Export</button>
                                &nbsp;
                                <button type="button" class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#import_permission_modal">Import</button>
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <button type="button" class="btn btn-primary btn-sm text-white" data-bs-toggle="modal" data-bs-target="#permission_form_modal"  style="float: right;">Add Permission</button>
                            </div>
                        </div>
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Group name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i = 1;
                                @endphp
                                @forelse ($permissions as $permission)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->group_name }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-warning btn-sm" wire:loading.remove wire:target="prepareData('{{$permission->id}}', 'edit')" wire:click="prepareData('{{$permission->id}}', 'edit')" title="Edit"><i class="mdi mdi-pen"></i></button>
                                        <button class="btn btn-warning btn-sm" wire:loading wire:loading.attr="disabled" wire:target="prepareData('{{$permission->id}}', 'edit')"><i class="mdi mdi-autorenew"></i></button>
                                        <button class="btn btn-danger btn-sm" wire:loading.remove wire:target="prepareData('{{$permission->id}}', 'delete')" wire:click="prepareData('{{$permission->id}}', 'delete')" title="Delete"><i class="mdi mdi-delete"></i></button>
                                        <button class="btn btn-danger btn-sm" wire:loading wire:loading.attr="disabled" wire:target="prepareData('{{$permission->id}}', 'delete')"><i class="mdi mdi-autorenew"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Permission found</td>
                                </tr>
                                @endforelse
                               
                            </tbody>
                        </table>
                        {{ $permissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
  
  <!-- Add and Edit age group Modal -->
  <div wire:ignore.self class="modal fade" id="permission_form_modal" tabindex="-1" aria-labelledby="permission_form_modal_label" aria-hidden="true">
    <div class="row justify-content-center mt-3 mb-0">
        <div class="col-5">
            @if (session()->has('already_exist'))
                @include('partial.alert')
            @endif
        </div>
    </div>
     <div class="modal-dialog">
      <div class="modal-content">
        <form class="forms-sample" wire:submit.prevent="{{ $editMode == true ? 'updatePermission' : 'savePermission' }}">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $editMode == true ? 'Edit Permission' : 'Add Permission' }}</h1>
                <button type="button" wire:click="clearForm" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-3">
                <div class="form-group">
                    <label for="permission_name">Name</label>
                    <input type="text" wire:model="permission_name" class="form-control form-control-sm" id="permission_name" placeholder="Enter Permission name">
                    @error('permission_name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
           
                <div class="form-group">
                    <label for="group_name">Group name</label>
                    <input type="text" wire:model="group_name" class="form-control form-control-sm" id="group_name" placeholder="Enter Group name">
                    @error('group_name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="clearForm" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                @if($editMode)
                <button type="submit" wire:loading.remove wire:target="updatePermission" class="btn btn-primary">Update</button>
                <button type="submit" wire:loading wire:loading.attr="disabled" wire:target="updatePermission" class="btn btn-primary">Updating...</button>
                @else
                <button type="submit" wire:loading.remove wire:target="savePermission" class="btn btn-primary">Save</button>
                <button type="submit" wire:loading wire:loading.attr="disabled" wire:target="savePermission" class="btn btn-primary">Saving...</button>
                @endif
            </div>
        </form>

      </div>
    </div>
  </div>

  <!-- Delete age group Modal -->
  <div wire:ignore.self class="modal fade" id="delete_permission_modal" tabindex="-1" aria-labelledby="delete_permission_modal_label" aria-hidden="true">
    <div class="modal-dialog">
     <div class="modal-content">
       <form class="forms-sample" wire:submit.prevent="DeletePermission">
           <div class="modal-header">
               <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm</h1>
               <button type="button" wire:click="clearForm" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body px-3">
               Do you want to Delete this Permission?
           </div>
           <div class="modal-footer">
               <button type="button" wire:click="clearForm" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
               <button type="submit" wire:loading.remove wire:target="DeletePermission" class="btn btn-danger">Yes, Delete</button>
               <button type="submit" wire:loading wire:loading.attr="disabled" wire:target="DeletePermission" class="btn btn-danger">Deleting...</button>
           </div>
       </form>

     </div>
   </div>
 </div>

</div>

@push('js')

<script>

    window.addEventListener('openForm', event => {
        $('#permission_form_modal').modal('show');
    });

    window.addEventListener('openDeleteModal', event => {
        $('#delete_permission_modal').modal('show');
    });

    window.addEventListener('closeForm', event => {
        $('#permission_form_modal').modal('hide');
        $('#delete_permission_modal').modal('hide');
    });

</script>
    
@endpush