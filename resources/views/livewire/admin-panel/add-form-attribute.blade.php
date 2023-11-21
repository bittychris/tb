<div>
    <div class="row">
        <div class="col-lg-12">
            @if (session()->has('already_exist'))
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
                            <div class="col-6">{{ $editMode == true ? 'Edit Form Attribute' : 'Add Form Attribute' }}</div>
                            <div class="col-6">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_attribute_modal" style="float: right;">Back</i></button>
                            </div>
                        </div>
                    </h4>

                    <form class="forms-sample" wire:submit.prevent="saveFormAttribute">
                        <div class="form-group">
                            <label for="name">Form name</label>
                            <input type="text" wire:model="name" class="form-control form-control-sm" id="name" placeholder="Enter Form name">
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="age_group_ids">Select Age groups</label>
                            <div class="row">
{{--                                <input class="form-check-input" type="checkbox" wire:model="age_group_ids" value="0" id="flexCheckIndeterminateDisabled" checked style="display: none;">--}}
                                @foreach ($ageGroups as $key => $ageGroup)
                                <div class="col-4">
                                    <input class="form-check-input" wire:key="$key" name="selectedAgeGroupIds" type="checkbox" wire:model="selectedAgeGroupIds" value="{{ $ageGroup->id }}" id="group.{{$key}}">
                                    <label class="form-check-label text-secondary" for="group.{{$key}}">
                                        {{ $ageGroup->slug }}
                                    </label>
                                </div>
                                @endforeach

                            </div>
                            <label for="name">Select Attributes</label>
                            <div class="row">
                                @foreach ($attributes as $key => $attribute)
                                <div class="col-4">
                                    <input class="form-check-input" type="checkbox" wire:model="selectedAttributeIds" value="{{ $attribute->id }}" id="attribute.{{$key}}">
                                    <label class="form-check-label text-secondary" for="attribute.{{$key}}">
                                        {{ $attribute->name }}
                                    </label>
                                </div>
                                @endforeach

                            </div>
                            @error('selectedAttributeIds') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mt-3 mb-2">
                            @if($editMode)
                                <button type="submit" class="btn btn-primary text-white" style="float: right;">Update</button>
                            @else
                                <button type="submit" class="btn btn-primary text-white" style="float: right;">Save</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
