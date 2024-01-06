<table>

    <thead>
        <tr></tr>
        <tr>
            @php
                $i = 1;
                $x = 0;
            @endphp
          
    </thead>
    <tbody>
    @php
        $x=0;
        $i=0;
    @endphp

    <tr class="border-b">
        @foreach ($formDatas as $formData)
            
                
                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 bg-slate-300 border-b" colspan="3">
                    {{ $formData->attribute->name }}</td></tr>
                    <tr class="bg-slate-100">
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900 border border-2">Age</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900 border border-2">male</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900 border border-2"> Female</td>
                    </tr>
                    
          
                

                <tr>
                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 border border-2">
                    {{ $formData->age_group->slug }}</td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 border border-2">{{ $formData->male }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 border border-2">{{ $formData->female ?: 0}}
                    </td>
                </tr>


                @endforeach
            </table>