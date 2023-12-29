<div>
    <div class="row">
        <div class="col-lg-12">
            @if (session()->has('already_exist'))
                @include('partial.alert')

            @elseif (session()->has('success'))
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
                            <div class="col-6">{{ $editMode == true ? 'Update Permissions assigned to role' : 'Assign Permissions to role' }}</div>
                            <div class="col-6">
                                <a href="{{ route('admin.permissions.roles') }}" class="btn btn-primary btn-sm text-white" style="float: right;">Back</i></a>
                            </div>
                        </div>
                    </h4>

                    <form class="forms-sample" wire:submit.prevent="savePermissionsRole">
                        <div class="form-group">
                            <label for="role_id">Role</label>
                            <select wire:model="role_id" class="form-control form-control-sm text-dark" id="role_id">
                                <option value="" class="fw-bold">Select Role</option>
                                @foreach ($roles as $role)
                                
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
        
                                @endforeach
                            </select>
                            @error('role_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                   
                        <div class="form-group">
                            <div class="row mb-2">
                                <div class="col-md-8">
                                    <label for="permissions">Select Permission</label>
                                </div>
                                <div class="col-4 border pt-2 border-primary">
                                    <input class="form-check-input" type="checkbox" wire:model="all_permissions" wire:click="{{ $allPermissions == true ? 'selectAllPermissions' : 'deselectAllPermissions' }}" value="all-permissions" id="all-permissions">
                                    <label class="form-check-label text-secondary" wire:click="{{ $allPermissions == true ? 'selectAllPermissions' : 'deselectAllPermissions' }}" for="all-permissions">
                                        All Permissions
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($permissionGroups as $groupKey => $permissionGroups)
                                <div class="col-12 mb-2">
                                    <div class="row">
                                        <div class="col-12">
                                            {{--  <input class="form-check-input" type="checkbox" wire:model="selectedPermissionIds" value="{{ $permissionGroups->id }}" id="permissionGroup.{{$groupKey}}">  --}}
                                            <label class="form-check-label text-secondary fw-bold" for="permissionGroup.{{$groupKey}}">
                                                {{ ucfirst($permissionGroups->group_name) }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                    @foreach ($permissions as $key => $permission)
                                        @if ($permission->group_name == $permissionGroups->group_name)
                                            <div class="col-4 px-4">
                                                <input class="form-check-input" type="checkbox" wire:model="selectedPermissionIds" value="{{ $permission->id }}" id="permission.{{$key}}">
                                                <label class="form-check-label text-secondary" for="permission.{{$key}}">
                                                    {{ ucfirst($permission->name) }}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                    </div>

                                </div>
                                @endforeach
        
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
