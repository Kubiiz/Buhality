@extends('layouts.app')

@section('content')
    <img class="logo" src="{{ asset('images') }}/logo-{{ app()->getLocale() }}.png" alt="" />
@endsection
