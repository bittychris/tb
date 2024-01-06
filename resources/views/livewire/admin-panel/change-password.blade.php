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
                    <div class="row justify-content-between align-items-center">
                      <div class="col-6">Change Password</div>
                      <div class="col-6">
                          <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm text-white" style="float: right;">Back to Dashboard</a>
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
                          <input type="password" wire:model="newPassword" class="form-control form-control-sm" id="new_password" placeholder="Enter New password">
                          <span class="input-group-text">
                              <i class="mdi mdi-eye" onclick="newPassword()" id="togglePassword"
                              style="cursor: pointer"></i>
                          </span>
                      </div>
                      @error('new_password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                      <div class="input-group mb-3">
                          <input type="password" wire:model="confirmPassword" class="form-control form-control-sm" id="confirm_password" placeholder="Retype new password">
                          <span class="input-group-text">
                              <i class="mdi mdi-eye" onclick="confirmPassword()" id="togglePassword"
                              style="cursor: pointer"></i>
                          </span>
                      </div>
                      @error('confirm_password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mt-3">
                      <button type="submit" wire:loading.remove wire:target="changePassword" wire:loading.attr="disabled" class="btn w-100 btn-primary btn-sm text-white font-weight-medium auth-form-btn">Save</button>
                      <button type="button" wire:loading wire:target="changePassword" wire:loading.attr="disabled" class="btn w-100 btn-primary btn-sm text-white font-weight-medium auth-form-btn">Saving...</button>
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

