@extends('layouts.app')

@section('content')
    <button style="display: none" onclick="javascript:next_round();" class="btn btn-primary btn-lg btn-game reset"><i
            class="fa fa-step-forward"></i> {{ __('Next round') }}</button>
    <button style="display: none" onclick="javascript:pause_game();" class="btn btn-primary btn-lg btn-game pause"><i
            class="fa fa-pause"></i> {{ __('Pause') }}</button>
    <button style="display: none" onclick="javascript:run_game();" class="btn btn-primary btn-lg btn-game continue"><i
            class="fa fa-play"></i> {{ __('Continue') }}</button>
    <div class="counter">
        <button onclick="javascript:reset_counter();" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> {{ __('Refresh') }}</button>
        @foreach ($members as $memb)
            <div class="memb_counter">
                <span id="memb">{{ $memb->name }}</span> - <span class="shots text-primary refresh"id="memb_{{ $memb->id }}">{{ $memb->count }}</span>
            </div>
        @endforeach
    </div>

    <div class="random"></div>
    <div style="display: none" id="pause">{{ __('Pause..') }}</div>

    <div class="modal fade" id="stats" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-bar-chart"></i> {{ __('Statistics') }}</h4>
                </div>
                <div class="modal-body" id="show_stats"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
