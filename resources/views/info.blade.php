@extends('layouts.app')

@section('content')
    <div class="form-horizontal st info">
        {{ csrf_field() }}

        <ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#help" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-question-circle-o fa-lg"></i>&nbsp; Pamācība</a></li>
		<li role="presentation"><a href="#info" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-info fa-lg"></i>&nbsp; Informācija</a></li>
		<li role="presentation"><a href="#rules" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-list-alt fa-lg"></i>&nbsp; Noteikumi</a></li>
	</ul>
	<br /><br />
	<div class="tab-content">
		<div role="tabpanel" class="fade in tab-pane active" id="help">
			<div class="form-group">
				<b><i class="fa fa-question-circle-o"></i> Kā sākt spēli?</b><br />
				<i class="push"></i>Navigācijā izvēlamies sadaļu "<i class="fa fa-plus fa-lg"></i>&nbsp;<b>Jauna spēle</b>" un Ierakstām visu informāciju par šodienas "<i>kodienu</i>":<br />
				<i class="push"></i><i class="push"></i> <b>* Nosaukums</b> <i>(Lai pēc spēles pabeigšanas, atrastu to spēļu vēsturē)</i><br />
				<i class="push"></i><i class="push"></i> <b>* Dalībnieki</b> <i>(Dalībniekus var pievienot, spiežot uz pogas <span class="label label-success">Pievienot</span>. Max 10 dalībnieki un min 2, jo 1 jau skaitās alkoholisms)</i><br />
				<i class="push"></i><i class="push"></i> <b>* Skaits</b> <i>(Līdz cik spēlei skaitīt. Piemēram, līdz 5. Sasniedzot kādam dalībniekam 5 punktus, spēle tiks apturēta un laimīgajam jādzer šots)</i><br />
				<i class="push"></i><i class="push"></i> <b>* Bomba</b> <i>(Izvēles iespēja. Nejaušības pēc var izkrīst "Bomba" un būs jādzer visiem spēles dalībniekiem)</i><br />
				<br />
				<b><i class="fa fa-question-circle-o"></i> Kā spelēt?</b><br />
				<i class="push"></i>Kad spēle ir iestatīta, tā automātiski sāks darboties. Ja nejauši esiet uzgājuši no spēles, to ir iespējams turpinat, navigācijā izvēloties sadalu "<i class="fa fa-arrow-right fa-lg"></i> <b>Turpināt spēli</b>"<br />
				<i class="push"></i>Ja nepieciešama pauze <i>(Piemēram, kādam dalībniekam vajag uz ķemertiņu)</i>, spēli ir iespējams apturēt, spiežot augšā labaja pusē uz pogas <span class="label label-primary"><i class="fa fa-pause"></i> Pauze</span><br />
				<i class="push"></i>Kad pauzi vēlaties pārtraukt un turpināt spēli, spiediet <span class="label label-primary"><i class="fa fa-play"></i> Turpināt</span><br />
				<i class="push"></i>Spēlei apturot darbību <i>(Tika sasniegts punktu skaits, kurš iestatīts uzsākot spēli)</i>, laimīgajam jāizdzer šots. Pēc tam jāuzspiež poga <span class="label label-primary"><i class="fa fa-step-forward"></i> Nākošais raunds</span>, lai atiestatītu skaitītāju un turpinātu spēli.<br />
				<i class="push"></i>Sadaļā "<i class="fa fa-bar-chart fa-lg"></i> <b>Statistika</b>" ir iespējams apskatit statistiku, cik katrs ir izdzēris šotus.<br />
				<i class="push"></i>Ja vēlaties pārtraukt vai sākt jaunu spēli, dotieties uz sadaļu "<i class="fa fa-plus fa-lg"></i>&nbsp;<b>Jauna spēle</b>"
			</div>	
		</div>
		<div role="tabpanel" class="fade tab-pane" id="info">
			<div class="form-group">
            <i class="fa fa-code fa-lg"></i> Spēles versija - <b>v2</b> <i>(atjaunota 05.01.2023)</i>
			</div>
			<?php
			/*
			<div class="form-group">
				<i class="fa fa-gamepad fa-lg"></i> Kopā izspēlētas <b>0</b> spēles<br> 
				<i class="fa fa-beer fa-lg"></i>&nbsp; Kopā izdzerti <b>0</b> šoti<br> 
			</div>
			*/ ?>
			<div class="form-group">
				<b><i class="glyphicon glyphicon-signal"></i> Spēles iestatījumi (% iespējas)</b>
				<div class="group">
					<span class="label label-success">44%</span> pieskaita +1<br />
					<span class="label label-success">10%</span> pieskaita visiem +1<br />
					<span class="label label-success">15%</span> pieskaita +2<br />
					<span class="label label-success">20%</span> atņem -1<br />
					<span class="label label-success">10%</span> neviens<br />
					<span class="label label-success">1%</span> Bomba (dzer visi)<br />
				</div>
				<b><i class="fa fa-history fa-lg"></i> Nedaudz par vēsturi</b>
				<div class="group justify">
					<i class="push"></i>Reiz jaukā un siltā vasaras dienā, 4 draugi izdomāja iedzert garāžā šnabuci. Nedaudz iedzerot, radās ideja -
					uzkodēt vienkāršu skriptu, kurš parādīs randomā kādu no draugu vārdiem un tam laimīgajam būs jāizdzer šotiņš.<br />
					<i class="push"></i>Laikam ejot, vienkārš skripts kļuva par spēli un tā tika nosaukta par "<b>Buhality</b>".
					Paļaujoties uz mūsu fantāziju, ik pa laikam tiek veikti dažādi uzlabojumi. Daži labi, daži varbūt ne tik veiksmīgi, bet iznākums ir OK. Piekrītiet?
				</div>
			</div>
		</div>
		<div role="tabpanel" class="fade tab-pane" id="rules">
			<div class="form-group">
				<b>1.</b> Spēli var spēlēt tikai un vienīgi personas, kas sasniegušas <b>18+</b> gadu vecumu!<br />
				<b>2.</b> Padomāt jeb aprēķināt, izmantojot augstākās matemātikas algoritmus, cik daudz būs nepieciešams alkohols.<br />
				<b>3.</b> Labs noskaņojums un vēlme "<i>pieliet</i>" seju.<br />
				<b>4.</b> Lietot alkoholu saprāta robežās, jo tam ir negatīve ietekme uz veselību!
			</div>
		</div>
	</div>
			<br /><br />
		<div class="form-group useform">
			<center>
				<i class="fa fa-user"></i>&nbsp;Saziņa ar <span><b>izstrādātāju</b></span>
			</center>
        </div>
		
        @if(session('success'))
			<div class="alert alert-success">
			  {{ session('success') }}
			</div>
        @endif
		
        <div class="card-body">
            <form method="POST" action="{{ url('info') }}">
				@csrf
				<label for="email" class="col-md-4 control-label">Email address</label>
				<div class="form-group col-md-7 {{ $errors->has('email') ? 'has-error' : '' }}">
					<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="buhality@etr.lv" required>
					
					@error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>
				
				<label for="name" class="col-md-4 control-label">Name</label>
				<div class="form-group col-md-7 {{ $errors->has('name') ? 'has-error' : '' }}">
					<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Jūsu vārds" required>
					
					@error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>
				
				<label for="comment" class="col-md-4 control-label">Ziņa</label>
				<div class="form-group col-md-7 {{ $errors->has('comment') ? 'has-error' : '' }}">
					<textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
					<span class="text-danger">{{ $errors->first('comment') }}</span>
				</div>
				
				<div class="form-group">
                    <div class="col-md-7 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check"></i> Sūtīt
                        </button>
                    </div>
                </div>
			</form>
        </div>
    </div>
@endsection
