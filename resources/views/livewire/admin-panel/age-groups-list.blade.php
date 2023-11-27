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
                            <div class="col-6">Age groups</div>
                            <div class="col-6">
                                <button type="button" class="btn btn-primary btn-sm text-white" data-bs-toggle="modal" data-bs-target="#add_age_group_modal" style="float: right;"><i class="mdi mdi-plus"></i> Add Age group</button>
                            </div>
                        </div>
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Age group</th>
                                    <th>Min age</th>
                                    <th>Max age</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i = 1;
                                @endphp
                                @forelse ($ageGroups as $ageGroup)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $ageGroup->slug }}</td>
                                    <td>{{ $ageGroup->min }}</td>
                                    <td>{{ $ageGroup->max }}</td>
                                    <td class="text-center">
                                        {{-- <button class="btn btn-primary btn-sm" wire:click="ViewCustomer('{{$customer->id}}')" data-bs-toggle="modal" data-bs-target="#view_customer_modal"><i class="uil-eye"></i></button> --}}
                                        <button class="btn btn-warning btn-sm" wire:click="prepareEditAgeGroup('{{$ageGroup->id}}')" data-bs-toggle="modal" data-bs-target="#edit_age_group_modal" title="Edit"><i class="mdi mdi-pen"></i></button>
                                        <button class="btn btn-danger btn-sm" wire:click="prepareDeleteAgeGroup('{{$ageGroup->id}}')" data-bs-toggle="modal" data-bs-target="#delete_age_group_modal" title="Delete"><i class="mdi mdi-delete"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Age group found</td>
                                </tr>
                                @endforelse
                               
                            </tbody>
                        </table>
                        {{ $ageGroups->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
  
  <!-- Add and Edit age group Modal -->
  <div wire:ignore.self class="modal fade" id="{{ $editMode == true ? 'edit_age_group_modal' : 'add_age_group_modal' }}" tabindex="-1" aria-labelledby="add_age_group_modal_label" aria-hidden="true">
    <div class="row justify-content-center mt-3 mb-0">
        <div class="col-5">
            @if (session()->has('already_exist'))
                @include('partial.alert')
            @endif
        </div>
    </div>
     <div class="modal-dialog">
      <div class="modal-content">
        <form class="forms-sample" wire:submit.prevent="{{ $editMode == true ? 'updateAgeGroup' : 'saveAgeGroup' }}">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $editMode == true ? 'Edit Age Group' : 'Add Age Group' }}</h1>
                <button type="button" wire:click="clearForm" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-3">
                <div class="form-group">
                    <label for="slug">Age group</label>
                    <input type="text" wire:model="age_group_name" class="form-control form-control-sm" id="slug" placeholder="Enter Age group">
                    @error('age_group_name') <small class="text-danger">{{ $message }}</small> @enderror

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="min_age">Min age</label>
                            <input type="number" wire:model="min_age" class="form-control form-control-sm" id="min_age" min="0">
                            @error('min_age') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="max_age">Max age</label>
                            <input type="number" wire:model="max_age" class="form-control form-control-sm" id="max_age" min="0">
                            @error('max_age') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="clearForm" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                @if($editMode)
                <button type="submit" class="btn btn-primary">Update</button>
                @else
                <button type="submit" class="btn btn-primary">Save</button>
                @endif
            </div>
        </form>

      </div>
    </div>
  </div>

  <!-- Delete age group Modal -->
  <div wire:ignore.self class="modal fade" id="delete_age_group_modal" tabindex="-1" aria-labelledby="delete_age_group_modal_label" aria-hidden="true">
    <div class="modal-dialog">
     <div class="modal-content">
       <form class="forms-sample" wire:submit.prevent="DeleteAgeGroup">
           <div class="modal-header">
               <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm</h1>
               <button type="button" wire:click="clearForm" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body px-3">
               Do you want to Delete this Age group?
           </div>
           <div class="modal-footer">
               <button type="button" wire:click="clearForm" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
               <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yes, Delete</button>
           </div>
       </form>

     </div>
   </div>
 </div>

</div>

@push('js')

<script>
    // View modal
    // document.addEventListener('livewire:load', function () {
    //     // livewire.on('prepareEditAgeGroup', () => {
    //     //     $('#add_age_group_modal').modal('show')
    //     // });
    //     livewire.on('saveAgeGroup', () => {
    //         $('#add_age_group_modal').modal('hide')
    //     });
    // });

     // View modal
     document.addEventListener('livewire:load', function () {
        livewire.on('prepareEditAgeGroup', () => {
            $('#edit_age_group_modal').modal('show')
        });
        livewire.on('updateAgeGroup', () => {
            $('#edit_age_group_modal').modal('hide')
        });
    });

    // Delete modal
    document.addEventListener('livewire:load', function () {
        livewire.on('prepareDeleteAgeGroup', () => {
            $('#delete_age_group_modal').modal('show')
        });
        livewire.on('closeFrom', () => {
            $('#delete_age_group_modal').modal('hide')
        });
    });
</script>
    
@endpush