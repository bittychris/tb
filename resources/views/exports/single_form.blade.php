<table class="formData table table-bordered table-sm">
    <thead>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th colspan="3" style="text-align: left; font-size: 10px;">
                Reginal Coordinator: {{ $form->added_by->first_name }} {{ $form->added_by->last_name }}
            </th>
            <th colspan="3" style="text-align: left; font-size: 10px;">
                Region: {{ $form->ward->district->region->name }}
            </th>
            <th colspan="3" style="text-align: left; font-size: 10px;">
                Ward: {{ $form->ward->name }}
            </th>
        </tr>
        <tr>
            <th colspan="3" style="text-align: left; font-size: 10px;">
                Submittion date: {{ $form->updated_at->format('M d, Y') }}
            </th>
            <th colspan="3" style="text-align: left; font-size: 10px;">
                District: {{ $form->ward->district->name }}
            </th>
            <th colspan="3" style="text-align: left; font-size: 10px;">
                Address: {{ $address }}
            </th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th colspan="31" style="font-size: 14px; background: #92d050; border: 1px solid #000;">
                <b style="color: white;">{{ $scanning_name }}</b>
            </th>
        </tr>
        <tr>
            <th></th>
            @foreach ($attributeList as $attribute)
                <th colspan="2" rowspan="4"
                    style="width: 150px; text-align: center; font-size: 9px; text-justify: middle; text-justify: middle; vertical-align: top; border: 1px solid #000; background: #f8cbad;">
                    <p style="display: block;"><b>{{ $attribute->name }}</b></p>
                </th>
            @endforeach
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <th style="font-size: 10px; border: 1px solid #000;">Age Group</th>
            @foreach ($attributeList as $attribute)
                <th
                    style="width: 75px; text-align: center; font-size: 10px; border: 1px solid #000; background: #ddebf7;">
                    F</th>
                <th
                    style="width: 75px; text-align: center; font-size: 10px; border: 1px solid #000; background: #ddebf7;">
                    M</th>
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
                <td style="font-size: 10px; border: 1px solid #000;">{{ $ageGroup->slug }}</td>
                @foreach ($attributeList as $attribute)
                    {{-- @if ($attribute->attribute_no == 1.0)
                        <td style="border-right-color: {{ $color }};">
                            <input type="text" style="width: 60px;" min="0"
                                class="{{ $ageGroup->slug == '0-5' ? 'bg-dark' : '' }}"
                                {{ $ageGroup->slug == '0-5' ? 'disabled' : '' }}
                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.F" readonly>
                        </td>
                        <td style="border-left-color: {{ $color }};">
                            <input type="text" style="width: 60px;" min="0"
                                class="{{ $ageGroup->slug == '0-5' ? 'bg-dark' : '' }}"
                                {{ $ageGroup->slug == '0-5' ? 'disabled' : '' }}
                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.M"
                                value="{{ $formData[$ageGroup->id][$attribute->id]['M'] ?? 0 }}" readonly>
                        </td>
                    @elseif ($attribute->attribute_no == 10.0)
                        <td style="border-right-color: {{ $color }};">
                            <input type="text" style="width: 60px;" min="0"
                                class="{{ $ageGroup->slug == '6-14' || $ageGroup->slug == '15 & above' ? 'bg-dark' : '' }}"
                                value="0"
                                {{ $ageGroup->slug == '6-14' || $ageGroup->slug == '15 & above' ? 'disabled' : '' }}
                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.F"
                                value="{{ $formData[$ageGroup->id][$attribute->id]['F'] ?? 0 }}" readonly>
                        </td>
                        <td style="border-left-color: {{ $color }};">
                            <input type="text" style="width: 60px;" min="0"
                                class="{{ $ageGroup->slug == '6-14' || $ageGroup->slug == '15 & above' ? 'bg-dark' : '' }}"
                                value="0"
                                {{ $ageGroup->slug == '6-14' || $ageGroup->slug == '15 & above' ? 'disabled' : '' }}
                                wire:model.live="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.M"
                                value="{{ $formData[$ageGroup->id][$attribute->id]['M'] ?? 0 }}" readonly>
                        </td>
                    @else --}}
                    <td style="font-size: 10px; text-align: center; border: 1px solid #000;">
                        {{-- <input type="text" style="width: 60px;" min="0"
                            id="formData-{{ $ageGroup->id }}-{{ $attribute->id }}-F"
                            name="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.F"
                            value="{{ $formData[$ageGroup->id][$attribute->id]['F'] ?? 0 }}"> --}}
                        {{ $formData[$ageGroup->id][$attribute->id]['F'] ?? 0 }}

                        {{-- @php
                            $total_female[$attribute->id] += $formData[$ageGroup->id][$attribute->id]['F'] ?? 0;
                        @endphp --}}
                    </td>
                    <td style="font-size: 10px; text-align: center; border: 1px solid #000;">
                        {{-- <input type="text" style="width: 60px;" min="0"
                            name="formData.{{ $ageGroup->id }}.{{ $attribute->id }}.M"
                            value="{{ $formData[$ageGroup->id][$attribute->id]['M'] ?? 0 }}" readonly> --}}
                        {{ !empty($formData[$ageGroup->id][$attribute->id]['M']) ? $formData[$ageGroup->id][$attribute->id]['M'] : 0 }}
                    </td>
                    {{-- @endif --}}
                    {{-- @php
                        $total_male += $formData[$ageGroup->id][$attribute->id]['M'] ?? 0;
                    @endphp --}}
                @endforeach
            </tr>
        @endforeach
        @php
            $total_female = 0;
            $total_male = 0;
        @endphp
        @foreach ($ageGroups as $ageGroup)
            <tr>
                <td style="font-size: 10px; background: #92d050; border: 1px solid #000;">Total</td>
                @foreach ($attributeList as $attribute)
                    <td style="font-size: 10px; background: #92d050; text-align: center; border: 1px solid #000;">
                        @php
                            // $attributeId = $attribute->id;
                            // $gender = 'F';
                            $total_female += $formData[$ageGroup->id][$attribute->id]['F'] ?? 0;

                        @endphp
                        {{-- {{ calculateTotal($attributeId, $gender) }} --}}
                        {{ $total_female }}

                    </td>
                    <td style="font-size: 10px; background: #92d050; text-align: center; border: 1px solid #000;">
                        {{-- {{ calculateTotal($attribute->id, 'M') }} --}}
                        @php
                            // $attributeId = $attribute->id;
                            // $gender = 'F';
                            $total_male += $formData[$ageGroup->id][$attribute->id]['M'] ?? 0;

                        @endphp
                        {{-- {{ calculateTotal($attributeId, $gender) }} --}}
                        {{ $total_male }}
                    </td>
                @endforeach
            </tr>
        @endforeach
        <tr>
            <td style="font-size: 10px; background: #92d050; border: 1px solid #000;">Total</td>
            @foreach ($attributeList as $attribute)
                <td style="font-size: 10px; background: #92d050; text-align: center; border: 1px solid #000;">
                    {{-- {{ calculateTotal($attributeId, $gender) }} --}}
                    {{ $total_female }}

                </td>
                <td style="font-size: 10px; background: #92d050; text-align: center; border: 1px solid #000;">
                    {{-- {{ calculateTotal($attributeId, $gender) }} --}}
                    {{ $total_male }}
                </td>
            @endforeach
        </tr>


        <!-- Add Grand Total row -->
        <tr>
            <td style="font-size: 10px; background: #92d050; border: 1px solid #000;">Grand Total</td>
            @foreach ($attributeList as $attribute)
                <td colspan="2"
                    style="font-size: 10px; text-align: center; background: #92d050; border: 1px solid #000;">

                    {{ $total_female + $total_male }}
                    {{-- {{ $this->calculateTotal($attribute->id, 'F') + $this->calculateTotal($attribute->id, 'M') }} --}}
                </td>
            @endforeach
        </tr>
    </tbody>
</table>
