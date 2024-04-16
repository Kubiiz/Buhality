<div class="pull-left">
    @foreach ($members as $memb)
        <div class="memb_stats">{{ $memb->name }} - <span id="memb_shots_{{ $memb->id }}" class="text-primary">{{ $memb->shots }}</span> {{ __('shots') }}</div>
    @endforeach
</div>
<div class="pull-right"><i class="fa fa-glass"></i> {!! __("<span class='text-primary'>:shots</span> shots consumed", ['shots'=> $members->sum('shots')]) !!}</div>
<div style="clear: both;"></div>
