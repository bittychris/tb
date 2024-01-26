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
                            <div class="col-6">Reports</div>
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
                    </h4>
                    <div class="table-responsive">
                        @include('exports.form')
                        {{ $forms->links() }}

                    </div>

                    <div class="row align-items-center mt-5">
                        <div class=" col-12 fw-bold text-uppercase">Overall Field Data</div>
                    </div>
                    <div class="row d-flex justify-between align-items-center">
                        <div class=" col-12">
                            <form class="forms-sample" wire:submit.prevent="submit">
                                @csrf
                                <div class="row d-flex justify-content-between align-items-center mt-3">
                                    <div class="col-2">
                                        <div class="">
                                            <input type="checkbox" id="all-q" class="me-2 form-check-input"
                                                wire:model="quartiles.{{ 'all' }}" value="All"
                                                class="quartile-checkbox">
                                            <label class="mt-1" for="all-q">All Quartile</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="">
                                            <input type="checkbox" id="q1" class="me-2 form-check-input"
                                                wire:model="quartiles.{{ 'q1' }}" value="q1"
                                                class="quartile-checkbox">
                                            <label class="mt-1" for="q1">1st Quartile</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="">
                                            <input type="checkbox" id="q2" class="me-2 form-check-input"
                                                wire:model="quartiles.{{ 'q2' }}" value="q2"
                                                class="quartile-checkbox">
                                            <label class="mt-1" for="q2">2nd Quartile</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="">
                                            <input type="checkbox" id="q3" class="me-2 form-check-input"
                                                wire:model="quartiles.{{ 'q3' }}" value="q3"
                                                class="quartile-checkbox">
                                            <label class="mt-1" for="q3">3rd Quartile</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="">
                                            <input type="checkbox" id="q4" class="me-2 form-check-input"
                                                wire:model="quartiles.{{ 'q4' }}" value="q4"
                                                class="quartile-checkbox">
                                            <label class="mt-1" for="q4">4th Quartile</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-primary text-white rounded-lg">View
                                            Report</button>
                                    </div>
                                </div>
                            </form>

                            @if (count($formDatas) != 0)
                                <div class="row d-flex align-items-center mt-5">
                                    <div class="col-6 text-uppercase">
                                        Overall data for Selected Quatile(s)
                                    </div>
                                    <div class="col-6">
                                        @php
                                            $newRange = implode(',', $quartRange);
                                        @endphp
                                        <a href="{{ route('formdata.export', ['range' => $newRange]) }}"
                                            class="btn btn-danger btn-sm text-white d-flex align-items-center"
                                            style="float: right;">
                                            {{-- <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="mx-2">
                                        <path
                                            d="M17 17H17.01M17.4 14H18C18.9319 14 19.3978 14 19.7654 14.1522C20.2554 14.3552 20.6448 14.7446 20.8478 15.2346C21 15.6022 21 16.0681 21 17C21 17.9319 21 18.3978 20.8478 18.7654C20.6448 19.2554 20.2554 19.6448 19.7654 19.8478C19.3978 20 18.9319 20 18 20H6C5.06812 20 4.60218 20 4.23463 19.8478C3.74458 19.6448 3.35523 19.2554 3.15224 18.7654C3 18.3978 3 17.9319 3 17C3 16.0681 3 15.6022 3.15224 15.2346C3.35523 14.7446 3.74458 14.3552 4.23463 14.1522C4.60218 14 5.06812 14 6 14H6.6M12 15V4M12 15L9 12M12 15L15 12"
                                            stroke="#FFF" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg> --}}
                                            <i class="mdi mdi-download me-2 mt-1"></i>DOWNLOAD REPORT </a>
                                    </div>
                                </div>
                            @else
                                <div class="row d-flex mx-1 align-items-center mt-5 bg-danger">
                                    <div class="col-12 text-center text-white py-4">
                                        There is record of Overall data for the Selected Quatile(s)
                                    </div>
                                </div>
                            @endif

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
                                            <td colspan="3" class="mt-2" style="background: #cccccc5d">
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
                                @endforeach
                                </tr>
                        </table>
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
