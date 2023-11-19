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
                            <div class="col-6">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_attribute_modal" style="float: right;"><i class="mdi mdi-plus"></i></button>
                            </div>
                        </div>
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i = 1;
                                @endphp
                                @forelse ($from_attributes as $from_attribute)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $from_attribute->name }}</td>
                                    <td class="text-center">
                                        {{-- <button class="btn btn-primary btn-sm" wire:click="ViewCustomer('{{$customer->id}}')" data-bs-toggle="modal" data-bs-target="#view_customer_modal"><i class="uil-eye"></i></button> --}}
                                        <button class="btn btn-warning btn-sm" wire:click="prepareEditAttribute('{{$from_attribute->id}}')" data-bs-toggle="modal" data-bs-target="#edit_attribute_modal" title="Edit"><i class="mdi mdi-pen"></i></button>
                                        <button class="btn btn-danger btn-sm" wire:click="prepareDeleteAttribute('{{$from_attribute->id}}')" data-bs-toggle="modal" data-bs-target="#delete_attribute_modal" title="Delete"><i class="mdi mdi-delete"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">No Attribute found</td>
                                </tr>
                                @endforelse
                               
                            </tbody>
                        </table>
                        {{ $from_attributes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- Delete form attrinutes Modal -->
  <div wire:ignore.self class="modal fade" id="delete_form_attribute_modal" tabindex="-1" aria-labelledby="delete_form_attribute_modal_label" aria-hidden="true">
    <div class="modal-dialog">
     <div class="modal-content">
       <form class="forms-sample" wire:submit.prevent="DeleteFormAttributes">
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
    //  // View modal
    //  document.addEventListener('livewire:load', function () {
    //     livewire.on('prepareEditAgeGroup', () => {
    //         $('#edit_age_group_modal').modal('show')
    //     });
    //     livewire.on('updateAgeGroup', () => {
    //         $('#edit_age_group_modal').modal('hide')
    //     });
    // });

    // // Delete modal
    // document.addEventListener('livewire:load', function () {
    //     livewire.on('prepareDeleteAgeGroup', () => {
    //         $('#delete_age_group_modal').modal('show')
    //     });
    //     livewire.on('closeFrom', () => {
    //         $('#delete_age_group_modal').modal('hide')
    //     });
    // });
</script>
    
@endpush