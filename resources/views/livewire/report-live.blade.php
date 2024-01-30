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
                                    {{-- <div class="col-3">
                                        <input type="date" wire:model.live="date"
                                            class="form-control form-control-sm" id="date"
                                            placeholder="Filter by date">
                                    </div> --}}
                                    @if (auth()->user()->can('download reports'))
                                        @php
                                            $newRange = implode(',', $quartRange);
                                        @endphp
                                        <div class="col-4">
                                            <a href="{{ route('form.export', []) }}"
                                                class="btn btn-danger btn-sm text-white text-white d-flex align-items-center"
                                                style="float: right;">
                                                <i class="mdi mdi-download me-2 mt-1"></i>
                                                Download All Reports
                                            </a>
                                        </div>
                                    @endif
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
                                                        id="endDate" wire:model="date" wire:change="updateEndDate">
                                                </div>

                                                {{-- <div class="col-md-4">
                                                    <div class="" style="">
                                                       
                                                        <a href="{{ route('formdata.export', ['range' => $newRange]) }}"
                                                            class="btn btn-danger btn-sm text-white text-white d-flex align-items-center"
                                                            style="float: right;">
                                                            <i class="mdi mdi-download me-2 mt-1"></i>
                                                            DOWNLOAD REPORT
                                                        </a>
                                                    </div>
                                                </div> --}}
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
                                                        @for ($year = date('Y'); $year >= date('Y') - 10; $year--)
                                                            <option value="{{ $year }}">{{ $year }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </form>

                                        <p class="fw-bold">Selected Quartile: <span
                                                class="fw-normal">{{ $newRange }}</span></p>
                                    </div>
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
                                                    <input type="date"
                                                        class="form-control form-control-sm ms-2 me-3" id="startDate"
                                                        wire:model="startdate" wire:change="updateStartDate">

                                                    <label for="endDate">To:</label>
                                                    <input type="date" class="form-control form-control-sm ms-2"
                                                        id="endDate" wire:model="enddate"
                                                        wire:change="updateEndDate">
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="" style="">
                                                        @php
                                                            $newRange = implode(',', $quartRange);
                                                        @endphp
                                                        <a href="{{ route('formdata.export', ['range' => $newRange]) }}"
                                                            class="btn btn-danger btn-sm text-white text-white d-flex align-items-center"
                                                            style="float: right;">

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

                                        <p class="fw-bold">Selected Quartile: <span
                                                class="fw-normal">{{ $newRange }}</span></p>
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
