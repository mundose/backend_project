@extends('base')
@section('title') Categorias @endsection
@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="btn btn-sm btn-primary" href="{{ route('category.create') }}"> + Nuevo</a></li>
                </ul>
                <form action="{{ route('category.search') }}" method="POST" class="d-flex">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar">
                        <span class="input-group-btn">
                            <button class="btn btn-outline-info" type="submit"><span class="fas fa-search" aria-hidden="true"></span> Buscar</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </nav>
    <table class="table">
        <thead>
            <tr>
                <th>{{ "ID" }}</th>
                <th>{{ "CATEGORIA" }}</th>
                <th>{{ "ACCIONES" }}</th>
            </tr>
        </thead>
        <tbody>
            @if (count($categories) >= 1)
                @foreach ($categories as $category)
                    <tr>
                        <td scope="row"> {{ $category->id }} </td>
                        <td scope="row"> {{ $category->name }} </td>
                        <td>
                            <a href="{{ route("category.edit",$category->id ) }}" class="btn btn-sm btn-primary"> Editar</a>
                            <form action="{{ route("category.destroy", $category->id)}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field("DELETE")}}
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Desea eliminar este registro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td scope="row">{{"no encontro resultados"}}</td></tr>
            @endif
        </tbody>
    </table>
@endsection
