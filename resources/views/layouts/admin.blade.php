@extends('layouts.app')

@section('content')
<div class="form-horizontal st info">
<div class="form-group head">
    <i class="fa fa-gear fa-lg"></i>&nbsp; Kontroles panelis
</div>
<div class="form-group">
    <ul class="nav nav-tabs">
        <li class="{{ Request::route()->named('admin.index') ? 'active' : '' }}"><a href="{{ route('admin.index') }}"><i class="fa fa-bar-chart fa-lg"></i>&nbsp; Statistika</a></li>
        <li class="{{ Request::route()->named('admin.info') ? 'active' : '' }}"><a href="{{ route('admin.info') }}"><i class="fa fa-info fa-lg"></i>&nbsp; Informācija</a></li>
    </ul>
    <br /><br />

    @yield('admin_content')

</div>
</div>
@endsection
