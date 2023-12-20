<style>
    th {
        white-space: nowrap; /* Prevent text from wrapping */
        overflow: hidden;    /* Hide the overflow */
        text-overflow: ellipsis; /* Display ellipsis (...) when text overflows */
        max-width: 200px;    /* Set a maximum width for the th */
    }
</style>
<table>
    
    <thead>
        <tr></tr>
        <tr>
            <th colspan="2" rowspan="2"></th>
            @foreach($formDatas as $formData)
                    <th colspan="2" rowspan="2">{{ $formData->attribute->name}}</th>
            @endforeach
        </tr>   
    </thead>
    <tbody>
        <tr></tr>
        <tr style="font-weight:bold;">
            <td>Age</td>
            @foreach ($formDatas as $formData)
            <td>M</td>
            <td>F</td>
            @endforeach
        </tr>
       <tr>
            <td></td>
            @foreach ($formDatas as $formData)
                <td>{{ $formData->male}}</td>
                <td>{{ $formData->female}}</td>
            @endforeach       
        </tr>
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
    @foreach($formDatas as $formData)
        {{-- <tr>
            <td>{{ $formData->attribute->name}}</td>
        </tr> --}}
        <tr>
            {{-- <td>{{ $i++ }}</td> --}}
            {{-- <td>{{ $formData->id }}</td> --}}
            {{-- <td>{{ $formData->form->scanning_name }}</td>
            <td>{{ $formData->age_group->slug }}</td>
            
            <td>{{ $formData->male}}</td>
            <td>{{ $formData->female}}</td> --}}


            {{-- <td>{{ $formData->scanning_name}}</td> --}}
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