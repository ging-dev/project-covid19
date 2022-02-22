<div class="card">
    <div class="card-header">
        <h4 class="card-title">
            <i class="fas fa-heartbeat"></i>
            {{ __('Health Declaration') }}
        </h4>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="submit">
            @error('general') <div class="alert alert-danger" role="alert">{{ $message }}</div> @enderror
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-9">
                        <label for="fullname">{{ __('Full name') }}</label>
                        <input id="fullname" class="form-control @error('fullname') is-invalid @enderror" type="text" wire:model.lazy="fullname">
                        @error('fullname') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-sm-3">
                        <label for="birthday">{{ __('Birthday') }}</label>
                        <input class="form-control @error('birthday') is-invalid @enderror" type="date" wire:model.lazy="birthday">
                        @error('birthday') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-9">
                        <label for="gender">{{ __('Personal phone number') }}</label>
                        <input class="form-control @error('personalPhoneNumber') is-invalid @enderror" type="text" wire:model.lazy="personalPhoneNumber">
                        @error('personalPhoneNumber') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-sm-3">
                        <label for="gender">{{ __('Gender') }}</label>
                        <select id="gender" class="custom-select" wire:model.lazy="genderId">
                            <option value="0" selected>Female</option>
                            <option value="1">Male</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Not needed for now
            <div class="form-group">
                <label for="gender">{{ __('Identification') }}</label>
                <input class="form-control @error('identification') is-invalid @enderror" type="text" wire:model="identification">
                @error('identification') <span class="error invalid-feedback">{{ $message }}</span> @enderror
            </div> -->

            @if ($withOTP)
                <div class="form-group">
                    <label for="gender">{{ __('OTP') }}</label>
                    <input class="form-control @error('otp') is-invalid @enderror" type="text" wire:model.lazy="otp">
                    @error('otp') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                </div>
            @endif
            <button class="btn btn-primary" type="submit">{{ __('Submit') }}</button>
        </form>
    </div>
</div>
