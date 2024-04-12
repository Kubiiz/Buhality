@extends('layouts.admin')

@section('admin_content')
<ul class="list-group">
    <li class="list-group-item">
        <i class="fa fa-users text-primary"></i> Reģistrēti lietotāji
        <span class="badge">{{ $users }}</span>
    </li>
    <li class="list-group-item">
        <i class="fa fa-trophy text-primary"></i> Pievienotas spēles
        <span class="badge">{{ $games }}</span>
    </li>
    <li class="list-group-item">
        <i class="fa fa-user-plus text-primary"></i> Pievienoti spēlētāji
        <span class="badge">{{ $players }}</span>
    </li>
    <li class="list-group-item">
        <i class="fa fa-glass text-primary"></i> Izdzerti šoti
        <span class="badge">{{ $shots }}</span>
    </li>
</ul>
@endsection
