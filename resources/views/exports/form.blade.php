<table>
    <thead>
    <tr>
        <th>sn</th>
        <th>Form Name</th>
        <th>Form attribute</th>
        <th>Added by</th>
        <th>ward</th>
        <th>scanning name</th>
    </tr>
    </thead>
    <tbody>
        @php
            $i = 0;
        @endphp
    @foreach($forms as $form)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $form->form_attribute->name }}</td>
            <td>{{ $form->added_by->first_name }}</td>
            <td>{{ $form->ward->name}}</td>
            <td>{{ $form->scanning_name}}</td>
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