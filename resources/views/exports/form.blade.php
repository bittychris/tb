<table>
    <thead>
    <tr>
        <td style="background-color:blue; font-weight:bold; color:white; text-align:center;" colspan="8" class="bg-white">AMREF 2024</td>
    </tr>
    <tr class="p-2 bg-slate-100 border-b" >
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left bg-white" style="background-color: green;">sn</th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left bg-white" style="background-color: green;">Form Name</th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left bg-white" style="background-color: green;">Created  by</th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left bg-white" style="background-color: green;">Region</th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left bg-white" style="background-color: green;">District</th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left bg-white" style="background-color: green;">ward</th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left bg-white" style="background-color: green;">scanning name</th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left bg-white" style="background-color: green;">Created At</th>
    </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
    @foreach($forms as $form)
        <tr class="border-b"> 
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $i++ }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><a href="{{ route('formOne.export', ['formdata_id'=>$form->id ]) }}" >{{ $form->form_attribute->name }}</a></td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $form->added_by->first_name }} {{ $form->added_by->last_name }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $form->ward->district->region->name }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $form->ward->district->name }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $form->ward->name}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $form->scanning_name}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $form->created_at}}</td>
            <td></td>
        </tr>
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