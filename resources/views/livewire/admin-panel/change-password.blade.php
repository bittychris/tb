<div>
    <div class="row">
        <div class="col-lg-12">
            
        </div>
    </div>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
              <div class="col-lg-4 mx-auto">
                @if (session()->has('warning'))
                    @include('partial.alert')

                @elseif (session()->has('error'))
                    @include('partial.alert')

                @endif
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                  <div class="brand-logo fw-bold">
                    <div class="row mb-4 mt-0">
                      <div class="col-12">
                        <center>
                          <a href="{{ route('admin.dashboard') }}">
                            <img src="{{ asset('admin/images/amref logo.png') }}" alt="amref logo" style="object-fit: ; width: 120px !important; height: 65px !important;"/>
                          </a>
                        </center>
                      </div>
                    </div>
                    <div class="row justify-content-between align-items-center">
                      <div class="col-6">Change Password</div>
                      <div class="col-6">
                        <span class="mt-2" style="float: right; font-size: 15px; font-weight: 400;"><span class="text-danger"><-</span>
                          <a href="{{ route('admin.dashboard') }}" class="text-danger"><small>Dashboard</small></a>
                        </span>
                          {{-- <a href="{{ route('admin.dashboard') }}" class="text-danger" style="float: right; font-size: 15px; font-weight: 400;"><small>Dashboard</small></a> --}}
                      </div>
                  </div>
                  </div>
                  <form wire:submit.prevent="changePassword">
                    @csrf
                    <div class="form-group">
                      <label for="current_password">Current password</label>
                      <div class="input-group mb-3">
                          <input type="password" wire:model="current_password" class="form-control form-control-sm" id="current_password" placeholder="Enter current password">
                          <span class="input-group-text">
                              <i class="mdi mdi-eye" onclick="currentPassword()" id="togglePassword"
                              style="cursor: pointer"></i>
                          </span>
                      </div>
                      @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                      <label for="new_password">New password</label>
                      <div class="input-group mb-3">
                          <input type="password" wire:model="new_password" class="form-control form-control-sm" id="new_password" placeholder="Enter New password">
                          <span class="input-group-text">
                              <i class="mdi mdi-eye" onclick="newPassword()" id="togglePassword"
                              style="cursor: pointer"></i>
                          </span>
                      </div>
                      @error('new_password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                      <div class="input-group mb-4">
                          <input type="password" wire:model="confirm_password" class="form-control form-control-sm" id="confirm_password" placeholder="Retype new password">
                          <span class="input-group-text">
                              <i class="mdi mdi-eye" onclick="confirmPassword()" id="togglePassword"
                              style="cursor: pointer"></i>
                          </span>
                      </div>
                      @error('confirm_password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mt-3">
                      <button type="submit" wire:loading.remove wire:target="changePassword" wire:loading.attr="disabled" class="btn w-100 btn-danger btn-sm text-white font-weight-medium auth-form-btn">Save</button>
                      <button type="button" wire:loading wire:target="changePassword" wire:loading.attr="disabled" class="btn w-100 btn-danger btn-sm text-white font-weight-medium auth-form-btn">Saving...</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>
</div>

