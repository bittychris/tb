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
                    Change Password
                  </div>
                  <form wire:submit.prevent="changePassword">
                    @csrf
                    <div class="form-group">
                      <label for="current_password">Current password</label>
                      <input type="password" wire:model="current_password" class="form-control form-control-sm" id="current_password" placeholder="Enter current password">
                      @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                      <label for="new_password">New password</label>
                      <input type="password" wire:model="new_password" class="form-control form-control-sm" id="new_password" placeholder="Enter New password">
                      @error('new_password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                      <input type="password" wire:model="confirm_password" class="form-control form-control-sm" id="confirm_password" placeholder="Retype new password">
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
