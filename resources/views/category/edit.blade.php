@extends('base')
@section('title') Category Edit @endsection
@section('content')
<form action="{{ route('category.update', $category->id) }}" method="post">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="mb-3">
        <label for="title" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">descripción</label>
        <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ $category->description }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
@endsection
