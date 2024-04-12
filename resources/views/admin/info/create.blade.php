@extends('layouts.admin')

@section('admin_content')
    <h4><i class="fa fa-plus"></i> Pievienot sadaļu</h4>
    <br />
    <form method="POST" action="{{ route('admin.info.create') }}">
        @csrf
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label class="col-sm-3">Nosaukums</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="title" value="{{ old('title') }}">

                @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('icon') ? ' has-error' : '' }}">
            <label class="col-sm-3">Ikona</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="icon" value="{{ old('icon') }}">
                <small>Tiek izmantotas "Font Awesome" ikonas. Piemērs: <b>fa fa-*</b></small>

                @if ($errors->has('icon'))
                    <span class="help-block">
                        <strong>{{ $errors->first('icon') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('visible') ? ' has-error' : '' }}">
            <label class="col-sm-3">Publiski redzams</label>
            <div class="col-md-9">
                <div class="checkbox">
                    <label><input type="checkbox" style="margin-top:-10px" name="visible" value="1" {{ old('visible') ? 'checked' : '' }}></label>

                    @if ($errors->has('visible'))
                        <span class="help-blockr">
                            <strong>{{ $errors->first('visible') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
            <label class="col-sm-3">Saturs</label>
            <div class="clearfix"></div>

            @if ($errors->has('content'))
                <span class="help-block">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
            @endif
            <div class="clearfix"></div>
            <textarea id="editor" name="content">{{ old('content') }}</textarea>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" name="st" class="btn btn-success"><i class="fa fa-check"></i> Pievienot</button>
            </div>
        </div>
    </form>
@endsection
