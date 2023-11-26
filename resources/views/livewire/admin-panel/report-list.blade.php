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
                            <div class="col-6">
                                <a href="{{ route('admin.create_form_data') }}" class="btn btn-primary text-white btn-sm" style="float: right;"><i class="mdi mdi-plus"></i> Create Report</a>
                            </div>
                        </div>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>
