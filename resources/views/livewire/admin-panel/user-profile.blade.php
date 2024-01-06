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
                        <div class="form-group">
                            <center>
                                <img wire:ignore.self id="showImage" src="{{ !empty($userDetails->image) ? asset('storage/user_images/'.$userDetails->image) : asset('admin/images/faces/user_logo.jpg') }}" class="rounded border-primary border-secondary border rounded-circle img" width="150px" height="150px" style="object-fit: cover;" align="center" alt="profile image" />
                            </center>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p>Full Name: <span class="mx-4 text-secondary">{{ $userDetails->first_name }} {{ $userDetails->last_name }}</span></spa>
                    </div>

                    <div class="col-md-12">
                        <p>Email: <span class="mx-4 text-secondary">{{ $userDetails->email }}</span></p>
                    </div>

                    <div class="col-md-12">
                        <p>Contact number: <span class="mx-4 text-secondary">{{ $userDetails->phone }}</span></p>
                    </div>

                    <div class="col-md-12 mb-3">
                        <p>Region: <span class="mx-4 text-secondary">{{ empty($userDetails->region->name) ? '' : $userDetails->region->name }}</span></p>
                    </div>

                    <div class="form-group">
                        <p>Position: <span class="badge bg-success rounded mx-4">{{ $userDetails->role->name }}</span></p>
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

                    <form class="forms-sample" wire:submit.prevent="saveUserDetails" wire:ignore.self>
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
                                    <input type="file" accept="image/*"  {{ $editMode == true ? '' : 'disabled' }} wire:model.live="image" class="form-control form-control-sm" id="image" />
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

@push('js')
    
    {{-- js to show selected image in real time --}}
    <script type="text/javascript">

        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }

                reader.readAsDataURL(e.target.files['0']);
            });
        });

    </script>

@endpush