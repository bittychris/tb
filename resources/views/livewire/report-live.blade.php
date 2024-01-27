<div>
    <div class="row">
        <div class="col-lg-12">
            @if (session()->has('success'))
                @include('partial.alert')

            @elseif (session()->has('warning'))
                @include('partial.alert')

            @elseif (session()->has('error'))
                @include('partial.alert')

            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-6">Forms</div>
                            <div class="col-6">
                                <a href="{{ route('form.export') }}" class="bg-blue-500 text-white font-medium px-3 py-2 w-fit flex items-center" style="float: right;">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-2">
                                    <path d="M17 17H17.01M17.4 14H18C18.9319 14 19.3978 14 19.7654 14.1522C20.2554 14.3552 20.6448 14.7446 20.8478 15.2346C21 15.6022 21 16.0681 21 17C21 17.9319 21 18.3978 20.8478 18.7654C20.6448 19.2554 20.2554 19.6448 19.7654 19.8478C19.3978 20 18.9319 20 18 20H6C5.06812 20 4.60218 20 4.23463 19.8478C3.74458 19.6448 3.35523 19.2554 3.15224 18.7654C3 18.3978 3 17.9319 3 17C3 16.0681 3 15.6022 3.15224 15.2346C3.35523 14.7446 3.74458 14.3552 4.23463 14.1522C4.60218 14 5.06812 14 6 14H6.6M12 15V4M12 15L9 12M12 15L15 12" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Download Report </a>
                            </div>
                        </div>
                    </h4>
                    <div class="table-responsive">
                        @include('exports.form')

                        <div class="flex justify-between items-center my-6">
                            <div class="font-bold">Overall Form Data</div>
                            
                        </div>
                        <div class=" justify-between items-center mt-4 mb-4">
                            <div class="font-bold flex">
                                <form class="px-2 py-2" wire:submit.prevent="submit">
                                    @csrf
                                    <div class="d-flex justify-content-between">
                                        <div class="mx-2">
                                            <input type="radio" name="group1" class="mx-2" wire:model="quartiles.{{'all'}}" value="All" class="quartile-checkbox" wire:change="submit">
                                            <label class="mx-2">All</label>
                                        </div>
                                        <div class="d-flex">
                                            <label for="startDate">From:</label>
                                            <input type="date" id="startDate" wire:model="startdate" wire:change="updateStartDate">
                                        
                                            <label for="endDate">To:</label>
                                            <input type="date" id="endDate" wire:model="enddate" wire:change="updateEndDate">
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex mt-4">
                                        <div class="mx-2">
                                            <input type="radio" name="group1" class="mx-2" wire:model="quartiles.{{'q1'}}" value="q1" class="quartile-checkbox" wire:change="submit">
                                            <label>1st Quartile</label>
                                        </div>

                                        <div class="mx-2">
                                            <input type="radio" name="group1" class="mx-2" wire:model="quartiles.{{'q2'}}" value="q2" class="quartile-checkbox" wire:change="submit">
                                            <label>2nd Quartile</label>
                                        </div>

                                        <div class="mx-2">
                                            <input type="radio" name="group1" class="mx-2" wire:model="quartiles.{{'q3'}}" value="q3" class="quartile-checkbox" wire:change="submit">
                                            <label>3rd Quartile</label>
                                        </div>

                                        <div class="mx-2">
                                            <input type="radio" name="group1" class="mx-3" wire:model="quartiles.{{'q4'}}" value="q4" class="quartile-checkbox" wire:change="submit">
                                            <label>4th Quartile</label>
                                        </div>
                                        <div class="d-flex">
                                            <label for="selectedYear">Year: </label>
                                            <select id="selectedYear" wire:model="selectedYear" class="form-control">
                                                @for ($year = date('Y'); $year >= (date('Y') - 10); $year--)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select> 
                                        </div>
                                        
                                        {{-- <button type="submit" class="bg-blue-500 text-white py-1 px-2 rounded-lg btn btn-primary">SEE REPORT</button> --}}
                                    </div>
                                    

                                    
                                    

                                    {{-- <div class="mx-2 flex inline">
                                        <input type="checkbox" class="mx-2" wire:model="quartiles.{{'user'}}" value="user" class="quartile-checkbox">
                                        
                                        <select placeholder="by user" >
                                            @foreach ($users as $user)
                                                 <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    
                                   
                                    
                                </form>
                                <div class="mx-6" style="">
                                        @php    
                                            $newRange = implode(',', $quartRange);
                                        @endphp
                                        <a href="{{ route('formdata.export', ['range'=> $newRange]) }}" class="bg-green-500 text-white font-medium w-fit flex items-center btn btn-danger" style="float: right;">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-2">
                                            <path d="M17 17H17.01M17.4 14H18C18.9319 14 19.3978 14 19.7654 14.1522C20.2554 14.3552 20.6448 14.7446 20.8478 15.2346C21 15.6022 21 16.0681 21 17C21 17.9319 21 18.3978 20.8478 18.7654C20.6448 19.2554 20.2554 19.6448 19.7654 19.8478C19.3978 20 18.9319 20 18 20H6C5.06812 20 4.60218 20 4.23463 19.8478C3.74458 19.6448 3.35523 19.2554 3.15224 18.7654C3 18.3978 3 17.9319 3 17C3 16.0681 3 15.6022 3.15224 15.2346C3.35523 14.7446 3.74458 14.3552 4.23463 14.1522C4.60218 14 5.06812 14 6 14H6.6M12 15V4M12 15L9 12M12 15L15 12" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            DOWNLOAD REPORT 
                                        </a>
                                </div>
                                
                            </div>
                            
                        </div>


                        {{-- All form data
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
                        @php
                            $x=0;
                            $i=0;
                        @endphp

                        @foreach ($formDatas as $formD => $group)
                            <tr class="border-b">
                            @foreach ($group as $formData)
                                
                                    @if($x == 0)
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 bg-slate-300 border-b" colspan="3">
                                        {{ $formData->attribute->name }}</td></tr>
                                        <tr class="bg-slate-100">
                                            <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900 border border-2">Age</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900 border border-2">male</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900 border border-2"> Female</td>
                                        </tr>
                                        
                                    @endif
                                    @php
                                            $x++;
                                            if($x==3)
                                                $x = 0; 
                                    @endphp
                                    
                               
                                
                                    
                                    
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 border border-2">
                                        {{ $formData->age_group->slug }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 border border-2">{{ $formData->male }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 border border-2">{{ $formData->female ?: 0}}
                                        </td>
                                   </tr>
                                    
                               
                            @endforeach </tr>
                        @endforeach
                            </tbody>
                        </table> --}}





                       {{-- @foreach ($formDatas as $formData)
                       <div>{{ $formData->attribute->name }}</div>
                       <div>{{ $formData->age_group->slug }}</div>
                       <div>{{ $formData->male }}</div>
                       <div>{{ $formData->female }}</div>
    
                       @endforeach --}}

                       <table class="mt-5">

                        <thead>
                            <tr></tr>
                            <tr>
                                @php
                                    $i = 1;
                                    $x = 0;
                                @endphp
                              
                        </thead>
                        <tbody>
                        @php
                            $x=0;
                            $i=0;
                        @endphp

                        <tr class="border-b">
                            @foreach ($formDatas as $formData)
                                
                                    @if($x == 0)
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 bg-slate-300 border-b" colspan="3" style="background: hsla(0, 0%, 80%, 0.433);">
                                        {{ $formData->attribute->name }}</td></tr>
                                        <tr class="bg-slate-100">
                                            <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900 border border-2">Age</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900 border border-2">male</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900 border border-2"> Female</td>
                                        </tr>
                                        
                                    @endif
                                    @php
                                            $x++;
                                            if($x==3)
                                                $x = 0; 
                                    @endphp

                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 border border-2">
                                        {{ $formData->age_group->slug }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 border border-2">{{ $formData->male }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 border border-2">{{ $formData->female ?: 0}}
                                        </td>
                                    </tr>
                                    @endforeach </tr>
                                </table>

                            </div>
                

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

</div>
{{-- @push('script')
<script src="https://cdn.tailwindcss.com"></script>
@endpush --}}
