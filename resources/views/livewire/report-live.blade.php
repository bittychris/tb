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
                            <div class="col-12">
                                <button
                                    class="btn border-{{ $navigate_to == 'report' ? 'danger border-2 text-danger' : 'dark text-dark' }} fw-bold text-uppercase me-3"
                                    wire:click="navigateTo('report')" type="button">
                                    Reports
                                </button>
                                <button
                                    class="btn border-{{ $navigate_to == 'overall-report' ? 'danger border-2 text-danger' : 'dark text-dark' }} fw-bold text-uppercase"
                                    wire:click="navigateTo('overall-report')">
                                    Overall Field Data
                                </button>
                            </div>
                        </div>
                    </h4>

                    <div class="row">
                        @if ($navigate_to == 'report')
                            <div class="col-12">
                                <div class="row justify-content-between align-items-center mt-4 mb-4">
                                    <div class="col-5">
                                        <input type="text" wire:model.live="keywords"
                                            class="form-control form-control-sm" id="keywords"
                                            placeholder="Search by report name, ward, or Reginal coordinator names">
                                    </div>
                                    <div class="col-3">
                                        <input type="date" wire:model.live="date"
                                            class="form-control form-control-sm" id="date"
                                            placeholder="Filter by date">
                                    </div>
                                    @if (auth()->user()->can('download reports'))
                                        <div class="col-4">
                                            <a href="{{ route('form.export', []) }}"
                                                class="btn btn-danger btn-sm text-white text-white d-flex align-items-center"
                                                style="float: right;">
                                                {{-- <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-2">
                                            <path d="M17 17H17.01M17.4 14H18C18.9319 14 19.3978 14 19.7654 14.1522C20.2554 14.3552 20.6448 14.7446 20.8478 15.2346C21 15.6022 21 16.0681 21 17C21 17.9319 21 18.3978 20.8478 18.7654C20.6448 19.2554 20.2554 19.6448 19.7654 19.8478C19.3978 20 18.9319 20 18 20H6C5.06812 20 4.60218 20 4.23463 19.8478C3.74458 19.6448 3.35523 19.2554 3.15224 18.7654C3 18.3978 3 17.9319 3 17C3 16.0681 3 15.6022 3.15224 15.2346C3.35523 14.7446 3.74458 14.3552 4.23463 14.1522C4.60218 14 5.06812 14 6 14H6.6M12 15V4M12 15L9 12M12 15L15 12" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg> --}}
                                                <i class="mdi mdi-download me-2 mt-1"></i>
                                                Download All Reports
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <div class="table-responsive">

                                    @include('exports.form')
                                    {{ $forms->links() }}

                                </div>
                            </div>

                        @endif

                        @if ($navigate_to == 'overall-report')
                            <div class="col-12">
                                <div class=" justify-between align-items-center mb-4">
                                    <div class="font-bold flex">
                                        <form class="px-2 py-2" wire:submit.prevent="submit">
                                            @csrf
                                            <div class="row d-flex justify-content-between align-items-center">
                                                <div class="col-md-4 align-items-center">
                                                    <input type="radio" name="group1" class="me-2"
                                                        wire:model="quartiles.{{ 'all' }}" value="All"
                                                        class="quartile-checkbox" wire:change="submit">
                                                    <label class="mx-2">All</label>
                                                </div>
                                                <div class="col-md-4 d-flex align-items-center">
                                                    <label for="startDate">From:</label>
                                                    <input type="date" class="form-control form-control-sm ms-2 me-3"
                                                        id="startDate" wire:model="startdate"
                                                        wire:change="updateStartDate">

                                                    <label for="endDate">To:</label>
                                                    <input type="date" class="form-control form-control-sm ms-2"
                                                        id="endDate" wire:model="enddate" wire:change="updateEndDate">
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="" style="">
                                                        @php
                                                            $newRange = implode(',', $quartRange);
                                                        @endphp
                                                        <a href="{{ route('formdata.export', ['range' => $newRange]) }}"
                                                            class="btn btn-danger btn-sm text-white text-white d-flex align-items-center"
                                                            style="float: right;">
                                                            {{-- <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg"
                                                                class="mx-2">
                                                                <path
                                                                    d="M17 17H17.01M17.4 14H18C18.9319 14 19.3978 14 19.7654 14.1522C20.2554 14.3552 20.6448 14.7446 20.8478 15.2346C21 15.6022 21 16.0681 21 17C21 17.9319 21 18.3978 20.8478 18.7654C20.6448 19.2554 20.2554 19.6448 19.7654 19.8478C19.3978 20 18.9319 20 18 20H6C5.06812 20 4.60218 20 4.23463 19.8478C3.74458 19.6448 3.35523 19.2554 3.15224 18.7654C3 18.3978 3 17.9319 3 17C3 16.0681 3 15.6022 3.15224 15.2346C3.35523 14.7446 3.74458 14.3552 4.23463 14.1522C4.60218 14 5.06812 14 6 14H6.6M12 15V4M12 15L9 12M12 15L15 12"
                                                                    stroke="#FFF" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg> --}}
                                                            <i class="mdi mdi-download me-2 mt-1"></i>
                                                            DOWNLOAD REPORT
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex my-5 justify-content-between align-items-center">
                                                <div class="">
                                                    <input type="radio" name="group1" class="me-2"
                                                        wire:model="quartiles.{{ 'q1' }}" value="q1"
                                                        class="quartile-checkbox" wire:change="submit">
                                                    <label>1st Quartile</label>
                                                </div>

                                                <div class="">
                                                    <input type="radio" name="group1" class="me-2"
                                                        wire:model="quartiles.{{ 'q2' }}" value="q2"
                                                        class="quartile-checkbox" wire:change="submit">
                                                    <label>2nd Quartile</label>
                                                </div>

                                                <div class="">
                                                    <input type="radio" name="group1" class="me-2"
                                                        wire:model="quartiles.{{ 'q3' }}" value="q3"
                                                        class="quartile-checkbox" wire:change="submit">
                                                    <label>3rd Quartile</label>
                                                </div>

                                                <div class="">
                                                    <input type="radio" name="group1" class="me-2"
                                                        wire:model="quartiles.{{ 'q4' }}" value="q4"
                                                        class="quartile-checkbox" wire:change="submit">
                                                    <label>4th Quartile</label>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <label for="selectedYear" class="me-2">Year: </label>
                                                    <select id="selectedYear" wire:model="selectedYear"
                                                        class="form-control" placeholder="year">
                                                        <option value="" selected>Select year ...</option>
                                                        @for ($year = date('Y'); $year >= date('Y') - 10; $year--)
                                                            <option value="{{ $year }}">{{ $year }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>

                                                {{-- <button type="submit" class="bg-blue-500 text-white py-1 px-2 rounded-lg btn btn-primary" wire:click='submit($quartRange)'>SEE REPORT</button> --}}


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

                                        <p>Selected Quartile: <span
                                                class="font-weight-bold">{{ $newRange }}</span></p>
                                    </div>
                                </div>

                                <div class="table-resposive mt-3">
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr></tr>
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

                                            <tr>
                                                @foreach ($formDatas as $formData)
                                                    @if ($x == 0)
                                                        <td colspan="3" class="mt-2"
                                                            style="background: #cccccc5d">
                                                            {{ $formData->attribute->name }}</td>
                                            </tr>
                                            <tr class="bg-slate-100">
                                                <td
                                                    class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900 border border-2">
                                                    Age</td>
                                                <td
                                                    class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900 border border-2">
                                                    male</td>
                                                <td
                                                    class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900 border border-2">
                                                    Female</td>
                                            </tr>
                        @endif
                        @php
                            $x++;
                            if ($x == 3) {
                                $x = 0;
                            }
                        @endphp

                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 border border-2">
                                {{ $formData->age_group->slug }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 border border-2">
                                {{ $formData->male }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 border border-2">
                                {{ $formData->female ?: 0 }}
                            </td>
                        </tr>
                        @endforeach
                        </tr>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
</div>

@push('js')
    <script>
        window.addEventListener('openCommentModel', event => {
            $('#commentsModal').modal('show');
        });

        window.addEventListener('closeCommentModel', event => {
            $('#commentsModal').modal('hide');
        });
    </script>
@endpush
