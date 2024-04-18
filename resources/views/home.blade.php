@extends('layouts.app')

@section('content')
    <img class="logo" src="{{ asset('images') }}/logo-{{ app()->getLocale() }}.png" alt="" />
    <div id="alko" style="background: url('{{ asset('images') }}/alko-{{ app()->getLocale() }}.png')"></div>
@endsection
