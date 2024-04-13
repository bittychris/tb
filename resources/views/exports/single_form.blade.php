<table class="formData table table-bordered table-sm">
    <thead>
        <tr class="mb-1">
            <th colspan="31" rowspan="2"
                style="background: #ffff00; margin-bottom: 20px; font-weight: bold; text-align: center; font-size: 20px;">
                REPORT</th>
        </tr>
        <tr></tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th colspan="5" style="text-align: left; font-size: 10px;">
                Reginal Coordinator: {{ $form->added_by->first_name }} {{ $form->added_by->last_name }}
            </th>
            <th colspan="5" style="text-align: left; font-size: 10px;">
                Region: {{ $form->ward->district->region->name }}
            </th>
            <th colspan="5" style="text-align: left; font-size: 10px;">
                Ward: {{ $form->ward->name }}
            </th>
        </tr>
        <tr>
            <th colspan="5" style="text-align: left; font-size: 10px;">
                From: {{ $form->created_at->format('F d, Y') }}
            </th>
            <th colspan="5" style="text-align: left; font-size: 10px;">
                District: {{ $form->ward->district->name }}
            </th>
            <th colspan="5" style="text-align: left; font-size: 10px;">
                Address: {{ $address }}
            </th>
        </tr>
        <tr>
            <th colspan="5" style="text-align: left; font-size: 10px;">
                To: {{ $form->updated_at->format('F d, Y') }}
            </th>
            {{-- <th colspan="5" style="text-align: left; font-size: 10px;">
                District: {{ $form->ward->district->name }}
            </th>
            <th colspan="5" style="text-align: left; font-size: 10px;">
                Address: {{ $address }}
            </th> --}}
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
            $Malesum = [];
            $Femalesum = [];
        @endphp
        @foreach ($ageGroups as $ageGroup)
            <tr>
                <td style="font-size: 10px; border: 1px solid #000;">{{ $ageGroup->slug }}</td>
                @foreach ($attributeList as $attribute)
                    <td
                        style="font-size: 10px; text-align: center; background: {{ $ageGroup->slug == '0-5' && $attribute->attribute_no == 1 ? 'black' : '' }} {{ $ageGroup->slug == '6-14' && $attribute->attribute_no == 10 ? 'black' : '' }} {{ $ageGroup->slug == '15 & above' && $attribute->attribute_no == 10 ? 'black' : '' }}; border: 1px solid #000;">
                        {{ $formData[$ageGroup->id][$attribute->id]['F'] ?? '- - -' }}
                    </td>
                    <td
                        style="font-size: 10px; text-align: center;  background: {{ $ageGroup->slug == '0-5' && $attribute->attribute_no == 1 ? 'black' : '' }} {{ $ageGroup->slug == '6-14' && $attribute->attribute_no == 10 ? 'black' : '' }} {{ $ageGroup->slug == '15 & above' && $attribute->attribute_no == 10 ? 'black' : '' }};  border: 1px solid #000; ">
                        {{ $formData[$ageGroup->id][$attribute->id]['M'] ?? '- - -' }}
                    </td>
                    @php
                        $total_female[$ageGroup->id][$attribute->id] = $formData[$ageGroup->id][$attribute->id]['F'] ?? 0;
                        $total_male[$ageGroup->id][$attribute->id] = $formData[$ageGroup->id][$attribute->id]['M'] ?? 0;
                    @endphp
                @endforeach
            </tr>
        @endforeach

        @php

            foreach ($total_male as $ageGroupID => $attributes) {
                $totalMale = 0;
                $numAttributes = count($attributes);

                foreach ($attributes as $attributeID => $value) {
                    if (!isset($Malesum[$attributeID])) {
                        $Malesum[$attributeID] = [
                            'totalMale' => 0,
                            'numAttributes' => 0,
                        ];
                    }
                    $Malesum[$attributeID]['totalMale'] += $value;
                    $Malesum[$attributeID]['numAttributes'] += 1;
                }
            }

            foreach ($total_female as $ageGroupID => $attributes) {
                $totalFemale = 0;
                $numAttributes = count($attributes);

                foreach ($attributes as $attributeID => $value) {
                    if (!isset($Femalesum[$attributeID])) {
                        $Femalesum[$attributeID] = [
                            'totalFemale' => 0,
                            'numAttributes' => 0,
                        ];
                    }
                    $Femalesum[$attributeID]['totalFemale'] += $value;
                    $Femalesum[$attributeID]['numAttributes'] += 1;
                }
            }

        @endphp

        <tr>
            <td style="font-size: 10px; background: #92d050; border: 1px solid #000;">Total</td>
            @foreach ($attributeList as $attribute)
                <td style="font-size: 10px; background: #92d050; text-align: center; border: 1px solid #000;">
                    {{ $Femalesum[$attribute->id]['totalFemale'] }}
                </td>
                <td style="font-size: 10px; background: #92d050; text-align: center; border: 1px solid #000;">
                    {{ $Malesum[$attribute->id]['totalMale'] }}
                </td>
            @endforeach
        </tr>

        <!-- Add Grand Total row -->
        <tr>
            <td style="font-size: 10px; background: #92d050; border: 1px solid #000;">Grand Total</td>
            @foreach ($attributeList as $attribute)
                <td colspan="2"
                    style="font-size: 10px; text-align: center; background: #92d050; border: 1px solid #000;">
                    {{ $Femalesum[$attribute->id]['totalFemale'] + $Malesum[$attribute->id]['totalMale'] }}
                    {{-- {{ $this->calculateTotal($attribute->id, 'F') + $this->calculateTotal($attribute->id, 'M') }} --}}
                </td>
            @endforeach
        </tr>

    </tbody>
</table>
