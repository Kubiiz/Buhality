@extends('layouts.app')

@section('content')
    <form class="form-horizontal st" role="form" method="POST" action="{{ url("/game/$data->id/edit") }}">
        {{ csrf_field() }}

        <div class="form-group head">
            <i class="fa fa-pencil fa-lg"></i>&nbsp; Labot spēli - <i>{{ $data->title }}</i>
            <a href="{{ url('/games') }}" class="btn btn-sm btn-primary pull-right"><i class="fa fa-history"></i> Atpakaļ</a>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label class="col-sm-3">Nosaukums</label>
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
            <label class="col-sm-3">Dalībnieki</label>
            <div class="col-sm-9">
                <span class="label label-success pull-left add" onclick="player();">Pievienot</span> <small class="pull-right">Dalībnieku skaits no <b>2</b> līdz <b>10</b></small>

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
                            <span class="label label-danger pull-right" onclick="player_remove(this);">Noņemt</span>
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
            <label class="col-sm-3">Skaits</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="count" min="5" max="15" value="{{ old('count', $data->count) }}">
                <small>Līdz cik skaitam? No 5 līdz 15</small>

                @if ($errors->has('count'))
                    <span class="help-block">
                        <strong>{{ $errors->first('count') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('bomb') ? ' has-error' : '' }}">
            <label class="col-sm-3">Bomba</label>
            <div class="col-md-9">
                <div class="checkbox">
                    <label><input type="checkbox" name="bomb" value="1" {{ old('bomb', $data->bomb) ? 'checked' : '' }}></label>
					<span class="newbomba"><small>Izkrītot "<i><strong>Bomba</strong></i>", būs jādzer visiem</small></span>
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
                <button type="submit" name="st" class="btn btn-success"><i class="fa fa-check"></i> Labot</button>
            </div>
        </div>
    </form>
@endsection
