<style>
    th {
        white-space: nowrap; /* Prevent text from wrapping */
        overflow: hidden;    /* Hide the overflow */
        text-overflow: ellipsis; /* Display ellipsis (...) when text overflows */
        max-width: 200px;   /* Set a maximum width for the th */
    }
</style>
<table>
    
    <thead>
        <tr></tr>
        <tr>
            @php
                $i=1;
            @endphp
            {{-- <th colspan="2" rowspan="2"></th>
            @foreach($formDatas as $formData)
                    <th colspan="2" rowspan="2">{{ $formData->attribute->name}}</th>
            @endforeach
        </tr>    --}}
    </thead>
    <tbody>
        {{-- <tr></tr>
        <tr style="font-weight:bold;">
            <td>Age</td>
            @foreach ($formDatas as $formData)
            <td>M</td>
            <td>F</td>
            @endforeach
        </tr> --}}
       {{-- <tr>
            <td></td>
            @foreach ($formDatas as $formData)
                <td>{{ $formData->male}}</td>
                <td>{{ $formData->female}}</td>
            @endforeach       
        </tr> --}}
        {{-- <tr>
            <td>Age</td> 
         </tr>
         <tr>
            <td>0-5</td> 
         </tr>
         <tr>
            <td>6-14</td> 
         </tr>
         <tr>
            <td>15 & above</td> 
         </tr> --}}
         <tr rowspan=2 class="bg-slate-100 border-b">
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">sn</th>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Scanning Name</th>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Data</th>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Age group</th>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Male</th>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Female</th>
         </tr>
         <tr></tr>
    @foreach($formDatas as $formD => $group)
        {{-- <tr>
            <td>{{ $formData->attribute->name}}</td>
        </tr> --}}
        @foreach($group as $formData)
        <tr class="border-b">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $i++ }}</td>
            {{-- <td>{{ $formData->id }}</td> --}}
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $formData->form->scanning_name }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $formData->attribute->name}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $formData->age_group->slug }}</td>           
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $formData->male}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $formData->female}}</td>
            {{-- <td>{{ $formData->scanning_name}}</td> --}}
        </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
<style>
    th{
        width: fit-content;
    }
    td{
        width: min-content;
    }
</style>