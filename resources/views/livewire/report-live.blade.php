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
                                    <div class="col-4">
                                        <input type="text" wire:model.live="keywords"
                                            class="form-control form-control-sm" id="keywords"
                                            placeholder="Search by report name, ward, or RC names">
                                    </div>
                                    <div class="col-md-5 d-flex align-items-center">
                                        <label for="startDate">From:</label>
                                        <input type="date" class="form-control form-control-sm ms-2 me-3"
                                            id="startDate" wire:model="startDate" wire:change="updateStartDate">

                                        <label for="endDate">To:</label>
                                        <input type="date" class="form-control form-control-sm ms-2" id="endDate"
                                            wire:model="endDate" wire:change="updateEndDate">
                                    </div>
                                    {{-- <div class="col-3">
                                        <input type="date" wire:model.live="date"
                                            class="form-control form-control-sm" id="date"
                                            placeholder="Filter by date">
                                    </div> --}}
                                    @if (count($forms) != 0)
                                        {{-- @if (auth()->user()->can('download reports')) --}}
                                        <div class="col-3">
                                            <a href="{{ empty($keywords) ? route('form.export', ['keywords' => 0, 'startDate' => $startDate, 'endDate' => $endDate]) : route('form.export', ['keywords' => $keywords, 'startDate' => $startDate, 'endDate' => $endDate]) }}"
                                                class="bbtn btn-danger btn-sm text-white text-white d-flex align-items-center text-uppercase text-decoration-none"
                                                style="float: right;">
                                                <i class="mdi mdi-download me-2 mt-1"></i>
                                                Download Reports
                                            </a>
                                        </div>
                                        {{-- @endif --}}
                                    @else
                                        <div class="col-md-3">
                                            <div>
                                                <button
                                                    class="btn btn-danger btn-sm text-white text-white d-flex align-items-center"
                                                    style="float: right;" disabled>
                                                    <i class="mdi mdi-download me-2 mt-1"></i>
                                                    DOWNLOAD REPORT
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="table-responsive">

                                    {{-- <div hidden>
                                        @include('exports.form_export')
                                    </div> --}}

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
                                                <div class="col-md-1 align-items-center">
                                                    <input type="checkbox" name="group1" class="me-2"
                                                        wire:model="quartiles" value="all" class="quartile-checkbox"
                                                        wire:change="submit">
                                                    <label class="mx-2">All</label>
                                                </div>
                                                <div class="col-md-4 d-flex align-items-center">
                                                    <label for="startDate">From:</label>
                                                    <input type="date" class="form-control form-control-sm ms-2 me-3"
                                                        id="startDate" wire:model.live="startdate"
                                                        wire:change="updateStartDate">

                                                    <label for="endDate">To:</label>
                                                    <input type="date" class="form-control form-control-sm ms-2"
                                                        id="endDate" wire:model.live="enddate"
                                                        wire:change="updateEndDate">
                                                </div>

                                                @php
                                                    $newRange = implode(',', $quartRange);
                                                @endphp
                                                @if (count($formDatas) != 0)
                                                    @if (empty($region_id))
                                                        <div class="col-md-3">
                                                            <div class="" style="">
                                                                <a href="{{ route('formdata.export', ['range' => $newRange]) }}"
                                                                    class="btn btn-danger btn-sm text-white text-white d-flex align-items-center"
                                                                    style="float: right;">
                                                                    <i class="mdi mdi-download me-2 mt-1"></i>
                                                                    DOWNLOAD REPORT
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @else
                                                        {{-- @if (auth()->user()->can('download reports')) --}}
                                                        <div class="col-4">
                                                            <a href="{{ empty($region_id) ? route('reginal_report.export', ['region_id' => 0, 'startDate' => $startdate, 'endDate' => $enddate]) : route('reginal_report.export', ['region_id' => $region_id, 'startDate' => $startdate, 'endDate' => $enddate]) }}"
                                                                class="bbtn btn-danger btn-sm text-white text-white d-flex align-items-center text-uppercase text-decoration-none"
                                                                style="float: right;">
                                                                <i class="mdi mdi-download me-2 mt-1"></i>
                                                                Download Regional Report
                                                            </a>
                                                        </div>
                                                        {{-- @endif --}}
                                                    @endif
                                                @else
                                                    <div class="col-md-3">
                                                        <div>
                                                            <button
                                                                class="btn btn-danger btn-sm text-white text-white d-flex align-items-center"
                                                                style="float: right;" disabled>
                                                                <i class="mdi mdi-download me-2 mt-1"></i>
                                                                DOWNLOAD REPORT
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>

                                            <div class="d-flex my-5 justify-content-between align-items-center">
                                                <div class="">
                                                    <input type="checkbox" name="group1" class="me-2"
                                                        wire:model="quartiles" value="q1" class="quartile-checkbox"
                                                        wire:change="submit">
                                                    <label>1st Quartile</label>
                                                </div>

                                                <div class="">
                                                    <input type="checkbox" name="group1" class="me-2"
                                                        wire:model="quartiles" value="q2"
                                                        class="quartile-checkbox" wire:change="submit">
                                                    <label>2nd Quartile</label>
                                                </div>

                                                <div class="">
                                                    <input type="checkbox" name="group1" class="me-2"
                                                        wire:model="quartiles" value="q3"
                                                        class="quartile-checkbox" wire:change="submit">
                                                    <label>3rd Quartile</label>
                                                </div>

                                                <div class="">
                                                    <input type="checkbox" name="group1" class="me-2"
                                                        wire:model="quartiles" value="q4"
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
                                                <div class="d-flex align-items-center">
                                                    <label for="selectedYear" class="me-2">Region: </label>
                                                    <select id="selectedYear" wire:model.live="region_id"
                                                        class="form-control" placeholder="year">
                                                        <option value="" selected>All Region </option>
                                                        @foreach ($regions as $region)
                                                            <option value="{{ $region->id }}">{{ $region->name }}
                                                            </option>
                                                        @endforeach
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
                                            @forelse ($formDatas as $formData)
                                                @if ($x == 0)
                                                    <tr>
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
                                                    <td
                                                        class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 border border-2">
                                                        {{ $formData->age_group->slug }}</td>
                                                    <td
                                                        class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 border border-2">
                                                        {{ $formData->male }}
                                                    </td>
                                                    <td
                                                        class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 border border-2">
                                                        {{ $formData->female ?: 0 }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <div class="row mt-4 justify-content-center align-items-center mx-1">
                                                    <div
                                                        class="col-md-12 bg-danger text-center text-white fw-bold py-4">
                                                        No Overall Field Data found
                                                    </div>
                                                </div>
                                            @endforelse
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
