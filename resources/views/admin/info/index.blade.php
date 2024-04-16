@extends('layouts.admin')

@section('admin_content')
<h4>
    <i class="fa fa-bars fa-lg"></i>&nbsp; {{ __('Information sections') }}
    <a href="{{ route('info') }}" class="btn btn-sm pull-right btn-primary"><i class="fa fa-eye"></i> {{ __('See sections') }}</a>
</h4>
<br />
    @if(count($data) > 0)
        @if (session('deleted'))
            <div class="alert alert-success">
                {{ session('deleted') }}
            </div>
        @endif
        <ul class="list-group">
            @foreach($data as $info)
                <li class="list-group-item">
                    <i class="fa {{ $info->icon }} fa-lg text-primary text-center" style="width:15px;margin-right:5px"></i> {{ $info->title }}
                    @if($info->visible == 1)
                        <span class="label label-success">{{ __('Public') }}</span>
                    @else
                        <span class="label label-default">{{ __('Hidden') }}</span>
                    @endif
                    <div class="pull-right">
                        <a href="{{ route('admin.info.edit', $info->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> {{ __('Edit') }}</a>
                        <a href="{{ route('admin.info.destroy', $info->id) }}" onclick='return confirm("{{ __("Are you sure to delete information section?") }}")' class="btn btn-xs btn-danger"><i class="fa fa-pencil"></i> {{ __('Delete') }}</a>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="alert alert-info">
            {{ __('No information section added.') }}
            <a href="{{ route('admin.info.create') }}" class="btn btn-xs pull-right btn-success"><i class="fa fa-plus"></i> {{ __('Add section') }}</a>
        </p>
    @endif
@endsection
