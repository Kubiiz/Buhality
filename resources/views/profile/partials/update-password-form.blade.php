<section>
     <p class="alert alert-info">
        {{ __('Password change. Protect your profile with a secure password!') }}
    </p>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        @if (session('password-updated'))
            <div class="alert alert-success">
                {{ session('password-updated') }}
            </div>
        @endif

        <div class="form-group{{ $errors->updatePassword->get('current_password') ? ' has-error' : '' }}">
            <label class="col-sm-3">{{ __('Current password') }}</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" name="current_password" required autofocus autocomplete="current-password">
                @if ($errors->updatePassword->get('current_password'))
                    <span class="help-block">
                    <strong>{{ $errors->updatePassword->get('current_password')[0] }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->updatePassword->get('password') ? ' has-error' : '' }}">
            <label class="col-sm-3">{{ __('New password') }}</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" name="password" required autofocus autocomplete="new-password">
                @if ($errors->updatePassword->get('password'))
                    <span class="help-block">
                    <strong>{{ $errors->updatePassword->get('password')[0] }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->updatePassword->get('password_confirmation') ? ' has-error' : '' }}">
            <label class="col-sm-3">{{ __('New password x2') }}</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" name="password_confirmation" required autofocus autocomplete="new-password">
                @if ($errors->updatePassword->get('password_confirmation'))
                    <span class="help-block">
                    <strong>{{ $errors->updatePassword->get('password_confirmation')[0] }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> {{ __('Save') }}</button>
            </div>
        </div>
    </form>
</section>
