<style>
    td {
        /* white-space: nowrap; */
        /* Prevent text from wrapping */
        /* overflow: scroll; */ */
        /* Hide the overflow */
        /* text-overflow: ellipsis; */
        /* Display ellipsis (...) when text overflows */
        /* max-width: 200px;  */
        /* Set a maximum width for the th */
    }
</style>
<table>

    <thead>
        <tr>
            @php
                $i = 1;
                $x = 0;
            @endphp
          
    </thead>
    <tbody>
        
        <tr style="background-color: greenyellow;">{{ $user }}</tr>
        @foreach ($formDatas as $formD => $group)
            <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" >{{ $i++ }}</td>
            <td style="background-color: greenyellow; " colspan="3">{{ $group[0]->attribute->name}}</td>
            
                
            
        </tr>
        <tr rowspan=2 class="bg-slate-100 border-b">
            <td></td>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left" style="background-color: blue; color:white;">Age</th>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left" style="background-color: orange;">male</th>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left" style="background-color: orange;">female</th>
        </tr>
            @foreach ($group as $formData)
                <tr class="border-b">
                   
                    {{-- <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $formData->form->scanning_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $formData->form->added_by->last_name}} {{ $formData->form->added_by->last_name}}</td> --}}
                    {{-- <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $formData->attribute->name }}</td> --}}
                        <td></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $formData->age_group->slug }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $formData->male ?: 0 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $formData->female ?: 0 }}
                    </td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
<style>
    th {
        width: fit-content;
    }

    td {
        width: min-content;
    }
</style>
