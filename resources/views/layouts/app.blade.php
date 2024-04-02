<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Dzeršanas spēle">
    <meta name="keywords" content="Buhality, buha, buhāt, buba, bubāt, dzert, kost, ieraut, liet bākā">
    <meta name="author" content="Kubiiz (epasts - buhality@etr.lv)">
    <title>Buhality - Dzeršanas spēle</title>
    <link rel="shortcut icon" href="{{ asset('images') }}/favicon.png" type="image/png" />
    <script>
        var base = '{{ url('/') }}/';
    </script>
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/buhality.js?' . time()) }}" defer></script>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-28201819-1"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<link href="{{ asset('css/style.css?' . time()) }}" rel="stylesheet">
	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="{{ url('/') }}">
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
							<a href="{{ url('/info') }}"><i class="fa fa-info fa-lg"></i>&nbsp; Informācija</a>
                        </li>
						@if (!Auth::guest())
                        <li><a href="{{ url('/new-game') }}"><i class="fa fa-plus fa-lg"></i>&nbsp; Jauna spēle</a></li>

                        @if (request()->is('game'))
                            <li><a href="javascript:;" data-toggle="modal" data-target="#stats"><i class="fa fa-bar-chart fa-lg"></i>&nbsp; Statistika</a></li>
                        @elseif (count(Auth::user()->game->where('active', 0)) > 0)
                            <li><a href="{{ url('/game') }}"><i class="fa fa-arrow-right fa-lg"></i>&nbsp; Turpināt spēli</a></li>
                        @endif
                    @endif

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-sign-in fa-lg"></i> {{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                               <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-user-plus fa-lg"></i> {{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-user fa-lg"></i>&nbsp; {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
								<ul class="dropdown-menu" role="menu">
									<li>
										@if (Auth::user()->group == 1)
											<a href="{{ url('/cp') }}"><i class="fa fa-gear"></i> Kontroles panelis</a>
										@endif

										<a href="{{ url('/history') }}"><i class="fa fa-history"></i> Spēļu vēsture</a>
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

        <main class="py-4">
            @yield('content')
			<div id="alko"></div>
        </main>
    </div>
</body>
</html>
