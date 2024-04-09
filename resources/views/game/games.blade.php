@extends('layouts.app')

@section('content')
    <div class="form-horizontal st">
        <div class="form-group head history">
            <i class="fa fa-history fa-lg"></i>&nbsp; Manas spēles
        </div>
        <div class="form-group stats">
            <i class="fa fa-trophy"></i> Kopā <span class="text-primary">{{ $data->count() }}</span> spēles<br>
            <i class="fa fa-glass"></i> Izdzerti <span class="text-primary">{{ $shots }}</span> šoti
        </div>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

        @if (!empty($active))
            <div class="panel panel-info">
                <div class="panel-heading" role="tab" id="heading_open">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_open" aria-expanded="false" aria-controls="collapse_open">
                            <i class="fa fa-chevron-right"></i> {{ $active->title }}
                        </a>
                        <div class="pull-right right">
                            <a href="{{ url('/game') }}" class="label label-success"><i class="fa fa-play"></i> Turpināt</a>
                            <a href="{{ url('/game/' . $active->id . '/edit') }}" class="label label-warning"><i class="fa fa-pencil"></i> Labot</a>
                            <a href="{{ url('/game/stop') }}" onclick="if( confirm( 'Beigt spēli?' ) ) {return true;}else{return false;}" class="label label-danger"><i class="fa fa-stop"></i>&nbsp; Beigt</a>
                        </div>
                    </h4>
                </div>
                <div id="collapse_open" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_open">
                    <div class="panel-body">
						<div class="pull-left">
                        @foreach($active->player as $player)
                            {{ $player->name }} - <span class="text-primary">{{ $player->shots }}</span> šoti<br>
                        @endforeach
						</div>
						<div class="pull-right">
							<i><i class="fa fa-glass"></i> Izdzerti <span class="text-primary">{{ $active->player()->sum('shots') }}</span> šoti</i>
						</div>
                    </div>
                </div>
            </div>
            <br>
        @endif
        @if (session('deleted'))
            <div class="alert alert-success">
                {{ session('deleted') }}
            </div>
        @endif
        @if (count($games) > 0)
            @foreach($games as $game)
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading{{ $game->id }}">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $game->id }}" aria-expanded="false" aria-controls="collapse{{ $game->id }}">
                                <i class="fa fa-chevron-right"></i> {{ $game->title }}
                            </a>
                            <div class="pull-right right">
                            @if (empty($active))
                                <a href="{{ url('/game/' . $game->id . '/continue') }}" class="label label-success"><i class="fa fa-play"></i> Turpināt</a>
                            @endif
                            <a href="{{ url('/game/' . $game->id . '/edit') }}" class="label label-warning"><i class="fa fa-pencil"></i> Labot</a>
                            <a href="{{ url('/game/' . $game->id . '/delete') }}" onclick="if( confirm( 'Dzēst spēli?' ) ) {return true;}else{return false;}" class="label label-default">
                                <i class="fa fa-times"></i> Dzēst
                            </a>
                            </div>
                        </h4>
                    </div>
                    <div id="collapse{{ $game->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $game->id }}">
                        <div class="panel-body">
							<div class="pull-left">
                            @foreach($game->player as $player)
                                {{ $player->name }} - <span class="text-primary">{{ $player->shots }}</span> šoti<br>
                            @endforeach
							</div>
							<div class="pull-right right">
								<div>
									<i class="fa fa-clock-o"></i>
									<div class="date">{{ $game->created_at }}</div>
								</div>
								<div>
									<i><i class="fa fa-glass"></i> Izdzerti <span class="text-primary">{{ $game->player()->sum('shots') }}</span> šoti</i>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <br>
            <div class="alert alert-warning">Tu neesi izspēlējis nevienu spēli!</div>
        @endif
        </div>
    </div>
@endsection
