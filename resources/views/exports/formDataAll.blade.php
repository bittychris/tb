<table>

    <thead>
        <tr>
            <td style="background-color:blue; font-weight:bold; color:white; text-align:center;" colspan="3">Amref 2024</td>
        </tr>
        <tr>
            
          
    </thead>
    <tbody>
    @php
        $x=0;
        $i=0;
    @endphp

    
        @foreach ($formDatas as $formData)
                @if ($x==0)
                    <tr class="border-b" rowspan="3">
                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 bg-slate-300 border-b" colspan="3">
                    {{ $formData->attribute->name }}</td></tr>
                    <tr class="bg-slate-100">
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900 border border-2">Age</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900 border border-2">male</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900 border border-2"> Female</td>
                    </tr>

                    <tr>
                @endif

                
                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 border border-2">
                    {{ $formData->age_group->slug }}</td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 border border-2">{{ $formData->male }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 border border-2">{{ $formData->female ?: 0}}
                    </td>
                </tr>
                
                @php
                    
                @endphp


        @endforeach
    </tbody>
    </table>