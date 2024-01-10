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
                            <div class="col-6">Insert Field Data</div>
                            <div class="col-6">
                                <a href="{{ route('admin.report') }}" class="btn btn-primary btn-sm text-white" style="float: right;">Back</a>
                            </div>
                        </div>
                    </h4>

                    <form class="forms-sample" wire:submit.prevent="saveForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="district_id">Form</label>
                                    <select wire:model.live="form_id" class="form-control form-control-sm text-dark" >
                                        <option value="" class="fw-bold">Select Form</option>
                                        @foreach ($formsAttributes as $formsAttribute)
                                            <option value="{{ $formsAttribute->id }}">{{ $formsAttribute->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('form_id') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="scanning_name">Scanning Name</label>
                                    <input type="text" wire:model="scanning_name" class="form-control form-control-sm">
                                    @error('scanning_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{--  <div class="col-md-3">
                                <div class="form-group">
                                    <label >Region</label>
                                    <select wire:model.live="region_id" class="form-control form-control-sm text-dark" >
                                        <option value="" class="fw-bold">Select Region</option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('region_id') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>  --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="district_id">District</label>
                                    <select wire:model.live="district_id" class="form-control form-control-sm text-dark" >
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
                                    <label for="district_id">Ward</label>
                                    <select wire:model="ward_id" class="form-control form-control-sm text-dark" >
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
                                    <label for="scanning_name">Address</label>
                                    <input type="text" wire:model="address" class="form-control form-control-sm">
                                    @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            
                            </div>
                            <div class="col-md-12 table-responsive" >
                                <table class="formData table table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th>Age Group</th>
                                        @foreach($attributeList as $attribute)
                                            <th colspan="2">{{ $attribute->name }}</th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th></th>
                                        @foreach($attributeList as $attribute)
                                            <th>F</th>
                                            <th>M</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ageGroups as $ageGroup)
                                        <tr>
                                            <td>{{ $ageGroup->slug }}</td>
                                            @foreach($attributeList as $attribute)
                                                <td>
                                                    <input type="number" style="width: 60px" min="0"  wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.F">
                                                </td>
                                                <td>
                                                    <input type="number" style="width: 60px" min="0" wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.M">
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>Total</td>
                                        @foreach($attributeList as $attribute)
                                            <td>{{ $this->calculateTotal($attribute->id, 'F') }}</td>
                                            <td>{{ $this->calculateTotal($attribute->id, 'M') }}</td>
                                        @endforeach
                                    </tr>

                                    <!-- Add Grand Total row -->
                                    <tr>
                                        <td>Grand Total</td>
                                        @foreach($attributeList as $attribute)
                                            <td colspan="2">{{ $this->calculateTotal($attribute->id, 'F') + $this->calculateTotal($attribute->id, 'M') }}</td>
                                        @endforeach
                                        {{--  @if(!empty($attributeList))
                                            {{ $attributeList->links() }}
                                            
                                        @endif  --}}
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mt-3 mb-2">
                            <button type="submit" class="btn btn-primary text-white" style="float: right;">Save</button>
{{--                            <button type="button" wire:loading wire:target="saveForm" class="btn btn-success text-white" style="float: right;" disabled="disabled">Saving...</button>--}}
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


