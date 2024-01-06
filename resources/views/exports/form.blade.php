<table>
    <thead>
    <tr class="p-2 bg-slate-100 border-b">
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">sn</th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Form Name</th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Created  by</th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Region</th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">District</th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">ward</th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">scanning name</th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Created At</th>
    </tr>
    </thead>
    <tbody>
        @php
            $i = 0;
        @endphp
    @foreach($forms as $form)
        <tr class="border-b"> 
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $i++ }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><a href="{{ route('formOne.export', ['formdata_id'=>$form->id ]) }}">{{ $form->form_attribute->name }}</a></td>
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