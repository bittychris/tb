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
                            <div class="col-md-12 table-responsive">
                                <table wire:ignore.self class="formData table table-bordered table-sm">
                                    <thead wire:ignore.self>
                                    <tr wire:ignore.self>
                                        <th>Age Group</th>
                                        @foreach($attributeList as $attribute)
                                            <th colspan="2" wire:ignore>{{ $attribute->name }}</th>
                                        @endforeach
                                    </tr>
                                    <tr wire:ignore.self>
                                        <th></th>
                                        @foreach($attributeList as $attribute)
                                            <th wire:ignone>F</th>
                                            <th wire:ignone>M</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody wire:ignore.self>
                                    @foreach($ageGroups as $ageGroup)
                                        <tr wire:ignore>
                                            <td>{{ $ageGroup->slug }}</td>
                                            @foreach($attributeList as $attribute)
                                                <td wire:ignore.self>
                                                    <input type="number" style="width: 60px" min="0" id="formData-{{ $ageGroup->id }}-{{ $attribute->id }}-F" wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.F">
                                                </td>
                                                <td wire:ignore.self>
                                                    <input type="number" style="width: 60px" min="0" wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.M">
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    <tr wire:ignone.self>
                                        <td>Total</td>
                                        @foreach($attributeList as $index => $attribute)
                                            <td wire:key="{{ $index }}" wire:ignore.self>{{ $this->calculateTotal($attribute->id, 'F') }}</td>
                                            <td wire:key="{{ $index }}" wire:ignore.self>{{ $this->calculateTotal($attribute->id, 'M') }}</td>
                                        @endforeach
                                    </tr>

                                    <!-- Add Grand Total row -->
                                    <tr wire:ignore.self>
                                        <td>Grand Total</td>
                                        @foreach($attributeList as $index => $attribute)
                                            <td colspan="2" wire:key="{{ $index }}" wire:ignore.self>{{ $this->calculateTotal($attribute->id, 'F') + $this->calculateTotal($attribute->id, 'M') }}</td>
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>

                                {{-- <table wire:ignore.self class="formData table table-bordered table-sm">
                                    <thead wire:ignore.self>
                                        <tr wire:ignore.self>
                                            <th>Age Group</th>
                                            @foreach($attributeList as $attribute)
                                                <th colspan="2" wire:ignore>{{ $attribute->name }}</th>
                                            @endforeach
                                        </tr>
                                        <tr wire:ignore.self>
                                            <th></th>
                                            @foreach($attributeList as $attribute)
                                                <th wire:key="{{ 'F-' . $attribute->id }}" wire:ignore>F</th>
                                                <th wire:key="{{ 'M-' . $attribute->id }}" wire:ignore>M</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody wire:ignore.self>
                                        @foreach($ageGroups as $ageGroup)
                                            <tr wire:ignore>
                                                <td>{{ $ageGroup->slug }}</td>
                                                @foreach($attributeList as $attribute)
                                                    <td wire:key="{{ 'F-' . $ageGroup->id . '-' . $attribute->id }}" wire:ignore.self>
                                                        <input type="number" style="width: 60px" min="0" wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.F">
                                                    </td>
                                                    <td wire:key="{{ 'M-' . $ageGroup->id . '-' . $attribute->id }}" wire:ignore.self>
                                                        <input type="number" style="width: 60px" min="0" wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.M">
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        <tr wire:ignore.self>
                                            <td>Total</td>
                                            @foreach($attributeList as $index => $attribute)
                                                <td wire:key="{{ 'F-total-' . $attribute->id }}" wire:ignore.self>{{ $this->calculateTotal($attribute->id, 'F') }}</td>
                                                <td wire:key="{{ 'M-total-' . $attribute->id }}" wire:ignore.self>{{ $this->calculateTotal($attribute->id, 'M') }}</td>
                                            @endforeach
                                        </tr>
                                        
                                        <!-- Add Grand Total row -->
                                        <tr wire:ignore.self>
                                            <td>Grand Total</td>
                                            @foreach($attributeList as $index => $attribute)
                                                <td colspan="2" wire:key="{{ 'total-' . $attribute->id }}" wire:ignore.self>{{ $this->calculateTotal($attribute->id, 'F') + $this->calculateTotal($attribute->id, 'M') }}</td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table> --}}
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

@push('script')
    <script>
 $(document).ready(function() {

// Check the value of the input field every second

setInterval(function() {

    // Loop through all number inputs

    $("[type='number']").each(function() {

        var inputValue = $(this).val();

        if (inputValue === "") {

            // If the input field is empty, set its value to 0

            $(this).val(0);

        }

    });

}, 0.5);

});
    </script>
@endpush

