@extends('layouts.app')

@section('content')
    <form class="form-horizontal st" role="form" method="POST" action="{{ url('/new-game') }}">
        {{ csrf_field() }}

        <div class="form-group head">
            <i class="fa fa-plus fa-lg"></i>&nbsp; Jauna spēle
        </div>
        @if($active)
            <div class="form-group">
                <div class="alert alert-info">
                    Tev ir iesākta spēle!
                    <div class="pull-right warning">
                        <a href="{{ url('/game') }}" class="btn btn-sm btn-success"><i class="fa fa-play"></i> Turpināt</a>
                        <a href="{{ url('/game/' . $active->id . '/edit') }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Labot</a>
                        <a href="{{ url('/game/stop') }}" onclick="if( confirm( 'Beigt spēli?' ) ) {return true;}else{return false;}" class="btn btn-sm btn-danger"><i class="fa fa-stop"></i>&nbsp; Beigt</a>
                    </div>
                </div>
            </div>
        @endif

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label class="col-sm-3">Nosaukums</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                <small>Piemēram - <i>"Piektdienas ballīte"</i></small>

                @if ($errors->has('title'))
                    <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3">Dalībnieki</label>
            <div class="col-sm-9">
                <span class="label label-success pull-left add" onclick="javascript:add_member();">Pievienot</span> <small class="pull-right">Maksimālais dalībnieku skaits <b>10</b></small>

                @if ($errors->has('d'))
                    <div class="clearfix"></div>
                    <span class="text-danger">
                        <strong>Pievieno vismaz 2 spēlētājus</strong>
                    </span>
                @endif

                @if (old('d'))
                    @foreach (old('d') as $key => $d)
                        <div id="d_{{ $key }}" class="{{ $errors->has('d'.$key) ? 'has-error' : 'll' }}">
                            <div class="m"><input value="{{ $d }}" type="text" class="form-control" name="d[]"><span class="label label-danger pull-right" onclick="javascript:remove_member({{ $key }});">Noņemt</span></div>

                            @if ($errors->has('d'.$key))
                                <span class="help-block">
                                    <strong>{{ $errors->first('d'.$key) }}</strong>
                                </span>
                            @endif
                        </div>
                    @endforeach
                @endif

                <div id="show_members"></div>
            </div>
        </div>
        <div class="form-group{{ $errors->has('n') ? ' has-error' : '' }}">
            <label class="col-sm-3">Skaits</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="n" min="3" max="15" value="{{ old('n') }}">
                <small>Līdz cik skaitam? No 3 līdz 15</small>

                @if ($errors->has('n'))
                    <span class="help-block">
                    <strong>{{ $errors->first('n') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3">Bomba</label>
            <div class="col-md-9">
                <div class="checkbox">
                    <label><input type="checkbox" name="bomba" value="1" {{ old('bomba') ? 'checked' : '' }}></label>
					<span class="newbomba"><small>Izkrītot "<i><strong>Bomba</strong></i>", būs jādzer visiem</small></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" name="st" class="btn btn-primary"><i class="fa fa-check"></i> Gatavs</button>
            </div>
        </div>
    </form>
@endsection
