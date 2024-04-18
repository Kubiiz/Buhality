<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ __('Party game') }}">
    <meta name="keywords" content="Buhality, buha, buhāt, buba, bubāt, dzert, kost, ieraut, liet bākā">
    <meta name="author" content="Kubiiz (epasts - buhality@etr.lv)">
    <title>Buhality - {{ __('Party game') }}</title>
    <link rel="shortcut icon" href="{{ asset('images') }}/favicon.png" type="image/png" />
    <script>
        const base = '{{ route('dashboard') }}/';
    </script>
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/buhality.js?' . time()) }}" defer></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<link href="{{ asset('css/style.css?' . time()) }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css?' . time()) }}" rel="stylesheet">
	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="{{ route('dashboard') }}">
						<img class="m_logo" src="{{ asset('images') }}/m_logo.png" alt="" />
						BUHALITY
					</a>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
						<li class="nav-item">
							<a href="{{ route('info') }}"><i class="fa fa-info fa-lg text-info"></i>&nbsp; {{ __('Information') }}</a>
                        </li>
						@if (!Auth::guest())
                            <li><a href="{{ route('newgame') }}"><i class="fa fa-plus fa-lg text-primary"></i>&nbsp; {{ __('New game') }}</a></li>

                            @if (count(Auth::user()->game->whereNull('ended')))
                                <li><a href="{{ route('game.index') }}"><i class="fa fa-arrow-right fa-lg text-success"></i>&nbsp; {{ __('Continue') }}</a></li>
                                <li><a href="{{ route('game.stop') }}" onclick='return confirm("{{ __("Are you sure you want to end this game?") }}")'><i class="fa fa-stop fa-lg text-warning"></i>&nbsp; {{ __('End game') }}</a></li>

                                @if (request()->is('game'))
                                    <li><a href="javascript:;" data-toggle="modal" data-target="#stats" id="update_stats"><i class="fa fa-bar-chart fa-lg text-success"></i>&nbsp; {{ __('Statistics') }}</a></li>
                                @endif
                            @endif
                        @endif

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <p class="navbar-text navbar-left lang">
                            <a href="{{ route('language', 'lv') }}"><img {{ app()->isLocale('lv') ? 'class=active' : '' }} src="{{ asset('images') }}/flag-lv.png" alt="Latviešu" /></a>
                            <a href="{{ route('language', 'en') }}"><img {{ app()->isLocale('en') ? 'class=active' : '' }} src="{{ asset('images') }}/flag-en.png" alt="English" /></a>
                        </p>

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-sign-in fa-lg text-info"></i> {{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                               <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-user-plus fa-lg text-success"></i> {{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-user fa-lg"></i>&nbsp; {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
								<ul class="dropdown-menu" role="menu">
									<li>
										@if (Auth::user()->group == 1)
											<a href="{{ route('admin.index') }}"><i class="fa fa-gear"></i> {{ __('Control panel') }}</a>
										@endif

										<a href="{{ route('games') }}"><i class="fa fa-history"></i> {{ __('My games') }}</a>
                                        <a href="{{ route('profile.edit') }}"><i class="fa fa-pencil"></i> {{ __('Edit profile') }}</a>
										<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
											<i class="fa fa-sign-out"></i> {{ __('Logout') }}
										</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
										</form>
									</li>
								</ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div id="container">
            @yield('content')
        </div>
    </div>
    <div id="alko" style="background: url('{{ asset('images') }}/alko-{{ app()->getLocale() }}.png')">
        <div class="label close">
            <i class="fa fa-times fa-md"></i> {{ __('Hide') }}
        </div>
    </div>
</body>
</html>
