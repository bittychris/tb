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
                            <div class="col-7">{{ $editMode == true ? 'Edit Field Data' : 'Insert Field Data' }}</div>
                            {{-- <div class="col-3">
                                <button type="button" wire:click="openUploadModal"
                                    class="btn btn-danger btn-sm text-white text-uppercase d-flex align-items-center"
                                    style="float: right;"><i class="mdi mdi-upload me-2"
                                        style="font-size: 14px;"></i>Import Data</button>
                            </div> --}}
                            <div class="col-2">
                                <a href="{{ route('admin.report') }}" class="btn btn-primary btn-sm text-white"
                                    style="float: right;">Back</a>
                            </div>
                        </div>
                    </h4>

                    <form class="forms-sample" wire:submit.prevent="saveForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="district_id">Form</label>
                                    <select wire:model.live="form_id" class="form-control form-control-sm text-dark">
                                        <option value="" class="fw-bold">Select Form</option>
                                        @foreach ($formsAttributes as $formsAttribute)
                                            <option value="{{ $formsAttribute->id }}">{{ $formsAttribute->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('form_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="scanning_name">Scanning Name</label>
                                    <input type="text" wire:model="scanning_name"
                                        class="form-control form-control-sm">
                                    @error('scanning_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="district_id">District</label>
                                    <select wire:model.live="district_id"
                                        class="form-control form-control-sm text-dark">
                                        <option value="" class="fw-bold">Select District</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('district_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="district_id">Ward</label>
                                    <select wire:model="ward_id" class="form-control form-control-sm text-dark">
                                        <option value="" class="fw-bold">Select Ward</option>
                                        @foreach ($wards as $ward)
                                            <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('ward_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="scanning_name">Address</label>
                                    <input type="text" wire:model="address" class="form-control form-control-sm">
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="created_at">Date</label>
                                    @if ($editMode == true)
                                        <input type="text" readonly disabled
                                            wire:model="created_at"class="form-control form-control-sm">
                                    @else
                                        <input type="date" wire:model="created_at"
                                            class="form-control form-control-sm">
                                    @endif
                                    @error('created_at')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 table-responsive">

                                {{-- @if ($color == 'danger')
                                    <div class="row mx-2 text-danger" style="font-size: 13px;">
                                        Summary for other Columns:
                                    </div>
                                    <div class="row mx-5 mb-3" style="font-size: 13px;">
                                        <div class="col-md-4 ms-3">
                                            Total Female:
                                            <div class="row mx-2">
                                                <div class="col-12">
                                                    Age Group 0-5 and 6-14 = {{ $total_one_female }}
                                                </div>
                                                <div class="col-12">
                                                    Age Group 15 & Above = {{ $total_two_female }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            Total Male:
                                            <div class="row mx-2">
                                                <div class="col-12">
                                                    Age Group 0-5 and 6-14 = {{ $total_one_male }}
                                                </div>
                                                <div class="col-12">
                                                    Age Group 15 & Above = {{ $total_two_male }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif --}}
                                <table class="formData table table-bordered table-sm">
                                    
                                    <thead>
                                        <tr>
                                            <th>Age Group</th>
                                            @foreach ($attributeList as $attribute)
                                                @if ($attribute->attribute_no == 1.0)
                                                    <th colspan="2" class="text-{{ $color }}">
                                                        {{ $attribute->name }}
                                                    </th>
                                                @elseif ($attribute->attribute_no == 0.1)
                                                    <th colspan="2" class="text-{{ $color }}">
                                                        {{ $attribute->name }}
                                                    </th>
                                                @elseif ($attribute->attribute_no == 0.2)
                                                    <th colspan="2" class="text-{{ $color }}">
                                                        {{ $attribute->name }}
                                                    </th>
                                                @else
                                                    <th colspan="2">{{ $attribute->name }}</th>
                                                @endif
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th></th>
                                            @foreach ($attributeList as $attribute)
                                                {{-- @if ($attribute->attribute_no == 1.0)
                                                <th class="text-danger" style="border-bottom-color: {{ $color }};">F</th>
                                                <th class="text-danger" style="border-bottom-color: {{ $color }};">M</th>
                                            @else --}}
                                                <th>F</th>
                                                <th>M</th>
                                                {{-- @endif --}}
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ageGroups as $ageGroup)
                                            <tr>
                                                <td>{{ $ageGroup->slug }}</td>
                                                @foreach ($attributeList as $attribute)
                                                    {{-- @php
                                                        if (!empty($formData[$ageGroup->id][$attribute->id]['F'])) {
                                                            // $prev_value = '';
                                                            $prev_value[$ageGroup->id][$attribute->id]['F'] = $formData[$ageGroup->id][$attribute->id]['F'];
                                                        }

                                                    @endphp --}}
                                                    @if ($attribute->attribute_no == 1.0)
                                                    <?php 
                                                        $af = $formData[$ageGroup->id][$attribute->id]['F'] ?? 0;
                                                    ?>
                                                        <td>
                                                            <input type="number" style="width: 60px;" min="0"
                                                                class="{{ $ageGroup->slug == '0-5' ? 'bg-dark' : '' }}"
                                                                value="0"
                                                                {{ $ageGroup->slug == '0-5' ? 'disabled' : '' }}
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.F"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['F'] ?? 0 }}"
                                                                wire:change="validateInput({{ $ageGroup->id, $attribute->id, 'F' }})">
                                                            {{-- @php
                                                                if (!empty($formData[$ageGroup->id][$attribute->id]['F'])) {
                                                                    // $prev_value = '';
                                                                    $prev_value[$ageGroup->id][$attribute->id]['F'] = $formData[$ageGroup->id][$attribute->id]['F'];
                                                                }

                                                            @endphp --}}
                                                        </td>
                                                        <td>
                                                            <?php 
                                                               $am = $formData[$ageGroup->id][$attribute->id]['M'] ?? 0;
                                                            ?>
                                                            <input type="number" style="width: 60px;" 
                                                                class="{{ $ageGroup->slug == '0-5' ? 'bg-dark' : '' }}"
                                                                value="0"
                                                                {{ $ageGroup->slug == '0-5' ? 'disabled' : '' }}
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.M"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['M'] ?? 0 }}">
                                                               
                                                        </td>
                                                    @elseif ($attribute->attribute_no == 10.0)
                                                        <td>
                                                            <input type="number" style="width: 60px;" min="0"
                                                                class="{{ $ageGroup->slug == '6-14' || $ageGroup->slug == '15 & above' ? 'bg-dark' : '' }}"
                                                                value="0"
                                                                {{ $ageGroup->slug == '6-14' || $ageGroup->slug == '15 & above' ? 'disabled' : '' }}
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.F"
                                                                wire:change="testedSum({{$formData[$ageGroup->id][$attribute->id]['F'] ?? 0 }})"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['F'] ?? 0 }}">
                                                        </td>
                                                        <td>
                                                            <input type="number" style="width: 60px;" min="0"
                                                                class="{{ $ageGroup->slug == '6-14' || $ageGroup->slug == '15 & above' ? 'bg-dark' : '' }}"
                                                                value="0"
                                                                {{ $ageGroup->slug == '6-14' || $ageGroup->slug == '15 & above' ? 'disabled' : '' }}
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.M"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['M'] ?? 0 }}">
                                                        </td>
                                                    @elseif ($attribute->attribute_no == 12.0)
                                                        <td>
                                                            <input type="number" style="width: 60px;" min="0"
                                                                readonly disabled
                                                                {{-- wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.F" --}}
                                                                value="{{ $sum }}">
                                                            {{-- {{ $this->calculateTotalConfirmed($attribute->id, 'F') }} --}}
                                                        </td>
                                                        <td>
                                                            <input type="number" style="width: 60px;" min="0"
                                                                readonly value="0" disabled
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.M"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['M'] ?? 0 }}">
                                                        </td>
                                                    @elseif ($attribute->attribute_no == 2.0)
                                                        <?php 
                                                                $bm = $formData[$ageGroup->id][$attribute->id]['M'] ?? 0;
                                                                $bf = $formData[$ageGroup->id][$attribute->id]['F'] ?? 0;

                                                            ?>
                                                        <td>


                                                            <input type="number" style="width: 60px;" min="0" max='{{ $ageGroup->slug == '0-5' ? '' : $af }}'
                                                                id="formData-{{ $ageGroup->id }}-{{ $attribute->id }}-F"
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.F"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['F'] ?? 0 }}"
                                                                wire:change="validateInput({{ $ageGroup->id, $attribute->id, 'F' }})">
                                                            {{-- {{ !empty($prev_value[$ageGroup->id][$attribute->id]['F']) ? $prev_value[$ageGroup->id][$attribute->id]['F'] : '' }} --}}
                                                        </td>
                                                        <td>
                                                            <input type="number" style="width: 60px;" min="0" max='{{ $ageGroup->slug == '0-5' ? '' : $am }}'
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.M"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['M'] ?? 0 }}">
                                                        </td>
                                                    @elseif ($attribute->attribute_no == 3.0)
                                                        <?php 
                                                                $cm = $formData[$ageGroup->id][$attribute->id]['M'] ?? 0;
                                                                $cf = $formData[$ageGroup->id][$attribute->id]['F'] ?? 0;
                                                            ?>
                                                        <td>


                                                            <input type="number" style="width: 60px;" min="0" max='{{ $bf }}'
                                                                id="formData-{{ $ageGroup->id }}-{{ $attribute->id }}-F"
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.F"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['F'] ?? 0 }}"
                                                                wire:change="validateInput({{ $ageGroup->id, $attribute->id, 'F' }})">
                                                            {{-- {{ !empty($prev_value[$ageGroup->id][$attribute->id]['F']) ? $prev_value[$ageGroup->id][$attribute->id]['F'] : '' }} --}}
                                                        </td>
                                                        <td>
                                                            <input type="number" style="width: 60px;" min="0" max='{{ $bm }}'
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.M"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['M'] ?? 0 }}">
                                                        </td>
                                                    @elseif ($attribute->attribute_no == 4.0)
                                                        <?php 
                                                                $dm = $formData[$ageGroup->id][$attribute->id]['M'] ?? 0;
                                                                $df = $formData[$ageGroup->id][$attribute->id]['F'] ?? 0;
                                                            ?>
                                                        <td>


                                                            <input type="number" style="width: 60px;" min="0" max='{{ $cf }}'
                                                                id="formData-{{ $ageGroup->id }}-{{ $attribute->id }}-F"
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.F"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['F'] ?? 0 }}"
                                                                wire:change="validateInput({{ $ageGroup->id, $attribute->id, 'F' }})">
                                                            {{-- {{ !empty($prev_value[$ageGroup->id][$attribute->id]['F']) ? $prev_value[$ageGroup->id][$attribute->id]['F'] : '' }} --}}
                                                        </td>
                                                        <td>
                                                            <input type="number" style="width: 60px;" min="0" max='{{ $cm }}'
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.M"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['M'] ?? 0 }}">
                                                        </td>
                                                    @elseif ($attribute->attribute_no == 5.0)
                                                        <?php 
                                                                $em = $formData[$ageGroup->id][$attribute->id]['M'] ?? 0;
                                                                $ef = $formData[$ageGroup->id][$attribute->id]['F'] ?? 0;
                                                            ?>
                                                        <td>


                                                            <input type="number" style="width: 60px;" min="0" max='{{ $df }}'
                                                                id="formData-{{ $ageGroup->id }}-{{ $attribute->id }}-F"
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.F"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['F'] ?? 0 }}"
                                                                wire:change="validateInput({{ $ageGroup->id, $attribute->id, 'F' }})">
                                                            {{-- {{ !empty($prev_value[$ageGroup->id][$attribute->id]['F']) ? $prev_value[$ageGroup->id][$attribute->id]['F'] : '' }} --}}
                                                        </td>
                                                        <td>
                                                            <input type="number" style="width: 60px;" min="0" max='{{ $dm }}'
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.M"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['M'] ?? 0 }}">
                                                        </td>
                                                    @else
                                                        <td>
                                                            @php
                                                                $value = $formData[$ageGroup->id][$attribute->id]['F'] ?? 0;
                                                            @endphp

                                                            <input type="number" style="width: 60px;" min="0" 
                                                                id="formData-{{ $ageGroup->id }}-{{ $attribute->id }}-F"
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.F"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['F'] ?? 0 }}"
                                                                wire:change="testedSum({{$formData[$ageGroup->id][$attribute->id]['F'] ?? 0 }})">
                                                                {{$value}}
                                                            {{-- {{ !empty($prev_value[$ageGroup->id][$attribute->id]['F']) ? $prev_value[$ageGroup->id][$attribute->id]['F'] : '' }} --}}
                                                        </td>
                                                        <td>
                                                            <input type="number" style="width: 60px;" min="0" max='{{ $em }}'
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.M"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['M'] ?? 0 }}">
                                                        </td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td>Total</td>
                                            @foreach ($attributeList as $attribute)
                                                <td>{{ $this->calculateTotal($attribute->id, 'F') }}</td>
                                                <td>{{ $this->calculateTotal($attribute->id, 'M') }}</td>
                                            @endforeach
                                        </tr>

                                        <!-- Add Grand Total row -->
                                        <tr>
                                            <td>Grand Total</td>
                                            @foreach ($attributeList as $attribute)
                                                <td colspan="2">
                                                    {{ $this->calculateTotal($attribute->id, 'F') + $this->calculateTotal($attribute->id, 'M') }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mt-3 mb-2">
                            <button type="submit" wire:loading.remove wire:loading.attr="disabled"
                                wire:target="saveForm"
                                class="btn btn-{{ $editMode == true ? 'success' : 'primary' }} text-white"
                                style="float: right;">{{ $editMode == true ? 'Update' : 'Save' }}</button>
                            <button type="button" wire:loading wire:loading.attr="disabled" wire:target="saveForm"
                                class="btn btn-success text-white" style="float: right;"
                                disabled="disabled">{{ $editMode == true ? 'Updating..' : 'Saving...' }}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Upload data model --}}
    {{-- <div wire:ignore.self class="modal fade" id="upload_data_modal" tabindex="-1"
        aria-labelledby="upload_data_modal_label" aria-hidden="true">
        <div class="row justify-content-center mt-3 mb-0">
            <div class="col-5">
                @if (session()->has('already_exist'))
                    @include('partial.alert')
                @endif
            </div>
        </div>
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="forms-sample" wire:submit.prevent="">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Field Data</h1>
                        <button type="button" wire:click="clearForm" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-3">
                        <div class="form-group">
                            <label for="excel_file">Excel file</label>
                            <input type="file" accept="" wire:model="excel_file"
                                class="form-control form-control-sm" id="excel_file">
                            @error('excel_file')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="clearForm" class="btn btn-warning text-dark"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary text-white">Import</button>
                    </div>
                </form>

            </div>
        </div>
    </div> --}}

</div>

@push('js')
    <script>
        window.addEventListener('openForm', event => {
            $('#upload_data_modal').modal('show');
        });

        window.addEventListener('closeForm', event => {
            $('#upload_data_modal').modal('hide');
        });
    </script>
@endpush
