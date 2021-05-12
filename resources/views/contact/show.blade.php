@extends('base')
@section('title') Contacto Show @endsection <!-- aqui se pone el titulo de la pagina -->
@section('content')
{{ method_field('PATCH')}}

<div>
     <div class="mb-3">
        <label for="name" class="form-label"><strong>Nombre:</strong>  {{ $contactos->name}} </label>

      <div class="mb-3">
        <label for="email" class="form-label"> <strong>Email:</strong> {{ $contactos->email}} </label>

      </div>

      <div class="mb-3">
        <label for="phone" class="form-label"> <strong>Telefono:</strong>  {{ $contactos->phone}} </label>
      </div>

      <div class="mb-3">
        <label for="message" class="form-label"><strong>Mensaje</strong> </label>
        <p>{{ $contactos->message}}</p>
      </div>

    </div>

@endsection
