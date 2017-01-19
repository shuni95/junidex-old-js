@extends('admin.layouts.base')

@section('title', 'Login')

@section('content')
  <table>
  <thead>
    <th>Name</th>
    <th># Favs</th>
  </thead>
  <tbody>
    @foreach ($pokemons as $pokemon)
    <tr>
      <td>{{ $pokemon->name }}</td>
      <td>{{ $pokemon->num_favs }}</td>
    </tr>
    @endforeach
  </tbody>
  </table>
@endsection
