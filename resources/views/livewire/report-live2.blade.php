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
                        <div class="row">
                            <div class="col-8">Reports</div>
                        </div>
                        <div class="row justify-content-between align-items-center mt-4">
                            <div class="col-5">
                                <input type="text" wire:model.live="keywords" class="form-control form-control-sm"
                                    id="keywords"
                                    placeholder="Search by report name, ward, or Reginal coordinator names">
                            </div>
                            <div class="col-3">
                                <input type="date" wire:model.live="date" class="form-control form-control-sm"
                                    id="date" placeholder="Filter by date">
                            </div>
                            @if (auth()->user()->can('download reports'))
                                <div class="col-4">
                                    <a href="{{ route('form.export', []) }}" class="btn btn-danger btn-sm text-white"
                                        style="float: right;">
                                        {{-- <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-2">
                                        <path d="M17 17H17.01M17.4 14H18C18.9319 14 19.3978 14 19.7654 14.1522C20.2554 14.3552 20.6448 14.7446 20.8478 15.2346C21 15.6022 21 16.0681 21 17C21 17.9319 21 18.3978 20.8478 18.7654C20.6448 19.2554 20.2554 19.6448 19.7654 19.8478C19.3978 20 18.9319 20 18 20H6C5.06812 20 4.60218 20 4.23463 19.8478C3.74458 19.6448 3.35523 19.2554 3.15224 18.7654C3 18.3978 3 17.9319 3 17C3 16.0681 3 15.6022 3.15224 15.2346C3.35523 14.7446 3.74458 14.3552 4.23463 14.1522C4.60218 14 5.06812 14 6 14H6.6M12 15V4M12 15L9 12M12 15L15 12" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg> --}}
                                        Download All Reports
                                    </a>
                                </div>
                            @endif
                        </div>
                    </h4>

                    <div class="table-responsive">

                        @include('exports.form')

                    </div>

                    <div wire:ignore class="row align-items-center mt-5">
                        <div class="col-6 fw-bold text-uppercase">Overall Field Data report</div>
                        <div class="col-2 fw-bold">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"
                                        wire:model.live="quartiles.{{ 'all' }}" value="all"
                                        class="quartile-checkbox">
                                    All Quatiles
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-danger btn-sm text-white" wire:click='submit()'
                                style="text-transform: uppercase; float: right;">Export Selected Quartile(s)
                                Report</button>
                        </div>

                    </div>

                    <div wire:ignore
                        class="row form-group d-flex justify-contect-between align-items-center mt-4 fw-bold">
                        {{-- <div class="col-2">        
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" wire:model="quartiles.{{'all'}}" value="All" class="quartile-checkbox">
                                        All Quatiles
                                    </label>
                                </div>
                            </div> --}}

                        <div class="col-2">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"
                                        wire:model="quartiles.{{ 'q1' }}" value="q1"
                                        class="quartile-checkbox">
                                    1st Quartile
                                </label>
                                <div class="mx-2">
                                    <input type="checkbox" class="mx-2" wire:model="quartiles.{{ 'q2' }}"
                                        value="q2" class="quartile-checkbox">
                                    <label>2nd Quartile</label>
                                </div>

                                <div class="mx-2">
                                    <input type="checkbox" class="mx-2" wire:model="quartiles.{{ 'q3' }}"
                                        value="q3" class="quartile-checkbox">
                                    <label>3rd Quartile</label>
                                </div>

                                <div class="mx-2">
                                    <input type="checkbox" class="mx-3" wire:model="quartiles.{{ 'q4' }}"
                                        value="q4" class="quartile-checkbox">
                                    <label>4th Quartile</label>
                                </div>


                                {{-- <div class="mx-2 flex inline">
                                        <input type="checkbox" class="mx-2" wire:model="quartiles.{{'user'}}" value="user" class="quartile-checkbox">
                                        
                                        <select placeholder="by user" >
                                            @foreach ($users as $user)
                                                 <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}

                                <button type="submit" wire:click='submit()'
                                    class="bg-blue-500 text-white py-1 px-2 rounded-lg">SEE REPORT</button>

                                </form>
                                <div class="mx-6">
                                    @php

                                        $newRange = implode(',', $quartRange);
                                    @endphp
                                    <a href="{{ route('formdata.export', ['range' => $newRange]) }}"
                                        class="bg-green-500 text-white font-medium px-2 py-2 w-fit flex items-center"
                                        style="float: right;">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="mx-2">
                                            <path
                                                d="M17 17H17.01M17.4 14H18C18.9319 14 19.3978 14 19.7654 14.1522C20.2554 14.3552 20.6448 14.7446 20.8478 15.2346C21 15.6022 21 16.0681 21 17C21 17.9319 21 18.3978 20.8478 18.7654C20.6448 19.2554 20.2554 19.6448 19.7654 19.8478C19.3978 20 18.9319 20 18 20H6C5.06812 20 4.60218 20 4.23463 19.8478C3.74458 19.6448 3.35523 19.2554 3.15224 18.7654C3 18.3978 3 17.9319 3 17C3 16.0681 3 15.6022 3.15224 15.2346C3.35523 14.7446 3.74458 14.3552 4.23463 14.1522C4.60218 14 5.06812 14 6 14H6.6M12 15V4M12 15L9 12M12 15L15 12"
                                                stroke="#FFF" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        DOWNLOAD REPORT </a>
                                </div>
                                <div id="selectedQuartilesSection">

                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"
                                            wire:model="quartiles.{{ 'q2' }}" value="q2"
                                            class="quartile-checkbox">
                                        2nd Quartile
                                    </label>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"
                                            wire:model="quartiles.{{ 'q3' }}" value="q3"
                                            class="quartile-checkbox">
                                        3rd Quartile
                                    </label>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"
                                            wire:model="quartiles.{{ 'q4' }}" value="q4"
                                            class="quartile-checkbox">
                                        4th Quartile
                                    </label>
                                </div>
                            </div>


                            <div class="col-4">
                                {{-- "checkbox" class="mx-2" wire:model="quartiles.{{'user'}}" value="user" class="quartile-checkbox"> --}}

                                <select class="form-control form-control-sm text-dark"
                                    wire:model="quartiles.{{ 'user' }}">
                                    <option value="">Select Regional Cordinatal</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }}
                                            {{ $user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="">
                                    <a href="{{ route('formdata.export') }}" class="btn btn-danger text-white" style="float: right;"> --}}
                            {{-- <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-2">
                                        <path d="M17 17H17.01M17.4 14H18C18.9319 14 19.3978 14 19.7654 14.1522C20.2554 14.3552 20.6448 14.7446 20.8478 15.2346C21 15.6022 21 16.0681 21 17C21 17.9319 21 18.3978 20.8478 18.7654C20.6448 19.2554 20.2554 19.6448 19.7654 19.8478C19.3978 20 18.9319 20 18 20H6C5.06812 20 4.60218 20 4.23463 19.8478C3.74458 19.6448 3.35523 19.2554 3.15224 18.7654C3 18.3978 3 17.9319 3 17C3 16.0681 3 15.6022 3.15224 15.2346C3.35523 14.7446 3.74458 14.3552 4.23463 14.1522C4.60218 14 5.06812 14 6 14H6.6M12 15V4M12 15L9 12M12 15L15 12" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg> --}}
                            {{-- Download Report 
                                    </a>
                                </div>
                                 --}}
                            {{-- <div id="selectedQuartilesSection">
                                
                            </div> --}}
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-sm">
                                <thead>
                                    <tr>
                                        @php
                                            $i = 1;
                                            $x = 0;
                                        @endphp
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $x = 0;
                                        $i = 0;
                                    @endphp

                                    @foreach ($formDatas as $formData)
                                        @if ($x == 0)
                                            <tr>
                                                <td colspan="3">{{ $formData->attribute->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Age</td>
                                                <td>male</td>
                                                <td> Female</td>
                                            </tr>
                                        @endif
                                        @php
                                            $x++;
                                            if ($x == 3) {
                                                $x = 0;
                                            }
                                        @endphp

                                        <tr>
                                            <td>{{ $formData->age_group->slug }}</td>
                                            <td>{{ $formData->male }}</td>
                                            <td>{{ $formData->female }}</td>
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
