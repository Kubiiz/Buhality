@extends('layouts.app')

@section('content')
    <form class="form-horizontal st" role="form" method="POST" action="{{ route('game.update', $data->id) }}">
        {{ csrf_field() }}

        <div class="form-group head">
            <i class="fa fa-pencil fa-lg"></i>&nbsp; {{ __("Edit game") }} - <i>{{ $data->title }}</i>
            <a href="{{ url('/games') }}" class="btn btn-sm btn-primary pull-right"><i class="fa fa-history"></i> {{ __("Back") }}</a>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @else
            <div class="alert alert-info">
                {{ __("Editing some participant you will delete their stats!") }}
            </div>
        @endif

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label class="col-sm-3">{{ __("Title") }}</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="title" value="{{ old('title', $data->title) }}">
                @if ($errors->has('title'))
                    <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group player_list">
            <label class="col-sm-3">{{ __("Participants") }}</label>
            <div class="col-sm-9">
                <span class="label label-success pull-left add" onclick='player("{{ __("Remove") }}")'>{{ __('Add') }}</span> <small class="pull-right">{!! __("Count of participants from <b>2</b> to <b>10</b>") !!}</small>

                @if ($errors->has('player'))
                    <div class="clearfix"></div>
                    <span class="text-danger">
                        <strong>{{ $errors->first('player') }}</strong>
                    </span>
                @endif

                @foreach (old('player', $players) as $key => $value)
                    @php
                        $newvalue = is_object($value) ? $value->name : $value;
                    @endphp
                    <div class="{{ $errors->has('player.'.$key) ? 'has-error' : '' }}">
                        <div class="input_player">
                            <input value="{{ old('player.'.$key, $newvalue) }}" type="text" class="form-control" name="player[]">
                            <span class="label label-danger pull-right" onclick="player_remove(this);">{{ __('Remove') }}</span>
                        </div>

                         @if ($errors->has('player.'.$key))
                            <span class="help-block">
                                <strong>{{ $errors->first('player.'.$key) }}</strong>
                            </span>
                        @endif
                    </div>
                @endforeach

                <div id="show_players"></div>
            </div>
        </div>
        <div class="form-group{{ $errors->has('count') ? ' has-error' : '' }}">
            <label class="col-sm-3">{{ __('Count') }}</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="count" min="5" max="15" value="{{ old('count', $data->count) }}">
                <small>{!! __('How long to count? From <b>5</b> to <b>15</b>') !!}</small>

                @if ($errors->has('count'))
                    <span class="help-block">
                        <strong>{{ $errors->first('count') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('bomb') ? ' has-error' : '' }}">
            <label class="col-sm-3">{{ __('Bomb') }}</label>
            <div class="col-md-9">
                <div class="checkbox">
                    <label><input type="checkbox" name="bomb" value="1" {{ old('bomb', $data->bomb) ? 'checked' : '' }}></label>
					<span class="newbomba"><small>{!! __('When the <i><strong>Bomb</strong></i> drops, everyone will have to drink') !!}</small></span>
                </div>

                @if ($errors->has('bomb'))
                    <span class="help-block">
                        <strong>{{ $errors->first('bomb') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" name="st" class="btn btn-success"><i class="fa fa-check"></i> {{ __('Edit') }}</button>
            </div>
        </div>
    </form>
@endsection
