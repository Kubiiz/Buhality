@extends('layouts.app')

@section('content')
    <div class="form-horizontal form">
        <h4 class="form-group head history text-center">
            <i class="fa fa-history fa-lg"></i>&nbsp; {{ __("My games") }}
        </h4>
        <div class="form-group text-right stats">
            <i class="fa fa-trophy"></i> {{ __("Total") }} <span class="text-primary">{{ $data->count() }}</span> spēles<br>
            <i class="fa fa-glass"></i> {!! __("<span class='text-primary'>:shots</span> shots consumed", ['shots'=> $shots]) !!}
        </div>
        <div class="clear"></div>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

        @if (!empty($active))
            <div class="panel panel-info">
                <div class="panel-heading" role="tab" id="heading_open">
                    <h4 class="panel-title">
                        <a class="collapsed title" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_open" aria-expanded="false" aria-controls="collapse_open">
                            <i class="fa fa-chevron-right"></i> {{ $active->title }}
                        </a>
                        <div>
                            <a href="{{ route('game.index') }}" class="label label-success"><i class="fa fa-play"></i> {{ __("Continue") }}</a>
                            <a href="{{ route('game.edit', $active->id) }}" class="label label-warning"><i class="fa fa-pencil"></i> {{ __("Edit") }}</a>
                            <a href="{{ route('game.stop') }}" onclick='return confirm("{{ __("Are you sure you want to end this game?") }}")' class="label label-danger"><i class="fa fa-stop"></i>&nbsp; {{ __("End") }}</a>
                        </div>
                    </h4>
                </div>
                <div id="collapse_open" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_open">
                    <div class="panel-body">
						<div class="pull-left">
                        @foreach($active->player as $player)
                            {{ $player->name }} - <span class="text-primary">{{ $player->shots }}</span> {{ __("shots") }}<br>
                        @endforeach
						</div>
						<div class="pull-right">
							<i><i class="fa fa-glass"></i> {!! __("<span class='text-primary'>:shots</span> shots consumed", ['shots'=> $active->player()->sum('shots')]) !!}</i>
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
                            <a class="collapsed title" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $game->id }}" aria-expanded="false" aria-controls="collapse{{ $game->id }}">
                                <i class="fa fa-chevron-right"></i> {{ $game->title }}
                            </a>
                            <div class="pull-right right">
                            @if (empty($active))
                                <a href="{{ route('game.continue', $game->id) }}" class="label label-success"><i class="fa fa-play"></i> {{ __("Continue") }}</a>
                            @endif
                            <a href="{{ route('game.edit', $game->id) }}" class="label label-warning"><i class="fa fa-pencil"></i> {{ __("Edit") }}</a>
                            <a href="{{ route('game.destroy', $game->id) }}" onclick='return confirm("{{ __("Are you sure you want to delete this game?") }}")' class="label label-default">
                                <i class="fa fa-times"></i> {{ __("Delete") }}
                            </a>
                            </div>
                        </h4>
                    </div>
                    <div id="collapse{{ $game->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $game->id }}">
                        <div class="panel-body">
							<div class="pull-left">
                            @foreach($game->player as $player)
                                {{ $player->name }} - <span class="text-primary">{{ $player->shots }}</span> {{ __("shots") }}<br>
                            @endforeach
							</div>
							<div class="pull-right">
								<div>
									<i class="fa fa-clock-o"></i> {{ $game->created_at }}
								</div>
								<div>
									<i class="pull-right"><i class="fa fa-glass"></i> {!! __("<span class='text-primary'>:shots</span> shots consumed", ['shots'=> $game->player()->sum('shots')]) !!}</i>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
        <div class="alert alert-info">
            {{ __('You haven`t played any games.') }}
        </div>
        @endif
        </div>
    </div>
@endsection
