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
                                <a href="{{ route('admin.add_form_attributes') }}" class="btn btn-primary btn-sm text-white" style="float: right;"><i class="mdi mdi-plus"></i> Create From Attribute</a>
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
                                @forelse ($form_attributes as $key => $form_attribute)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        {{ $form_attribute->name }}
                                    </td>
                                    <td class="text-center">
                                        {{-- <button class="btn btn-primary btn-sm" wire:click="ViewCustomer('{{$customer->id}}')" data-bs-toggle="modal" data-bs-target="#view_customer_modal"><i class="uil-eye"></i></button> --}}
                                        <a href="{{route('admin.edit_form_attributes', ['form_id' => $form_attribute->id])}}" class="btn btn-warning btn-sm" title="Edit"><i class="mdi mdi-pen"></i></a>
                                        <button class="btn btn-danger btn-sm" wire:click="prepareData('{{$form_attribute->id}}')" title="Delete"><i class="mdi mdi-delete"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">No Attribute found</td>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>
                        {{ $form_attributes->links() }}
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
               {{-- Do you want to Delete this Attribute? --}}
               Not working for now. Close this Pop up
           </div>
           <div class="modal-footer">
               <button type="button" wire:click="clearForm" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
               <button type="submit" disabled class="btn btn-danger" data-bs-dismiss="modal">Yes, Delete</button>
           </div>
       </form>

     </div>
   </div>
 </div>

</div>

@push('js')

<script>
    
    window.addEventListener('openDeleteModal', event => {
        $('#delete_form_attribute_modal').modal('show');
    });

    window.addEventListener('closeForm', event => {
        $('#delete_form_attribute_modal').modal('hide');
    });

</script>

@endpush
