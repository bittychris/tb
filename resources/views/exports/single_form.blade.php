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
        @php
            $total_female = [];
            $total_male = [];
        @endphp
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
                        {{ $formData[$ageGroup->id][$attribute->id]['M'] ?? 0 }}
                    </td>
                    @php
                        $total_female[$ageGroup->id][$attribute->id] = $formData[$ageGroup->id][$attribute->id]['F'] ?? 0;
                        $total_male[$ageGroup->id][$attribute->id] = $formData[$ageGroup->id][$attribute->id]['M'] ?? 0;

                    @endphp


                    {{-- @endif --}}
                    {{-- @php
                        $total_male += $formData[$ageGroup->id][$attribute->id]['M'] ?? 0;
                    @endphp --}}
                @endforeach
                {{-- <td>
                    {{ $total_female }}
                </td>
                <td>
                    {{ $total_male }}
                </td> --}}
            </tr>
        @endforeach

        {{-- @foreach ($ageGroups as $ageGroup)
            <tr>
                <td style="font-size: 10px; background: #92d050; border: 1px solid #000;">Total</td>
                @foreach ($attributeList as $attribute)
                    <td style="font-size: 10px; background: #92d050; text-align: center; border: 1px solid #000;"> --}}
        {{-- @php
                            // $attributeId = $attribute->id;
                            // $gender = 'F';
                            // $total_female += $formData[$ageGroup->id][$attribute->id]['F'] ?? 0;

                        @endphp --}}
        {{-- {{ calculateTotal($attributeId, $gender) }} --}}
        {{-- {{ dd($total_female) }} --}}

        {{-- </td>
                    <td style="font-size: 10px; background: #92d050; text-align: center; border: 1px solid #000;"> --}}
        {{-- {{ calculateTotal($attribute->id, 'M') }} --}}
        {{-- @php
                            // $attributeId = $attribute->id;
                            // $gender = 'F';
                            $total_male += $formData[$ageGroup->id][$attribute->id]['M'] ?? 0;

                        @endphp --}}
        {{-- {{ calculateTotal($attributeId, $gender) }} --}}
        {{-- {{ dd($total_male) }} --}}
        {{-- </td>
                @endforeach
            </tr>
        @endforeach
        <tr>
            <td style="font-size: 10px; background: #92d050; border: 1px solid #000;">Total</td>
            @foreach ($attributeList as $attribute)
                <td style="font-size: 10px; background: #92d050; text-align: center; border: 1px solid #000;"> --}}
        {{-- {{ calculateTotal($attributeId, $gender) }} --}}
        {{-- {{ $total_female }} --}}

        {{-- </td>
                <td style="font-size: 10px; background: #92d050; text-align: center; border: 1px solid #000;"> --}}
        {{-- {{ calculateTotal($attributeId, $gender) }} --}}
        {{-- {{ $total_male }} --}}
        {{-- </td>
            @endforeach
        </tr> --}}


        <!-- Add Grand Total row -->
        {{-- <tr>
            <td style="font-size: 10px; background: #92d050; border: 1px solid #000;">Grand Total</td>
            @foreach ($attributeList as $attribute)
                <td colspan="2"
                    style="font-size: 10px; text-align: center; background: #92d050; border: 1px solid #000;"> --}}
        {{-- {{ $total_female + $total_male }} --}}
        {{-- {{ $this->calculateTotal($attribute->id, 'F') + $this->calculateTotal($attribute->id, 'M') }} --}}
        {{-- </td>
            @endforeach
        </tr> --}}
        {{-- @php
            $temp_sum = 0;
            $temp_attr = '';

        @endphp
        @foreach ($attributeList as $attribute)
            @foreach ($total_female as $key => $item)
                {{ $key == $attribute->id ? ($temp_sum += $item[$attribute->id]) : 0 }}
            @endforeach
        @endforeach
        {{ dd($temp_sum) }}


        @foreach ($ageGroups as $ageGroup)
            $temp_attr = a; --}}

        {{-- @foreach ($attributeList as $attribute) --}}
        {{-- for ($i = 0; ($i = 3); $i++) {
                for ($j = 0; ($j = 14); $j++) {
                $temp_sum += $total_female[$i][$j];
                }
                echo $temp_sum;
                $temp_sum = 0;
                } --}}
        {{-- if()
                @php
                    $temp_sum += $total_female[$ageGroup->id][$attribute->id];
                @endphp
            @endforeach
            {{ dd($temp_sum) }}
            @php
                $temp_sum = 0;
            @endphp
        @endforeach --}}

    </tbody>
</table>
