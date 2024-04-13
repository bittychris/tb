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
                            <div class="col-6">Create Form</div>
                        </div>
                    </h4>

                    <form class="forms-sample" wire:submit.prevent="saveForm">
                        <div class="form-group">
                            <label for="scanning_name">Scanning name</label>
                            <input type="text" wire:model="scanning_name" class="form-control form-control-sm" id="scanning_name" placeholder="Enter Form name">
                            @error('scanning_name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="district_id">District</label>
                                    <select wire:model="district_id" class="form-control form-control-sm text-dark" id="district_id">
                                        <option value="" class="fw-bold">Select District</option>
                                        @foreach ($districts as $district)
                                        
                                            <option value="{{ $district->id }}">{{ $district->name }}</option>
        
                                        @endforeach
                                    </select>
                                    @error('district_id') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ward_id">Ward</label>
                                    <select wire:model="ward_id" class="form-control form-control-sm text-dark" id="ward_id">
                                        <option value="" class="fw-bold">Select Ward</option>
                                        @foreach ($wards as $ward)
                                        
                                            <option value="{{ $ward->id }}">{{ $ward->name }}</option>
        
                                        @endforeach
                                    </select>
                                    @error('ward_id') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" wire:model="address" class="form-control form-control-sm" id="address" placeholder="Enter Address">
                                    @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                                <div class="form-group">
                                    <label for="rc_name">Created by: {{ $rc_name }}</label>
                                </div>
                        </div>

                        <div class="mt-3 mb-2">
                            <button type="submit" wire:loading.remove wire:target="saveForm" class="btn btn-primary text-white" style="float: right;">Continue</button>
                            <button type="button" wire:loading wire:target="saveForm" class="btn btn-success text-white" style="float: right;" disabled="disabled">Loading...</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
