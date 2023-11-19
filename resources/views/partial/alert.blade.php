@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        {{Session::get('success')}}
    </div>
@endif

@if(Session::has('warning'))
    <div class="alert alert-warning alert-dismissible bg-warning text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        {{Session::get('warning')}}
    </div>
@endif

@if(Session::has('deleted'))
    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        {{Session::get('deleted')}}
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        {{Session::get('error')}}
    </div>
@endif

{{-- @if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        @foreach ($errors->all() as $error)
            <ul>
                <li>{{ $error }}</li>
            </ul>
        @endforeach
    </div>
@endif --}}
