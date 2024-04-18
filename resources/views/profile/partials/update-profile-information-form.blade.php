<section>
     <p class="alert alert-info">
        {{ __("You can update your profile information.") }}
     </p>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        @if (session('profile.updated'))
            <div class="alert alert-success">
                {{ session('profile.updated') }}
            </div>
        @endif

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="col-sm-3">{{ __('Name') }}</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @if ($errors->has('name'))
                    <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">
            <label class="col-sm-3">{{ __('Birth date') }}</label>
            <div class="col-sm-9">
                <input type="date" class="form-control" name="birth_date" value="{{ old('birth_date', $date) }}" required autofocus autocomplete="birth_date">
                @if ($errors->has('birth_date'))
                    <span class="help-block">
                    <strong>{{ $errors->first('birth_date') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="col-sm-3">{{ __('Email') }}</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="email" value="{{ old('email', $user->email) }}" required autofocus autocomplete="email">
                @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
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
