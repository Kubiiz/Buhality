@extends('layouts.app')

@section('content')
    <form class="form-horizontal st" role="form" method="POST" action="{{ route('newgame.store') }}">
        {{ csrf_field() }}

        <div class="form-group head">
            <i class="fa fa-plus fa-lg"></i>&nbsp; {{ __('Add new game') }}
        </div>
        @if($active)
            <div class="form-group">
                <div class="alert alert-info">
                    {{ __('You have started the game!') }}
                    <div class="pull-right warning">
                        <a href="{{ route('game.index') }}" class="btn btn-sm btn-success"><i class="fa fa-play"></i> {{ __("Continue") }}</a>
                        <a href="{{ route('game.edit', $active->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> {{ __("Edit") }}</a>
                        <a href="{{ route('game.stop') }}" onclick='return confirm("{{ __("Are you sure you want to end this game?") }}")' class="btn btn-sm btn-danger"><i class="fa fa-stop"></i>&nbsp; {{ __("End") }}</a>
                    </div>
                </div>
            </div>
        @endif

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label class="col-sm-3">{{ __("Title") }}</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                <small>{!! __("For example - <i>'Friday party'</i>") !!}</small>

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

                @if (old('player'))
                    @foreach (old('player') as $key => $value)
                        <div class="{{ $errors->has('player.'.$key) ? 'has-error' : '' }}">
                            <div class="input_player">
                                <input value="{{ $value }}" type="text" class="form-control" name="player[]">
                                <span class="label label-danger pull-right" onclick="player_remove(this);">{{ __('Remove') }}</span>
                            </div>

                            @if ($errors->has('player.'.$key))
                                <span class="help-block">
                                    <strong>{{ $errors->first('player.'.$key) }}</strong>
                                </span>
                            @endif
                        </div>
                    @endforeach
                @endif

                <div id="show_players"></div>
            </div>
        </div>
        <div class="form-group{{ $errors->has('count') ? ' has-error' : '' }}">
            <label class="col-sm-3">{{ __('Count') }}</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="count" min="5" max="15" value="{{ old('count') }}">
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
                    <label><input type="checkbox" name="bomb" value="1" {{ old('bomb') ? 'checked' : '' }}></label>
                    <span class="newbomba">{!! __('When the <i><strong>Bomb</strong></i> drops, everyone will have to drink') !!}</span>
                    @if ($errors->has('bomb'))
                        <span class="help-block">
                            <strong>{{ $errors->first('bomb') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" name="st" class="btn btn-primary"><i class="fa fa-check"></i> {{ __('Done') }}</button>
            </div>
        </div>
    </form>
@endsection
