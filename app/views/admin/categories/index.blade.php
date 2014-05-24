@extends('admin.template')

@section('content')
@include('admin._partials.delete_modal')
<div class="container">
    <div class="page-header">
        <h1>
            Categories <a href="{{ route('admin.categories.create') }}" class="btn btn-success pull-right">Add Category</a>
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
        @foreach ($categories->getItems() as $category)
        <tr>
            <td class="vert-align">{{ $category['name'] }}</td>
            <td class="vert-align text-right">
                <a href="{{ route('admin.categories.edit', $category['id']) }}" class="btn btn-primary btn-sm">Edit</a>
                {{ Form::open(['route' => ['admin.categories.destroy', $category['id']], 'method' => 'DELETE', 'class' => 'delete-form', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User']) }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
                {{-- <a href="{{ route('admin.categories.destroy', $category['id']) }}" class="btn btn-danger btn-sm">Delete</a> --}}
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3" class="text-right">
                {{ $categories->links() }}
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