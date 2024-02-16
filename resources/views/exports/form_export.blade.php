<table class="table table-hover table-bordered table-sm">
    <thead>
        <tr class="mb-1">
            <th colspan="7"
                style="background: #ffff00; margin-bottom: 20px; font-weight: bold; text-align: center; font-size: 20px;">
                SUBMITTED
                REPORTS</th>
        </tr>
        <tr>
            <th style="background: #92d050; padding-top: 15px; font-weight: bold; text-align: center; color: black;">S/N
            </th>
            <th style="background: #92d050; padding-top: 15px; font-weight: bold; text-align: center; color: black;">Name
            </th>
            <th style="background: #92d050; padding-top: 15px; font-weight: bold; text-align: center; color: black;">
                Region
            </th>
            <th style="background: #92d050; margin: 5px; font-weight: bold; text-align: center; color: black;">District
            </th>
            <th style="background: #92d050; margin: 5px; font-weight: bold; text-align: center; color: black;">Ward</th>
            <th style="background: #92d050; margin: 5px; font-weight: bold; text-align: center; color: black;">Reginal
                Cordinator</th>
            <th style="background: #92d050; margin: 5px; font-weight: bold; text-align: center; color: black;">Date</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @forelse($forms as $form)
            <tr>
                <td style="text-align: left;">{{ $i++ }}</td>
                <td style="color: black;">{{ Str::limit($form->scanning_name, 20) }}</td>
                <td>{{ $form->ward->district->region->name }}</td>
                <td>{{ $form->ward->district->name }}</td>
                <td>{{ $form->ward->name }}</td>
                <td>{{ $form->added_by->first_name }} {{ $form->added_by->last_name }}</td>
                <td style="text-align: right;">{{ $form->updated_at->format('F d, Y') }}</td>
            </tr>
        @empty
            <tr>
                <td class="text-center" colspan="8">No report found!</td>
            </tr>
        @endforelse
    </tbody>
</table>
