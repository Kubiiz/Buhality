@extends('layouts.admin')

@section('admin_content')
    <h4>
        <i class="fa fa-pencil"></i> {{ __('Edit section') }} (<i>{{ $info->title }}</i>)
        <a href="{{ route('admin.info') }}" class="btn btn-sm pull-right btn-primary"><i
                class="fa fa-history"></i>{{ __('Back') }}</a>
    </h4>
    <br />
    <form method="POST" action="{{ route('admin.info.update', $info->id) }}">
        @method('patch')
        @csrf
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label class="col-sm-3">{{ __('Title') }}</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="title" value="{{ old('title', $info->title) }}">

                @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('icon') ? ' has-error' : '' }}">
            <label class="col-sm-3">{{ __('Icon') }}</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="icon" value="{{ old('icon', $info->icon) }}">
                <small>{!! __("'Font Awesome' icons are used. Example: <b>fa fa-*</b>") !!}</small>

                @if ($errors->has('icon'))
                    <span class="help-block">
                        <strong>{{ $errors->first('icon') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
            <label class="col-sm-3">{{ __('Language') }}</label>
            <div class="col-sm-9">
                <select class="form-control" name="language">
                    <option disabled selected>{{ __('Choose a language') }}</option>
                    <option {{ old('language', $info->language) == 'lv' ? 'selected' : '' }} value="lv">Latviešu
                    </option>
                    <option {{ old('language', $info->language) == 'en' ? 'selected' : '' }} value="en">English
                    </option>
                </select>
                @if ($errors->has('language'))
                    <span class="help-block">
                        <strong>{{ $errors->first('language') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('visible') ? ' has-error' : '' }}">
            <label class="col-sm-3">{{ __('Public') }}</label>
            <div class="col-md-9">
                <div>
                    <label><input type="checkbox" style="margin-top:-10px" name="visible" value="1"
                            {{ old('visible', $info->visible) ? 'checked' : '' }}></label>
                    <small>{{ __("The section will be displayed in the 'Information' section") }}</small>

                    @if ($errors->has('visible'))
                        <span class="help-blockr">
                            <strong>{{ $errors->first('visible') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
            <label class="col-sm-3">{{ __('Content') }}</label>
            <div class="clearfix"></div>

            @if ($errors->has('content'))
                <span class="help-block">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
            @endif
            <div class="clearfix"></div>
            <textarea id="editor" name="content">{{ old('content', $info->content) }}</textarea>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-pencil"></i>
                    {{ __('Edit') }}</button>
            </div>
        </div>
    </form>
@endsection
