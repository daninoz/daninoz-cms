@extends('admin.template')

@section('content')
    @include('admin._partials.delete_modal')
    <div class="container">
        <div class="page-header">
            <h1>
                Tags <a href="{{ route('admin.tags.create') }}" class="btn btn-success pull-right">Add Tag</a>
            </h1>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th colspan="2" class="text-right">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tags->getItems() as $tag)
            <tr>
                <td class="vert-align">{{ $tag['name'] }}</td>
                <td class="vert-align text-right">
                    <a href="{{ route('admin.tags.edit', $tag['id']) }}" class="btn btn-primary btn-sm">Edit</a>
                    {{ Form::open(['route' => ['admin.tags.destroy', $tag['id']], 'method' => 'DELETE', 'class' => 'delete-form', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Tag']) }}
                        {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
                    {{-- <a href="{{ route('admin.tags.destroy', $tag['id']) }}" class="btn btn-danger btn-sm">Delete</a> --}}
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3" class="text-right">
                    {{ $tags->links() }}
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
@stop

@section('scripts')
    @parent
    @include('admin._partials.delete_script')
@stop