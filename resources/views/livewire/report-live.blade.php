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
                                <div class=" justify-content-between align-items-center mb-4">
                                    <div class="font-bold flex">
                                        <form class="px-2 py-2" wire:submit.prevent="submit">
                                            @csrf
                                            <div class="row d-flex justify-content-between align-items-center">
                                                <div class="col-md-3 align-items-center d-flex">
                                                    <label for="selectedYear" class="me-2">Year:</label>
                                                    <select id="selectedYear" wire:model="selectedYear"
                                                        class="form-control me-5 ms-2" placeholder="year">
                                                        @for ($year = date('Y'); $year >= date('Y') - 25; $year--)
                                                            <option value="{{ $year }}">{{ $year }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-md-5 d-flex align-items-center">
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
                                                @if (count($formData) != 0)
                                                    @if (empty($region_id))
                                                        <div class="col-md-4">
                                                            <div class="" style="">
                                                                <a href="{{ route('formdata.export', ['range' => $newRange]) }}"
                                                                    class="bbtn btn-danger btn-sm text-white text-white d-flex align-items-center text-decoration-none"
                                                                    style="float: right;">
                                                                    <i class="mdi mdi-download me-2 mt-1"></i>
                                                                    DOWNLOAD REPORT
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @elseif (!empty($region_id) && count($form_ids) != 0)
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
                                                <div class="d-flex align-items-center">
                                                    <button type="button"
                                                        class="btn {{ $select_all_quartiles == true ? 'btn-primary' : 'btn-danger' }} text-white"
                                                        wire:click="{{ $select_all_quartiles == true ? 'DeselectAllQuartiles' : 'SelectAllQuartiles' }}">
                                                        {{ $select_all_quartiles == true ? 'Select By Quatile(s)' : 'All Quatiles' }}</button>
                                                </div>
                                                <div class="">
                                                    <input type="radio" name="quartile" class="me-2"
                                                        {{ $select_all_quartiles == true ? 'hidden' : '' }}
                                                        wire:model="quartile" wire:change="submit" value="q1">
                                                    <label>1st Quartile</label>
                                                </div>

                                                <div class="">
                                                    <input type="radio" name="quartile"
                                                        {{ $select_all_quartiles == true ? 'hidden' : '' }}
                                                        wire:model="quartile" wire:change="submit" class="me-2"
                                                        value="q2">
                                                    <label>2nd Quartile</label>
                                                </div>

                                                <div class="">
                                                    <input type="radio" name="quartile" class="me-2"
                                                        {{ $select_all_quartiles == true ? 'hidden' : '' }}
                                                        wire:model="quartile" wire:change="submit" value="q3">
                                                    <label>3rd Quartile</label>
                                                </div>

                                                <div class="">
                                                    <input type="radio" name="quartile" class="me-2"
                                                        {{ $select_all_quartiles == true ? 'hidden' : '' }}
                                                        wire:model="quartile" wire:change="submit" value="q4">
                                                    <label>4th Quartile</label>
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
                                            </div>
                                        </form>
                                        <p class="fw-bold">From: <span
                                                class="fw-normal ms-2 me-2">{{ date('d/m/Y', strtotime($quartRange[0])) }}</span>
                                            To: <span
                                                class="fw-normal ms-2">{{ date('d/m/Y', strtotime($quartRange[1])) }}</span>
                                        </p>
                                    </div>
                                </div>

                                <div class="table-resposive mt-3 col-md-12">
                                    @if (count($form_ids) != 0 || count($formData) != 0)

                                        @foreach ($attributeList as $attribute)
                                            <table
                                                class="formData table table-bordered border-secondary table-sm mb-3">
                                                <thead>
                                                    <tr>
                                                        <th colspan="3" class="bg-danger text-white"
                                                            style="font-size: 15px; text-align:left;">
                                                            {{ $attribute->name }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-warning" style="font-size: 15px;">Age Group</th>
                                                        <th class="bg-warning" style="font-size: 15px;">F</th>
                                                        <th class="bg-warning" style="font-size: 15px;">M</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    @foreach ($ageGroups as $ageGroup)
                                                        <tr>
                                                            <td>{{ $ageGroup->slug }}</td>
                                                            @if ($attribute->attribute_no == 1.0)
                                                                <td
                                                                    class="{{ $ageGroup->slug == '0-5' ? 'bg-dark text-white' : '' }}">
                                                                    {{ $formData[$ageGroup->id][$attribute->id]['F'] ?? '---' }}
                                                                </td>
                                                                <td
                                                                    class="{{ $ageGroup->slug == '0-5' ? 'bg-dark text-white' : '' }}">
                                                                    {{ $formData[$ageGroup->id][$attribute->id]['M'] ?? '---' }}
                                                                </td>
                                                            @elseif ($attribute->attribute_no == 10.0)
                                                                <td
                                                                    class="{{ $ageGroup->slug == '6-14' || $ageGroup->slug == '15 & above' ? 'bg-dark text-white' : '' }}">
                                                                    {{ $formData[$ageGroup->id][$attribute->id]['F'] ?? '---' }}
                                                                </td>
                                                                <td
                                                                    class="{{ $ageGroup->slug == '6-14' || $ageGroup->slug == '15 & above' ? 'bg-dark text-white' : '' }}">
                                                                    {{ $formData[$ageGroup->id][$attribute->id]['M'] ?? '---' }}
                                                                </td>
                                                            @else
                                                                <td>
                                                                    {{ $formData[$ageGroup->id][$attribute->id]['F'] ?? 0 }}
                                                                </td>
                                                                <td>
                                                                    {{ $formData[$ageGroup->id][$attribute->id]['M'] ?? 0 }}
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                    <tr class="bg-secondary text-white">
                                                        <td class="fw-bold" style="font-size: 15px;">Total</td>
                                                        <td class="fw-bold" style="font-size: 15px;">
                                                            {{ $this->calculateTotal($attribute->id, 'F') }}</td>
                                                        <td class="fw-bold" style="font-size: 15px;">
                                                            {{ $this->calculateTotal($attribute->id, 'M') }}</td>
                                                    </tr>

                                                    <!-- Add Grand Total row -->
                                                    <tr class="bg-success text-white">
                                                        <td class="fw-bold" style="font-size: 15px;">Grand Total</td>
                                                        <td class="fw-bold" style="font-size: 15px;" colspan="2">
                                                            {{ $this->calculateTotal($attribute->id, 'F') + $this->calculateTotal($attribute->id, 'M') }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @endforeach
                                    @else
                                        <div class="row mt-4 justify-content-center align-items-center mx-1">
                                            <div class="col-md-12 bg-danger text-center text-white fw-bold py-4">
                                                No Overall Field Data found
                                            </div>
                                        </div>
                                    @endif

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
