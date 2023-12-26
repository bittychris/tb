<table>
    <thead>
    <tr class="p-2 bg-slate-100 border-b">
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">sn</th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Form Name</th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Form attribute</th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Added by</th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">ward</th>
        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">scanning name</th>
    </tr>
    </thead>
    <tbody>
        @php
            $i = 0;
        @endphp
    @foreach($forms as $form)
        <tr class="border-b">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $i++ }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $form->form_attribute->name }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $form->added_by->first_name }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $form->ward->name}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $form->scanning_name}}</td>
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