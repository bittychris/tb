<style>
    th {
        /* white-space: nowrap; */
        /* Prevent text from wrapping */
        /* overflow: scroll; */
        /* Hide the overflow */
        /* text-overflow: ellipsis; */
        /* Display ellipsis (...) when text overflows */
        /* max-width: 200px; */
        /* Set a maximum width for the th */
    }
</style>
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


        <tr rowspan=2 class="bg-slate-100 border-b">
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">sn</th>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Scanning Name</th>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Data</th>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Attribute</th>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Age group</th>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Male</th>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Female</th>
        </tr>
        <tr></tr>
        @foreach ($formDatas as $formD => $group)
            {{-- <tr>
            <td>{{ $formData->attribute->name}}</td>
        </tr> --}}
            @foreach ($group as $formData)
                <tr class="border-b">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $i++ }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $formData->form->scanning_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $formData->form->added_by->last_name}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $formData->attribute->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $formData->age_group->slug }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $formData->male }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $formData->female }}
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
