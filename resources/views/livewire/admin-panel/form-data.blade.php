<div>
    <div class="row">
        <div class="col-lg-12">
            @if (session()->has('already_exist'))
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
                            <div class="col-6">{{ $form->scanning_name }}</div>
                            <div class="col-6">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_attribute_modal" style="float: right;">Back</i></button>
                            </div>
                        </div>
                    </h4>

                    <form class="forms-sample" wire:submit.prevent="saveForm">
                        <div class="form-group">
                            <label for="scanning_name">Attribute name</label>
                            <input type="text" wire:model="scanning_name" class="form-control form-control-sm" id="scanning_name" placeholder="Enter Form name">
                            @error('scanning_name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group">
                            <label for="scanning_name">Age group</label>
                            <input type="text" wire:model="scanning_name" class="form-control form-control-sm" id="scanning_name" placeholder="Enter Form name">
                            @error('scanning_name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="male">Male</label>
                                    <input type="number" wire:model="male" class="form-control form-control-sm" id="male" min="0" placeholder="0">
                                    @error('male') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="male">Female</label>
                                    <input type="number" wire:model="male" class="form-control form-control-sm" id="male" min="0" placeholder="0">
                                    @error('male') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 mb-2">
                            <button type="submit" wire:loading.remove wire:target="saveForm" class="btn btn-primary text-white" style="float: right;">Save</button>
                            <button type="button" wire:loading wire:target="saveForm" class="btn btn-success text-white" style="float: right;" disabled="disabled">Saving...</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
