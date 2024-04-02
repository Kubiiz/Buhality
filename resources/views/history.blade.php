@extends('layouts.app')

@section('content')
    <div class="form-horizontal st">
        <div class="form-group head history">
            <i class="fa fa-history fa-lg"></i>&nbsp; Spēļu vēsture
        </div>
        <div class="form-group stats">
            <i class="fa fa-trophy"></i> Izspēlētas <span class="text-primary">{{ $count }}</span> spēles<br>
            <i class="fa fa-glass"></i> Kopā izdzerti <span class="text-primary">{{ $sum }}</span> šoti
        </div>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

        @if (count((array)$active) > 0)
            <div class="panel panel-info">
                <div class="panel-heading" role="tab" id="heading_open">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_open" aria-expanded="false" aria-controls="collapse_open">
                            <i class="fa fa-chevron-right"></i> {{ $active->title }}
                        </a>
                        <div class="pull-right right">
                            <a href="{{ url('/game') }}" class="label label-success"><i class="fa fa-play"></i> Turpināt</a>
                            <a href="{{ url('/game/stop') }}" onclick="if( confirm( 'Beigt spēli?' ) ) {return true;}else{return false;}" class="label label-danger"><i class="fa fa-stop"></i>&nbsp; Beigt</a>
                        </div>
                    </h4>
                </div>
                <div id="collapse_open" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_open">
                    <div class="panel-body">
                        @php
							$unser = unserialize($active->members);
							$shotss = 0;
                        @endphp

						<div class="pull-left">
                        @foreach($unser as $us)
                            @foreach($us as $ua => $s)
                                {{ $ua }} - <span class="text-primary">{{ $s }}</span> šoti<br>
								
								@php
									$shotss = $shotss +$s;
								@endphp
                            @endforeach
                        @endforeach
						</div>
						<div class="pull-right">
							<i><i class="fa fa-glass"></i> Izdzerti <span class="text-primary">{{ $shotss }}</span> šoti</i>
						</div>
                    </div>
                </div>
            </div>
            <br>
        @endif

        @if ($count > 0)
            @foreach($data as $d)
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading{{ $d->id }}">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $d->id }}" aria-expanded="false" aria-controls="collapse{{ $d->id }}">
                                <i class="fa fa-chevron-right"></i> {{ $d->title }}
                            </a>
                            <a href="{{ url('/history/' . $d->id . '/delete') }}" onclick="if( confirm( 'Dzēst spēli?' ) ) {return true;}else{return false;}" id="delete" class="btn label label-default">
                                <i class="fa fa-times"></i> Dzēst
                            </a>
                        </h4>
                    </div>
                    <div id="collapse{{ $d->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $d->id }}">
                        <div class="panel-body">
							<div class="pull-left">
                            @php
                                $unser = unserialize($d->members);
								$shots = [];
								$shots[$d->id] = 0;
                            @endphp

                            @foreach($unser as $us)
                                @foreach($us as $ua => $s)
                                    {{ $ua }} - <span class="text-primary">{{ $s }}</span> šoti<br>
									
									@php
										$shots[$d->id] = $shots[$d->id] + $s;
									@endphp
                                @endforeach
                            @endforeach
							</div>
							<div class="pull-right right">
								<div>
									<i class="fa fa-clock-o"></i>
									<div class="date">{{ $d->created_at }}</div>
								</div>
								<div>
									<i><i class="fa fa-glass"></i> Izdzerti <span class="text-primary">{{ $shots[$d->id] }}</span> šoti</i>
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
