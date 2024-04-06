<div class="pull-left">
    @foreach ($members as $memb)
        <div class="memb_stats">{{ $memb->name }} - <span id="memb_shots_{{ $memb->id }}"class="text-primary">{{ $memb->shots }}</span> šoti</div>
    @endforeach
</div>
<div class="pull-right"><i class="fa fa-glass"></i> Izdzerti <spanclass="text-primary">{{ $members->sum('shots') }}</span> šoti</div>
<div style="clear: both;"></div>
