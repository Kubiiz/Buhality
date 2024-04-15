@extends('layouts.app')

@section('content')
    <div class="form-horizontal st info">
        {{ csrf_field() }}

        <ul class="nav nav-tabs" role="tablist">
        @foreach($data as $info)
		    <li role="presentation" {!! $loop->index == 0 ? 'class="active"' : '' !!}><a href="#info_{{ $info->id }}" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa {{ $info->icon }} fa-lg"></i>&nbsp; {{ $info->title }}</a></li>
        @endforeach
    </ul>
	<br /><br />
	<div class="tab-content">
        @foreach($data as $info)
		<div role="tabpanel" class="fade in tab-pane{{ $loop->index == 0 ? ' active' : '' }}" id="info_{{ $info->id }}">
			<div class="form-group">
				{!! $info->content !!}
			</div>
		</div>
        @endforeach
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
				<label for="email" class="col-md-4 control-label">Jūsu epasts</label>
				<div class="form-group col-md-7 {{ $errors->has('email') ? 'has-error' : '' }}">
					<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="buhality@etr.lv" required>

					@error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>

				<label for="name" class="col-md-4 control-label">Jūsu vārds</label>
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
