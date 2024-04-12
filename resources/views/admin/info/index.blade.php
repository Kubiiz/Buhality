@extends('layouts.admin')

@section('admin_content')
<h4>
    <i class="fa fa-bars fa-lg"></i>&nbsp; Informācijas sadaļas
    <a href="{{ route('info') }}" class="btn btn-sm pull-right btn-primary"><i class="fa fa-eye"></i> Skatīt sadaļas</a>
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
                    <div class="pull-right">
                        <a href="{{ route('admin.info.edit', $info->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> Labot</a>
                        <a href="{{ route('admin.info.destroy', $info->id) }}" onclick="if(confirm('Dzēst informācijas sadaļu?')){return true;}else{return false;}" class="btn btn-xs btn-danger"><i class="fa fa-pencil"></i> Dzēst</a>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="alert alert-info">
            Nav pievienota neviena informācijas sadaļa.
            <a href="{{ route('admin.info.create') }}" class="btn btn-xs pull-right btn-success"><i class="fa fa-plus"></i> Pievienot sadaļu</a>
        </p>
    @endif
@endsection
