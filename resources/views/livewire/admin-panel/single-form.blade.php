<div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-10 text-center">{{ $scanning_name }}</div>
                            <div class="col-2">
                                <a href="{{ route('admin.reporting') }}" class="btn btn-primary btn-sm text-white"
                                    style="float: right;">Back</a>
                            </div>
                        </div>
                    </h4>

                    <form class="forms-sample">
                        <div class="row">
                            <div class="row col-md-4">
                                <div class="col-12">
                                    <label for="district_id" class="fw-bold me-2">Reginal Coordinator: </label>
                                    {{ $form->added_by->first_name }} {{ $form->added_by->last_name }}
                                </div>
                                <div class="col-12">
                                    <label for="district_id" class="fw-bold me-2">Submittion date: </label>
                                    {{ $form->updated_at->format('M d, Y') }}
                                </div>
                            </div>
                            <div class="row col-md-4">
                                <div class="col-12">
                                    <label for="district_id" class="fw-bold me-2">Region: </label>
                                    {{ $form->ward->district->region->name }}
                                </div>
                                <div class="col-12">
                                    <label for="district_id" class="fw-bold me-2">District: </label>
                                    {{ $form->ward->district->name }}
                                </div>
                            </div>
                            <div class="row col-md-4">
                                <div class="col-12">
                                    <label for="district_id" class="fw-bold me-2">Ward: </label>
                                    {{ $form->ward->name }}
                                </div>
                                <div class="col-12">
                                    <label for="district_id" class="fw-bold me-2">Address: </label>
                                    {{ $address }}
                                </div>
                            </div>

                            <div class="col-md-12 table-responsive mt-4">
                                @include('exports.single_form')
                                <table class="formData table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Age Group</th>
                                            @foreach ($attributeList as $attribute)
                                                <th colspan="2">{{ $attribute->name }}</>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th></th>
                                            @foreach ($attributeList as $attribute)
                                                <th>F</th>
                                                <th>M</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <style>
                                            input {
                                                border: none;
                                                text-align: center;
                                            }
                                        </style>
                                        @foreach ($ageGroups as $ageGroup)
                                            <tr>
                                                <td>{{ $ageGroup->slug }}</td>
                                                @foreach ($attributeList as $attribute)
                                                    @if ($attribute->attribute_no == 1.0)
                                                        <td style="border-right-color: {{ $color }};">
                                                            <input type="text" style="width: 60px;" min="0"
                                                                class="{{ $ageGroup->slug == '0-5' ? 'bg-dark' : '' }}"
                                                                {{ $ageGroup->slug == '0-5' ? 'disabled' : '' }}
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.F"
                                                                readonly>
                                                        </td>
                                                        <td style="border-left-color: {{ $color }};">
                                                            <input type="text" style="width: 60px;" min="0"
                                                                class="{{ $ageGroup->slug == '0-5' ? 'bg-dark' : '' }}"
                                                                {{ $ageGroup->slug == '0-5' ? 'disabled' : '' }}
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.M"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['M'] ?? 0 }}"
                                                                readonly>
                                                        </td>
                                                    @elseif ($attribute->attribute_no == 10.0)
                                                        <td style="border-right-color: {{ $color }};">
                                                            <input type="text" style="width: 60px;" min="0"
                                                                class="{{ $ageGroup->slug == '6-14' || $ageGroup->slug == '15 & above' ? 'bg-dark' : '' }}"
                                                                value="0"
                                                                {{ $ageGroup->slug == '6-14' || $ageGroup->slug == '15 & above' ? 'disabled' : '' }}
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.F"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['F'] ?? 0 }}"
                                                                readonly>
                                                        </td>
                                                        <td style="border-left-color: {{ $color }};">
                                                            <input type="text" style="width: 60px;" min="0"
                                                                class="{{ $ageGroup->slug == '6-14' || $ageGroup->slug == '15 & above' ? 'bg-dark' : '' }}"
                                                                value="0"
                                                                {{ $ageGroup->slug == '6-14' || $ageGroup->slug == '15 & above' ? 'disabled' : '' }}
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.M"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['M'] ?? 0 }}"
                                                                readonly>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <input type="text" style="width: 60px;" min="0"
                                                                id="formData-{{ $ageGroup->id }}-{{ $attribute->id }}-F"
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.F"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['F'] ?? 0 }}"
                                                                readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" style="width: 60px;" min="0"
                                                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.M"
                                                                value="{{ $formData[$ageGroup->id][$attribute->id]['M'] ?? 0 }}"
                                                                readonly>
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

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
