@extends('layouts.app')

@section('content')

<div class="row">
    <div class="pull-left">
        <h2>Kelola Pengguna</h2>
    </div>
    <div class="col-lg-12">
        <div class="pull-right">
            @can('user-create')
            <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah Pengguna</a>
            @endcan
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Roles</th>
        <th>Aksi</th>
    </tr>
    @foreach($data as $key => $user)
    <tr>
        <td>{{ ++$i; }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $role)
            <label for="" class="badge bg-success">{{ $role }}</label>
            @endforeach
            @endif

        </td>
        <td>
            <a href="{{ route('users.show', $user->id) }}" class=" btn btn-info">Detail</a>
            @can('user-edit')
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
            @endcan
            @can('user-delete')
            {!! Form::open(
                [
                    'method' => 'DELETE',
                    'route' => ['users.destroy', $user->id],
                    'style' => 'display: inline'
                    ]
                    ) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>

{!! $data->render() !!}

@endsection