<style>
    td {
       width: max-content;
    }
</style>
<table>

    <thead>
        <tr>
            @php
                $i = 1;
                $x = 0;
                $alreadyExecuted = false;
            @endphp
          
    </thead>
    <tbody>
        
       
        @foreach ($formDatas as $formD => $group)
        
            @if(!$alreadyExecuted)<tr style="background-color: greenyellow;">
                <!-- Your code to run only once goes here -->
                <td style="background-color: blue; color:white; font-weight:bold;" colspan="6" > {{ $group[0]->form->scanning_name}} - {{ $group[0]->form->ward->name}} {{ $group[0]->form->ward->district->name}} {{ $group[0]->form->ward->district->region->name}} </td>
            </tr>
            <tr>
                <td style="background-color: blue; color:white; font-weight:bold; text-align:center;" colspan="6" >by: {{ $group[0]->form->added_by->last_name}} At {{ $group[0]->form->added_by->first_name}} ({{ $group[0]->form->created_at}})</td>
            </tr>
                <!-- Set the flag to true after executing the code -->
                @php
                    $alreadyExecuted = true;
                @endphp
            @endif 
        @endforeach
       <tr></tr>
        @foreach ($formDatas as $formD => $group)
            <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" >{{ $i++ }}</td>
            <td style="background-color: greenyellow; " colspan="5">{{ $group[0]->attribute->name}}</td>
        </tr>
        <tr rowspan=2 class="bg-slate-100 border-b">
            <td></td>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left" style="background-color: blue; color:white;">Age</th>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left" style="background-color: orange;">male</th>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left" style="background-color: orange;" >female</th>
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
