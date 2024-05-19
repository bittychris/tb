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
                            <div class="col-5">Regions</div>
                            <div class="col-4">
                                <input type="text" wire:model.live="keywords" class="form-control form-control-sm"
                                    id="keywords" placeholder="Search by Region name">
                            </div>
                            {{-- @if (auth()->user()->can('add age group')) --}}
                            <div class="col-3">
                                <button type="button" class="btn btn-primary btn-sm text-white text-uppercase"
                                    data-bs-toggle="modal" data-bs-target="#region_form_modal"
                                    style="float: right;"><span class="me-2" style="font-size: 18px;">+</span> Add
                                    Region</button>
                            </div>
                            {{-- @endif --}}

                        </div>
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Region name</th>
                                    {{-- @if (auth()->user()->can('edit age group') || auth()->user()->can('delete age group')) --}}
                                    <th>Action</th>
                                    {{-- @endif --}}

                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i = 1;
                                @endphp
                                @forelse ($regions as $region)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $region->name }}</td>

                                        <td class="text-center">
                                            <button class="btn btn-warning btn-sm text-white"
                                                wire:click="prepareData('{{ $region->id }}', 'edit')"
                                                title="Edit"><i class="mdi mdi-pen"></i></button>

                                            <button class="btn btn-danger btn-sm text-white"
                                                wire:click="prepareData('{{ $region->id }}', 'delete')"
                                                titlee="Delete"><i class="mdi mdi-delete"></i></button>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No Regions found</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        {{ $regions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add and Edit age group Modal -->
    <div wire:ignore.self class="modal fade" id="region_form_modal" tabindex="-1"
        aria-labelledby="region_form_modal_label" aria-hidden="true">
        <div class="row justify-content-center mt-3 mb-0">
            <div class="col-5">
                @if (session()->has('already_exist'))
                    @include('partial.alert')
                @endif
            </div>
        </div>
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="forms-sample"
                    wire:submit.prevent="{{ $editMode == true ? 'updateRegion' : 'saveRegion' }}">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            {{ $editMode == true ? 'Edit Region' : 'Add Region' }}</h1>
                        <button type="button" wire:click="clearForm" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-3">
                        <div class="form-group">
                            <label for="region_name">Region</label>
                            <input type="text" wire:model="region_name" class="form-control form-control-sm"
                                id="region_name" placeholder="Enter Region name">
                            @error('region_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="clearForm" class="btn btn-warning text-white"
                            data-bs-dismiss="modal">Close</button>
                        @if ($editMode)
                            <button type="submit" class="btn btn-success text-white">Update</button>
                        @else
                            <button type="submit" class="btn btn-success text-white">Save</button>
                        @endif
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Delete age group Modal -->
    <div wire:ignore.self class="modal fade" id="delete_region_modal" tabindex="-1"
        aria-labelledby="delete_region_modal_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="forms-sample" wire:submit.prevent="DeleteRegion">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm</h1>
                        <button type="button" wire:click="clearForm" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-3">
                        Do you want to Delete this Region?
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="clearForm" class="btn btn-warning text-white"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger text-white" data-bs-dismiss="modal">Yes,
                            Delete</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>

@push('js')
    <script>
        window.addEventListener('openForm', event => {
            $('#region_form_modal').modal('show');
        });

        window.addEventListener('openDeleteModal', event => {
            $('#delete_region_modal').modal('show');
        });

        window.addEventListener('closeForm', event => {
            $('#region_form_modal').modal('hide');
            $('#delete_region_modal').modal('hide');
        });
    </script>
@endpush
