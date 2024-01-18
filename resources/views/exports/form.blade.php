<table class="table table-hover table-bordered table-sm">
    <thead>
        <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Region</th>
            <th>District</th>
            <th>ward</th>
            <th>Reginal Cordinator</th>
            {{-- <th>scanning name</th> --}}
            <th>Submition date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @forelse($forms as $form)
            <tr> 
                <td>{{ $i++ }}</td>
                <td><a href="{{ route('formOne.export', ['formdata_id'=>$form->id ]) }}" style="text-decoration: none;">{{ $form->form_attribute->name }}</a></td>
                <td>{{ $form->ward->district->region->name }}</td>
                <td>{{ $form->ward->district->name }}</td>
                <td>{{ $form->ward->name}}</td>
                <td>{{ $form->added_by->first_name }} {{ $form->added_by->last_name }}</td>
                {{-- <td>{{ $form->scanning_name}}</td> --}}
                <td>{{ $form->updated_at->format('d M, Y') }}</td>
                <td>
                    <a href="{{ route('formOne.export', ['formdata_id'=>$form->id ]) }}" class="btn btn-danger btn-sm text-white" style="text-decoration: none;"><i class="mdi mdi-cloud-download"></i></a>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center" colspan="8">No report found!</td>
            </tr>
        @endforelse
    </tbody>
</table>
