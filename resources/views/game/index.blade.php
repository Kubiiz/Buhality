@extends('layouts.app')

@section('content')
    <button style="display: none" onclick="javascript:next_round();" class="btn btn-primary btn-lg btn-game reset"><i
            class="fa fa-step-forward"></i> Nākošais raunds</button>
    <button style="display: none" onclick="javascript:pause_game();" class="btn btn-primary btn-lg btn-game pause"><i
            class="fa fa-pause"></i> Pauze</button>
    <button style="display: none" onclick="javascript:run_game();" class="btn btn-primary btn-lg btn-game continue"><i
            class="fa fa-play"></i> Turpināt</button>
    <div class="counter">
        @foreach ($members as $memb)
            <div class="memb_counter">
                <span id="memb">{{ $memb->name }}</span> - <span class="shots text-primary refresh"id="memb_{{ $memb->id }}">{{ $memb->count }}</span>
            </div>
        @endforeach
    </div>

    <div class="random"></div>
    <div style="display: none" id="pause">Pauze..</div>

    <div class="modal fade" id="stats" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-bar-chart"></i> Statistika</h4>
                </div>
                <div class="modal-body" id="show_stats">
                    <div class="pull-left">
                        @foreach ($members as $memb)
                            <div class="memb_stats">{{ $memb->name }} - <span id="memb_shots_{{ $memb->id }}"
                                    class="text-primary">{{ $memb->shots }}</span> šoti</div>
                        @endforeach
                    </div>
                    <div class="pull-right"><i class="fa fa-glass"></i> Izdzerti <span
                            class="text-primary">{{ $members->sum('shots') }}</span> šoti</div>
                    <div style="clear: both;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aizvērt</button>
                </div>
            </div>
        </div>
    </div>
@endsection
