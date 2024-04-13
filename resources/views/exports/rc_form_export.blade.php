<table class="table table-hover table-bordered table-sm">
    <thead>
        <tr class="mb-1">
            <th colspan="7" rowspan="2"
                style="background: #ffff00; margin-bottom: 20px; font-weight: bold; text-align: center; font-size: 20px;">
                FIELD DATA</th>
        </tr>
        <tr></tr>
        <tr>
            <th colspan="7">From: {{ $firstReport->created_at->format('F d, Y') ?? '---' }}</th>
        </tr>
        <tr>
            <th colspan="7">To: {{ $lastReport->updated_at->format('F d, Y') ?? '---' }}</th>
        </tr>
        <tr></tr>
        <tr>
            <th style="background: #92d050; padding-top: 15px; font-weight: bold; text-align: center; color: black;">S/N
            </th>
            <th style="background: #92d050; padding-top: 15px; font-weight: bold; text-align: center; color: black;">
                Name
            </th>
            <th style="background: #92d050; padding-top: 15px; font-weight: bold; text-align: center; color: black;">
                Region
            </th>
            <th style="background: #92d050; margin: 5px; font-weight: bold; text-align: center; color: black;">District
            </th>
            <th style="background: #92d050; margin: 5px; font-weight: bold; text-align: center; color: black;">Ward</th>
            <th style="background: #92d050; margin: 5px; font-weight: bold; text-align: center; color: black;">Status
            </th>
            <th style="background: #92d050; margin: 5px; font-weight: bold; text-align: center; color: black;">Date</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @forelse($reports as $report)
            <tr>
                <td style="text-align: left;">{{ $i++ }}</td>
                <td style="color: black;">{{ $report->form_attribute->name }}</td>
                <td>{{ $report->ward->district->region->name }}</td>
                <td>{{ $report->ward->district->name }}</td>
                <td>{{ $report->ward->name }}</td>
                <td
                    style="text-align: center; color: #fff; font-size: 12px; background: {{ $report->status == 0 ? 'red' : 'green' }}; border-radius: 8px;">
                    {{ $report->status == 0 ? 'Not submitted' : 'Submited' }}
                </td>
                <td style="text-align: right;">{{ $report->updated_at->format('F d, Y') }}</td>
            </tr>
        @empty
            <tr>
                <td class="text-center" colspan="8">No report found!</td>
            </tr>
        @endforelse
    </tbody>
</table>
