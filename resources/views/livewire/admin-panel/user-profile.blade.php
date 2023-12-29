<div>
    <div class="row">
        <div class="col-lg-12">
            @if (session()->has('already_exist'))
                @include('partial.alert')

            @elseif (session()->has('success'))
                @include('partial.alert')

            @elseif (session()->has('error'))
                @include('partial.alert')

            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5 col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-6">My Profile</div>
                            <div class="col-6">
                                <button type="button" wire:click="{{ $editMode == true ? 'clearForm' : 'prepareData' }}" class="btn btn-{{ $editMode == true ? 'warning' : 'primary' }} btn-sm text-{{ $editMode == true ? 'dark' : 'white' }}" style="float: right;">{{ $editMode == true ? 'Cancel' : 'Edit' }}</button>
                            </div>
                        </div>
                    </h4>

                    <div class="col-md-12">
                        {{--  <div class="row"></div>  --}}
                        <div class="form-group">
                            <center>
                                <img src="{{ asset('admin/images/faces/user_logo.jpg') }}" class="rounded border-primary" width="150px" alt="profile image" />
                            </center>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="first_name">Full Name: <span class="mx-3 text-secondary">{{ $userDetails->first_name }} {{ $userDetails->last_name }}</span></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="last_name">Email: <span class="mx-3 text-secondary">{{ $userDetails->email }}</span></label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="last_name">Contact number: <span class="mx-3 text-secondary">{{ $userDetails->phone }}</span></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Position: <span class="badge bg-success rounded mx-3">{{ $userDetails->role->name }}</span></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 col-md-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-6">Edit Profile Details</div>
                        </div>
                    </h4>

                    <form class="forms-sample" wire:submit.prevent="saveUserDetails">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First name</label>
                                    <input type="text"  {{ $editMode == true ? '' : 'disabled' }} wire:model="first_name" class="form-control form-control-sm" id="first_name" placeholder="Enter First name">
                                    @error('first_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last name</label>
                                    <input type="text"  {{ $editMode == true ? '' : 'disabled' }} wire:model="last_name" class="form-control form-control-sm" id="last_name" placeholder="Enter Last name">
                                    @error('last_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email"  {{ $editMode == true ? '' : 'disabled' }} wire:model="email" class="form-control form-control-sm" id="email" placeholder="Enter Email">
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Contact number</label>
                                    <input type="phone"  {{ $editMode == true ? '' : 'disabled' }} wire:model="phone" class="form-control form-control-sm" id="phone" placeholder="Enter phone number">
                                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Profile image</label>
                                    <input type="file" accept="image/*"  {{ $editMode == true ? '' : 'disabled' }} wire:model="image" class="form-control form-control-sm" id="image" />
                                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-3 mb-2">
                            <button type="submit"  {{ $editMode == true ? '' : 'disabled' }} wire:loading.remove wire:target="saveUserDatails" class="btn btn-success text-white" style="float: right;">Update</button>
                            <button type="button" wire:loading wire:target="saveUserDatails" class="btn btn-success text-white" style="float: right;" disabled="disabled">Updating...</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
