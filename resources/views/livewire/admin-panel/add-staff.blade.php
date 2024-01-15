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
                            <div class="col-6">{{ $editMode == true ? 'Edit Staff details' : 'Add Staff' }}</div>
                            <div class="col-6">
                                <a href="{{ route('admin.staffs') }}" class="btn btn-primary btn-sm text-white" style="float: right;">Back</i></a>
                            </div>
                        </div>
                    </h4>

                    <form class="forms-sample" wire:submit.prevent="saveStaff">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First ame</label>
                                    <input type="text" wire:model="first_name" class="form-control form-control-sm" id="first_name" placeholder="Enter First name">
                                    @error('first_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last name</label>
                                    <input type="text" wire:model="last_name" class="form-control form-control-sm" id="last_name" placeholder="Enter Last name">
                                    @error('last_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" wire:model="email" class="form-control form-control-sm" id="email" placeholder="Enter Email">
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone contact</label>
                                    <input type="text" wire:model="phone" class="form-control form-control-sm" id="phone" placeholder="Enter Phone contact">
                                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="region_id">Region</label>
                                    <select wire:model="region_id" class="form-control form-control-sm text-dark" id="region_id">
                                        <option value="" class="fw-bold">Select Position</option>
                                        @foreach ($regions as $region)
                                        
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                
                                        @endforeach
                                    </select>
                                    @error('region_id') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role_id">Position</label>
                                    <select wire:model="role_id" class="form-control form-control-sm text-dark" id="role_id">
                                        <option value="" class="fw-bold">Select Region</option>
                                        @foreach ($roles as $role)
                                        
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                
                                        @endforeach
                                    </select>
                                    @error('role_id') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>                        
                        <div class="mt-3 mb-2">
                            @if($editMode)
                                <button type="submit" class="btn btn-success text-white" style="float: right;">Update</button>
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
