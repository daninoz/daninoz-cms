@extends('admin.template')

@section('content')
<div class="container">
    <div class="page-header">
        <h1>New Category</h1>
    </div>
    {{ Form::open(['route' => 'admin.categories.store', 'method' => 'POST']) }}
    <div class="row">
        <div class="form-group col-sm-4">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', Input::old('name'), ['class' => 'form-control']) }}
            {{ Form::errors($errors->get('name')) }}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-8">
            {{ Form::link('Cancel', action('admin.categories.index'), ['class' => 'btn btn-info']) }}
        </div>
        <div class="form-group col-sm-4 text-right">
            {{ Form::reset('Clean', ['class' => 'btn btn-warning']) }}
            {{ Form::submit('Send', ['class' => 'btn btn-success']) }}
        </div>
    </div>
</div>
@stop