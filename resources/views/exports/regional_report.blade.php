<table class="formData table table-bordered table-sm">
    <thead>
        <tr class="mb-1">
            <th></th>
            <th colspan="31" rowspan="2"
                style="background: #ffff00; margin-bottom: 20px; font-weight: bold; text-align: center; font-size: 20px;">
                REGIONAL REPORT
            </th>
        </tr>
        <tr></tr>
        <tr>
            <th></th>
            <th colspan="5" style="text-align: left; font-size: 10px;">
                Reginal Coordinator: {{ $firstForm->added_by->first_name }} {{ $firstForm->added_by->last_name }}
            </th>
        </tr>
        <tr>
            <th></th>
            <th colspan="5" style="text-align: left; font-size: 10px;">
                Region: {{ $firstForm->added_by->region->name }}
            </th>
        </tr>
        <tr>
            <th></th>
            <th colspan="5" style="text-align: left; font-size: 10px;">
                From: {{ $firstForm->created_at->format('F d, Y') ?? '---' }}
            </th>
        </tr>
        <tr>
            <th></th>
            <th colspan="5" style="text-align: left; font-size: 10px;">
                To: {{ $lastForm->updated_at->format('F d, Y') ?? '---' }}
            </th>
        </tr>
    </thead>
</table>


@for ($i = 1; $i <= count($form_ids); $i++)

    <table>
        <thead>
            <tr>
                <th style="font-size: 10px;">Table {{ $i }}</th>
                <th colspan="31" style="font-size: 14px; background: #92d050; border: 1px solid #000;">
                    <b style="color: white;">{{ $form[$i]->scanning_name }}</b>
                </th>
            </tr>
            <tr>
                <th></th>
                <th rowspan="4" style="border: 1px solid #000; background: #f8cbad;"></th>
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
                <th></th>
                <th style="font-size: 10px; border: 1px solid #000;">Age</th>
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
                    <td></td>
                    <td style="font-size: 10px; border: 1px solid #000;">{{ $ageGroup->slug }}</td>
                    @foreach ($attributeList as $attribute)
                        <td
                            style="font-size: 10px; text-align: center; background: {{ $ageGroup->slug == '0-5' && $attribute->attribute_no == 1 ? 'black' : '' }} {{ $ageGroup->slug == '6-14' && $attribute->attribute_no == 10 ? 'black' : '' }} {{ $ageGroup->slug == '15 & above' && $attribute->attribute_no == 10 ? 'black' : '' }}; border: 1px solid #000;">
                            {{ $formData[$i][$ageGroup->id][$attribute->id]['F'] ?? '- - -' }}
                        </td>
                        <td
                            style="font-size: 10px; text-align: center; background: {{ $ageGroup->slug == '0-5' && $attribute->attribute_no == 1 ? 'black' : '' }} {{ $ageGroup->slug == '6-14' && $attribute->attribute_no == 10 ? 'black' : '' }} {{ $ageGroup->slug == '15 & above' && $attribute->attribute_no == 10 ? 'black' : '' }}; border: 1px solid #000;">
                            {{ $formData[$i][$ageGroup->id][$attribute->id]['M'] ?? '- - -' }}
                        </td>
                        @php
                            $total_female[$ageGroup->id][$attribute->id] = $formData[$i][$ageGroup->id][$attribute->id]['F'] ?? 0;
                            $total_male[$ageGroup->id][$attribute->id] = $formData[$i][$ageGroup->id][$attribute->id]['M'] ?? 0;
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
                <td></td>
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
                <td></td>
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

@endfor
