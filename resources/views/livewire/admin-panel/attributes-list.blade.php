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
                            <div class="col-6">Attributes</div>

                            @if (auth()->user()->can('add attribute'))
                                <div class="col-6">
                                    <button type="button" class="btn btn-primary btn-sm text-white" data-bs-toggle="modal" data-bs-target="#attribute_form_modal" style="float:  right;"><i class="mdi mdi-plus"></i> Add Attribute</button>
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
                                    @if ((auth()->user()->can('edit attribute')) || (auth()->user()->can('delete attribute')))
                                        <th>Action</th>
                                    @endif  
                                    
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i = 1;
                                @endphp
                                @forelse ($attributes as $attribute)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $attribute->name }}</td>
                                    {{--  <td>{{ $attribute->attribute_no }}</td>  --}}

                                    @if ((auth()->user()->can('edit attribute')) || (auth()->user()->can('delete attribute')))

                                        <td class="text-center">
                                            {{-- <button class="btn btn-primary btn-sm" wire:click="ViewCustomer('{{$customer->id}}')" data-bs-toggle="modal" data-bs-target="#view_customer_modal"><i class="uil-eye"></i></button> --}}
                                            @if (auth()->user()->can('edit attribute'))
                                                <button class="btn btn-warning btn-sm" wire:click="prepareData('{{$attribute->id}}', 'edit')" title="Edit"><i class="mdi mdi-pen"></i></button>
                                            @endif  

                                            @if (auth()->user()->can('edit attribute'))
                                                <button class="btn btn-danger btn-sm" wire:click="prepareData('{{$attribute->id}}', 'delete')" title="Delete"><i class="mdi mdi-delete"></i></button>
                                            @endif  

                                        </td>
                                    @endif  

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">No Attribute found</td>
                                </tr>
                                @endforelse
                               
                            </tbody>
                        </table>
                        {{ $attributes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
  
  <!-- Add and Edit age group Modal -->
  <div wire:ignore.self class="modal fade" id="attribute_form_modal" tabindex="-1" aria-labelledby="attribute_form_modal_label" aria-hidden="true">
    <div class="row justify-content-center mt-3 mb-0">
        <div class="col-5">
            @if (session()->has('already_exist'))
                @include('partial.alert')
            @endif
        </div>
    </div> 
     
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="forms-sample" wire:submit.prevent="{{ $editMode == true ? 'updateAttribute' : 'saveAttribute' }}">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $editMode == true ? 'Edit Attribute' : 'Add Attribute' }}</h1>
                <button type="button" wire:click="clearForm" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-3">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" wire:model="name" class="form-control form-control-sm" id="name" placeholder="Enter Attribute name">
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                {{-- <div class="form-group">
                    <label for="attribute_no">Attribute number</label>
                    <input type="number" wire:model="attribute_no" class="form-control form-control-sm" id="attribute_no" placeholder="Specify Attribute number(position)">
                    @error('attribute_no') <small class="text-danger">{{ $message }}</small> @enderror
                </div> --}}
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
  <div wire:ignore.self class="modal fade" id="delete_attribute_modal" tabindex="-1" aria-labelledby="delete_attribute_modal_label" aria-hidden="true">
    <div class="modal-dialog">
     <div class="modal-content">
       <form class="forms-sample" wire:submit.prevent="DeleteAttribute">
           <div class="modal-header">
               <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm</h1>
               <button type="button" wire:click="clearForm" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body px-3">
               Do you want to Delete this Attribute?
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
    
    window.addEventListener('openForm', event => {
        $('#attribute_form_modal').modal('show');
    });

    window.addEventListener('openDeleteModal', event => {
        $('#delete_attribute_modal').modal('show');
    });

    window.addEventListener('closeForm', event => {
        $('#attribute_form_modal').modal('hide');
        $('#delete_attribute_modal').modal('hide');
    });
</script>
    
@endpush