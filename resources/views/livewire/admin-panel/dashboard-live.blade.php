<div>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h2>Welcome to <span class="text-danger"><span style="color: #012a6c;">US</span><span
                                    style="color: #c2113b;">AID</span></span> Afya Shirikishi,</h2>
                        <p class="mb-md-0">Your dashboard for tracking data for <span class="text-danger"><span
                                    style="color: #012a6c;">US</span><span style="color: #c2113b;">AID</span></span>
                            Afya Shirikishi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body dashboard-tabs p-0">
                    <ul class="nav nav-tabs px-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview"
                                role="tab" aria-controls="overview" aria-selected="true">Visits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="sales-tab" data-bs-toggle="tab" href="#sales" role="tab"
                                aria-controls="sales" aria-selected="false">Reports</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="purchases-tab" data-bs-toggle="tab" href="#purchases" role="tab"
                                aria-controls="purchases" aria-selected="false">ACF</a>
                        </li> --}}
                    </ul>
                    <div class="tab-content py-0 px-0">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel"
                            aria-labelledby="overview-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div
                                    class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-account-multiple icon-lg me-3 text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Reginal Corrdinators</small>
                                        <div class="dropdown">
                                            {{-- <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium"
                                                href="#" role="button" id="dropdownMenuLinkA"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> --}}
                                            <h5 class="mb-0 d-inline-block">{{ $rcs_count }}
                                            </h5>
                                            {{-- </a> --}}
                                            {{-- <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                                <a class="dropdown-item" href="#">12 Aug 2018</a>
                                                <a class="dropdown-item" href="#">22 Sep 2018</a>
                                                <a class="dropdown-item" href="#">21 Oct 2018</a>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    {{-- <i class="mdi mdi-location me-3 icon-lg text-danger"></i> --}}
                                    <img src="{{ asset('admin/images/map-marker.png') }}" alt="" srcset=""
                                        width="40px" class="me-3">
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Visited Regions</small>
                                        <h5 class="me-2 mb-0">{{ $region_count }} / {{ $total_regions }}</h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    {{-- <i class="mdi mdi-eye me-3 icon-lg text-success"></i> --}}
                                    <img src="{{ asset('admin/images/map-pinpoint.png') }}" alt=""
                                        srcset="" width="45px" class="me-3">
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Visited Districts</small>
                                        <h5 class="me-2 mb-0">{{ $district_count }} / {{ $total_districts }}</h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    {{-- <i class="mdi mdi-download me-3 icon-lg text-warning"></i> --}}
                                    <img src="{{ asset('admin/images/place-marker.png') }}" alt=""
                                        srcset="" width="45px" class="me-3">
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Visited Wards</small>
                                        <h5 class="me-2 mb-0">{{ $ward_count }} / {{ $total_wards }}</h5>
                                    </div>
                                </div>
                                {{-- <div
                                    class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Presumptive TB tested</small>
                                        <h5 class="me-2 mb-0">3497843</h5>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div
                                    class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-file-multiple icon-lg me-3 text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted"> All Reports</small>
                                        <div class="dropdown">
                                            {{-- <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium"
                                                href="#" role="button" id="dropdownMenuLinkA"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> --}}
                                            <h5 class="mb-0 d-inline-block">{{ $total_reports_count }}</h5>
                                            {{-- </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                                <a class="dropdown-item" href="#">12 Aug 2018</a>
                                                <a class="dropdown-item" href="#">22 Sep 2018</a>
                                                <a class="dropdown-item" href="#">21 Oct 2018</a>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-file-check me-3 icon-lg text-success"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Submitted Reports</small>
                                        <h5 class="me-2 mb-0">{{ $submitted_report_count }}</h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-file me-3 icon-lg text-primary"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Reports in Fields</small>
                                        <h5 class="me-2 mb-0">{{ $reports_in_field_count }}</h5>
                                    </div>
                                </div>
                                {{-- <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Presumptive TB referred</small>
                                        <h5 class="me-2 mb-0">$577545</h5>
                                    </div>
                                </div> --}}
                                {{-- <div
                                    class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Presumptive TB tested</small>
                                        <h5 class="me-2 mb-0">3497843</h5>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        {{-- <div class="tab-pane fade" id="purchases" role="tabpanel" aria-labelledby="purchases-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div
                                    class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Received Education</small>
                                        <div class="dropdown">
                                            <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium"
                                                href="#" role="button" id="dropdownMenuLinkA"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                                <a class="dropdown-item" href="#">12 Aug 2018</a>
                                                <a class="dropdown-item" href="#">22 Sep 2018</a>
                                                <a class="dropdown-item" href="#">21 Oct 2018</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Screened for TB</small>
                                        <h5 class="me-2 mb-0">$577545</h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Presumptive TB identified</small>
                                        <h5 class="me-2 mb-0">9833550</h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Presumptive TB referred</small>
                                        <h5 class="me-2 mb-0">2233783</h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Presumptive TB tested</small>
                                        <h5 class="me-2 mb-0">3497843</h5>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (count($labels) > 0 && count($maleDatasets) > 0 && count($femaleDatasets) > 0)
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        {{-- <div class="row justify-content-between align-items-center"> --}}
                        <div class="row">
                            <div class="col-md-6">
                                <p class="card-title">{{ $formsAttribute->name }} Field Data</p>
                            </div>
                            {{-- <div class="col-md-6">
                            <div class="form-group">
                                <select wire:model.live="form_id" class="form-control form-control-sm text-dark"
                                    wire:change="getChartData">
                                    <option value="" class="fw-bold" id="form_id">Select Form</option>
                                    @foreach ($formsAttributes as $formsAttribute)
                                        <option value="{{ $formsAttribute->id }}">{{ $formsAttribute->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('form_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div> --}}
                            {{-- <div class="col-md-2">
                            <button wire:click="getChartData">Refresh</button>
                        </div> --}}
                        </div>
                        <p class="mb-3">Number of individual received TB health Education (estimated number in hot
                            spot area)</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="cash-deposits-charty-legend" class="d-flex justify-content-center pt-0">
                                </div>
                                <canvas id="cash-deposits-charty"></canvas>
                            </div>
                        </div>
                        {{-- @else
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    Curre
                                </div>
                            </div>
                        </div> --}}

                        {{-- </div> --}}
                    </div>
                </div>
                {{-- <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Choose Report Title</p> --}}
                {{-- <h1>$ 28835</h1>
                        <h4>Gross sales over the years</h4>
                        <p class="text-muted">Today, many people rely on computers to do homework, work, and create or
                            store useful information. Therefore, it is important </p>
                        <div id="total-sales-chart-legend"></div> --}}
                {{-- </div> --}}
                {{-- <canvas id="total-sales-chart"></canvas> --}}
                {{-- </div>
            </div> --}}
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-6">Recent Reports</div>
                        </div>
                        <div class="row justify-content-between align-items-center mt-4">
                            <div class="col-6">
                                <input type="text" wire:model.live="keywords" class="form-control form-control-sm"
                                    id="keywords"
                                    placeholder="Search by report name, ward, or Reginal coordinator names">
                            </div>
                            {{-- @if (auth()->user()->can('download reports'))
                                <div class="col-4">
                                    <a href="{{ route('form.export', []) }}"
                                        class="btn btn-danger btn-sm text-white text-white d-flex align-items-center"
                                        style="float: right;">
                                        <i class="mdi mdi-download me-2 mt-1"></i>
                                        Download All Reports
                                    </a>
                                </div>
                            @endif --}}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="recent-purchases-listing" class="table table-hover table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Scanning Name</th>
                                    <th>Region</th>
                                    <th>District</th>
                                    <th>ward</th>
                                    <th>Reginal Cordinator</th>
                                    <th>Submition date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @forelse($submitted_field_reports as $report)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            {{-- <a href="{{ route('formOne.export', ['formdata_id' => $report->id]) }}"
                                                style="text-decoration: none;"> --}}
                                            {{ Str::limit($report->scanning_name, 20) }}
                                            {{-- </a> --}}
                                        </td>
                                        <td>{{ $report->ward->district->region->name }}</td>
                                        <td>{{ $report->ward->district->name }}</td>
                                        <td>{{ $report->ward->name }}</td>
                                        <td>{{ $report->added_by->first_name }} {{ $report->added_by->last_name }}
                                        </td>
                                        <td>{{ $report->updated_at->format('M d, Y') }}</td>
                                        <td>
                                            {{-- <a href="{{ route('formOne.export', ['formdata_id' => $report->id]) }}"
                                                class="btn btn-danger btn-sm text-white"
                                                style="text-decoration: none;"><i class="mdi mdi-download"></i></a> --}}
                                            <a href="{{ route('singleFormData.export', ['form_id' => $report->id]) }}"
                                                class="btn btn-danger btn-sm text-white"
                                                style="text-decoration: none;"><i class="mdi mdi-download"
                                                    title="Download excel"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="8">No report found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        var data;
        var cashDepositsCanvas;

        // window.addEventListener('updateChart', event => {
        // cashDepositsCanvas.update();

        // });

        window.addEventListener('renderChart', event => {
            // cashDepositsCanvas.update();

            if ({{ count($labels) }} != 0) {

                if ($('#cash-deposits-charty').length) {
                    cashDepositsCanvas = $("#cash-deposits-charty").get(0).getContext("2d");
                    data = {
                        labels: @json($labels),
                        datasets: [{
                                label: 'Male',
                                data: @json($maleDatasets),
                                borderColor: [
                                    '#012a6c', '#c21138'
                                ],
                                borderWidth: 2,
                                fill: false,
                                pointBackgroundColor: "#fff",
                                // backgroundColor: 'blue',
                                // barPercentage: 5,
                                // barThickness: 20,
                                // maxBarThickness: 50,
                                // minBarLength: 2,

                            },
                            {
                                label: 'Female',
                                data: @json($femaleDatasets),
                                borderColor: [
                                    '#c21138', '#012a6c'
                                ],
                                borderWidth: 2,
                                fill: false,
                                pointBackgroundColor: "#fff",
                                // backgroundColor: 'red',
                                // barPercentage: 5,
                                // barThickness: 20,
                                // maxBarThickness: 50,
                                // minBarLength: 2,

                            },

                        ]
                    };
                    var options = {
                        scales: {
                            yAxes: [{
                                display: true,
                                gridLines: {
                                    drawBorder: false,
                                    lineWidth: 1,
                                    color: "#e9e9e9",
                                    zeroLineColor: "#e9e9e9",
                                },
                                ticks: {
                                    min: 0,
                                    // max: 10000,
                                    stepSize: 200,
                                    fontColor: "#6c7383",
                                    fontSize: 13,
                                    fontStyle: 300,
                                    padding: 10
                                }
                            }],
                            xAxes: [{
                                display: true,
                                gridLines: {
                                    drawBorder: false,
                                    lineWidth: 1,
                                    color: "#e9e9e9",
                                },
                                ticks: {
                                    fontColor: "#6c7383",
                                    fontSize: 13,
                                    fontStyle: 300,
                                    padding: 15,
                                    autoSkip: false,
                                    maxRotation: 45,
                                    minRotation: 45,

                                }
                            }]
                        },
                        legend: {
                            display: false
                        },
                        legendCallback: function(chart) {
                            var text = [];
                            text.push('<ul class="dashboard-chart-legend">');
                            for (var i = 0; i < chart.data.datasets.length; i++) {
                                text.push('<li><span style="background-color: ' + chart.data.datasets[i]
                                    .borderColor[0] +
                                    ' "></span>');
                                if (chart.data.datasets[i].label) {
                                    text.push(chart.data.datasets[i].label);
                                }
                            }
                            text.push('</ul>');
                            return text.join("");
                        },
                        elements: {
                            point: {
                                radius: 3
                            },
                            line: {
                                tension: 0
                            }
                        },
                        stepsize: 1,
                        layout: {
                            padding: {
                                top: 0,
                                bottom: 5,
                                left: 0,
                                right: 0
                            }
                        }
                    };
                    var cashDeposits = new Chart(cashDepositsCanvas, {
                        type: 'line',
                        data: data,
                        options: options
                    });
                    document.getElementById('cash-deposits-charty-legend').innerHTML = cashDeposits
                        .generateLegend();
                }

            }

        });
    </script>
@endpush
