@extends('base')
@section('title') Ver Contactos @endsection
@section('content')



  <div class="table-wrapper-scroll-y ">
        <table class="table ">
            <thead>
                <tr>
                    <th>{{ 'ID' }}</th>
                    <th>{{ 'NOMBRE' }}</th>
                    <th>{{ 'EMAIL' }}</th>
                    <th>{{ 'TELEFONO' }}</th>
                    <th>{{ 'MESSAGE' }}</th>
                    <th>{{ 'ACCIONES' }}</th>
                </tr>
            </thead>
            <tbody>
                @if (count($contacts) >= 1)
                    @foreach ($contacts as $contact)
                        <tr>
                            <td scope="row">{{ $contact->id }}</td>
                            <td scope="row">{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->message }}</td>
                            <td>
                                <a href="{{ route('contacts.show', $contact->id)}}" class="btn btn-sm btn-info">Detalle</a>
                                <form action="{{ route('contacts.destroy', $contact->id)}}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE')}}
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Desea eliminar este registro?')">Eliminar</button>
                                </form>

                            </td>

                        </tr>
                    @endforeach

                @else
                    <tr>
                        <td scope="row">{{'no encontro resultados'}}</td>

                    </tr>
                @endif

                <tr>

                </tr>

            </tbody>
        </table>
  </div>
@endsection
