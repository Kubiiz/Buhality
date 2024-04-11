@extends('layouts.app')

@section('content')
<div class="form-horizontal st">
    {{ csrf_field() }}

    <div class="form-group head">
        <i class="fa fa-user fa-lg"></i>&nbsp; Labot profilu</i>
    </div>
    <div class="form-group">
        @include('profile.partials.update-profile-information-form')
    </div>
    <div class="form-group">
        @include('profile.partials.update-password-form')
    </div>
</div>
@endsection
