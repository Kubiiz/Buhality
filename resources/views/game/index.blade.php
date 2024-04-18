@extends('layouts.app')

@section('content')
<div id="game">
    <div class="buttons">
        <button style="display: none" onclick="next_round()" class="btn btn-primary btn-md btn-game reset"><i
                class="fa fa-step-forward"></i> {{ __('Next round') }}</button>
        <button style="display: none" onclick="pause_game()" class="btn btn-primary btn-md btn-game pause"><i
                class="fa fa-pause"></i> {{ __('Pause') }}</button>
        <button style="display: none" onclick="run_game()" class="btn btn-primary btn-md btn-game continue"><i
                class="fa fa-play"></i> {{ __('Continue') }}</button>
    </div>
    <div class="counter">
        <button onclick="reset_counter()" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> {{ __('Refresh') }}</button>
        @foreach ($members as $memb)
            <div class="memb_counter">
                <div class="player" id="memb">{{ $memb->name }}</div> - <span class="text-primary" id="memb_{{ $memb->id }}">{{ $memb->count }}</span>
            </div>
        @endforeach
    </div>

    <div class="center">
        <div class="random"></div>
        <div style="display: none" id="pause">{{ __('Pause..') }}</div>
    </div>

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
</div>
<div id="alko" style="background: url('{{ asset('images') }}/alko-{{ app()->getLocale() }}.png')"></div>
@endsection
