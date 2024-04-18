@extends('layouts.app')

@section('content')
<div class="form-horizontal form">
    {{ csrf_field() }}

    <h4 class="form-group head text-center">
        <i class="fa fa-user fa-lg"></i>&nbsp; {{ __("Edit profile") }}</i>
    </h4>
    <div class="form-group">
        @include('profile.partials.update-profile-information-form')
    </div>
    <div class="form-group">
        @include('profile.partials.update-password-form')
    </div>
</div>
@endsection
