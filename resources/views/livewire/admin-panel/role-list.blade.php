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
                            <div class="col-4">Roles</div>

                            <div class="col-4">
                                <input type="text" wire:model.live="keywords" class="form-control form-control-sm" id="keywords" placeholder="Search by role name">
                            </div>

                            @if (auth()->user()->can('add role'))
                                <div class="col-4">
                                    <button type="button" class="btn btn-primary btn-sm text-white text-uppercase" data-bs-toggle="modal" data-bs-target="#role_form_modal" style="float: right;"><span class="me-2" style="font-size: 18px;">+</span> Add Role</button>
                                </div>
                            @endif

                        </div>
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    @if ((auth()->user()->can('edit role')) || (auth()->user()->can('delete role')))
                                        <th>Action</th>
                                    @endif
                                    
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i = 1;
                                @endphp
                                @forelse ($roles as $role)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $role->name }}</td>
                                    
                                    @if ((auth()->user()->can('edit role')) || (auth()->user()->can('delete role')))
                                        <td class="text-center">
                                            @if (auth()->user()->can('edit role'))
                                                <button class="btn btn-warning btn-sm text-white" wire:loading.remove wire:target="prepareData('{{$role->id}}', 'edit')" wire:click="prepareData('{{$role->id}}', 'edit')" title="Edit"><i class="mdi mdi-pen"></i></button>
                                                <button class="btn btn-warning btn-sm text-white" wire:loading wire:loading.attr="disabled" wire:target="prepareData('{{$role->id}}', 'edit')"><i class="mdi mdi-autorenew"></i></button>
                                            @endif

                                            @if (auth()->user()->can('delete role'))
                                                <button class="btn btn-danger btn-sm text-white" wire:loading.remove wire:target="prepareData('{{$role->id}}', 'delete')" wire:click="prepareData('{{$role->id}}', 'delete')" title="Delete"><i class="mdi mdi-delete"></i></button>
                                                <button class="btn btn-danger btn-sm text-white" wire:loading wire:loading.attr="disabled" wire:target="prepareData('{{$role->id}}', 'delete')"><i class="mdi mdi-autorenew"></i></button>
                                            @endif

                                        </td>
                                    @endif

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Role found!</td>
                                </tr>
                                @endforelse
                               
                            </tbody>
                        </table>
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
  
  <!-- Add and Edit age group Modal -->
  <div wire:ignore.self class="modal fade" id="role_form_modal" tabindex="-1" aria-labelledby="role_form_modal_label" aria-hidden="true">
    <div class="row justify-content-center mt-3 mb-0">
        <div class="col-5">
            @if (session()->has('already_exist'))
                @include('partial.alert')
            @endif
        </div>
    </div>
     <div class="modal-dialog">
      <div class="modal-content">
        <form class="forms-sample" wire:submit.prevent="{{ $editMode == true ? 'updateRole' : 'saveRole' }}">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $editMode == true ? 'Edit Role' : 'Add Role' }}</h1>
                <button type="button" wire:click="clearForm" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-3">
                <div class="form-group">
                    <label for="role_name">Name</label>
                    <input type="text" wire:model="role_name" class="form-control form-control-sm" id="role_name" placeholder="Enter Role name">
                    @error('role_name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="clearForm" class="btn btn-warning text-white" data-bs-dismiss="modal">Close</button>
                @if($editMode)
                <button type="submit" wire:loading.remove wire:target="updateRole" class="btn btn-success text-white">Update</button>
                <button type="submit" wire:loading wire:loading.attr="disabled" wire:target="updateRole" class="btn btn-success text-white">Updating...</button>
                @else
                <button type="submit" wire:loading.remove wire:target="saveRole" class="btn btn-primary text-white">Save</button>
                <button type="submit" wire:loading wire:loading.attr="disabled" wire:target="saveRole" class="btn btn-primary text-white">Saving...</button>
                @endif
            </div>
        </form>

      </div>
    </div>
  </div>

  <!-- Delete age group Modal -->
  <div wire:ignore.self class="modal fade" id="delete_role_modal" tabindex="-1" aria-labelledby="delete_role_modal_label" aria-hidden="true">
    <div class="modal-dialog">
     <div class="modal-content">
       <form class="forms-sample" wire:submit.prevent="DeleteRole">
           <div class="modal-header">
               <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm</h1>
               <button type="button" wire:click="clearForm" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body px-3">
               Do you want to Delete this Role?
           </div>
           <div class="modal-footer">
               <button type="button" wire:click="clearForm" class="btn btn-warning text-white" data-bs-dismiss="modal">Cancel</button>
               <button type="submit" wire:loading.remove wire:target="DeleteRole" class="btn btn-danger text-white">Yes, Delete</button>
               <button type="submit" wire:loading wire:loading.attr="disabled" wire:target="DeleteRole" class="btn btn-danger text-white">Deleting...</button>
           </div>
       </form>

     </div>
   </div>
 </div>

</div>

@push('js')

<script>
    window.addEventListener('openForm', event => {
        $('#role_form_modal').modal('show');
    });

    window.addEventListener('openDeleteModal', event => {
        $('#delete_role_modal').modal('show');
    });

    window.addEventListener('closeForm', event => {
        $('#role_form_modal').modal('hide');
        $('#delete_role_modal').modal('hide');
    });
</script>
    
@endpush