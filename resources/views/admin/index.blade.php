@extends('layouts.admin')

@section('admin_content')
<ul class="list-group">
    <li class="list-group-item">
        <i class="fa fa-users text-primary"></i> {{ __('Registered users') }}
        <span class="badge">{{ $users }}</span>
    </li>
    <li class="list-group-item">
        <i class="fa fa-trophy text-primary"></i> {{ __('Created games') }}
        <span class="badge">{{ $games }}</span>
    </li>
    <li class="list-group-item">
        <i class="fa fa-user-plus text-primary"></i> {{ __('Added players') }}
        <span class="badge">{{ $players }}</span>
    </li>
    <li class="list-group-item">
        <i class="fa fa-glass text-primary"></i> {{ __('Drinked shots') }}
        <span class="badge">{{ $shots }}</span>
    </li>
</ul>
@endsection
