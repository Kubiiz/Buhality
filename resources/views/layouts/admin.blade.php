@extends('layouts.app')

@section('content')
<div class="form-horizontal form">
<h4 class="form-group head text-center">
    <i class="fa fa-gear fa-lg"></i>&nbsp; {{ __('Control panel') }}
</h4>
<div class="form-group">
    <ul class="nav nav-tabs">
        <li class="{{ Request::route()->named('admin.index') ? 'active' : '' }}"><a href="{{ route('admin.index') }}"><i class="fa fa-bar-chart fa-lg"></i>&nbsp; {{ __('Statistics') }}</a></li>
        <li class="dropdown{{ Request::route()->named('admin.info') || Request::route()->named('admin.info.*') ? ' active' : '' }}">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="cursor:pointer">
                <i class="fa fa-info fa-lg"></i>&nbsp; {{ __('Information') }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('admin.info') }}"><i class="fa fa-bars fa-lg"></i>&nbsp; {{ __('Information sections') }}</a></li>
                <li><a href="{{ route('admin.info.create') }}"><i class="fa fa-plus fa-lg"></i>&nbsp; {{ __('Add section') }}</a></li>
            </ul>
          </li>
    </ul>
    <br />

    @yield('admin_content')

</div>
</div>
<script src="https://cdn.tiny.cloud/1/4mr44iuxpequ88kwdcfkabs1mnwl5umahwebbwii1kxxs7c3/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#editor',
        menubar: false,
        plugins: 'powerpaste advcode table lists',
        toolbar: 'undo redo blocks | forecolor backcolor | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | table | code'
    });
</script>
@endsection
