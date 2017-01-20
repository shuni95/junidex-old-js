@extends('admin.layouts.base')

@section('title', 'Login')

@section('content')

  @if (session('good_message'))
  <div>
    {{ session('good_message') }}
  </div>
  @endif

  <div class="ui segment">
    <h2>List of Pokemon</h2>
  </div>

  <table class="ui compact table">
  <thead>
    <th>Name</th>
    <th>Type</th>
    <th># Favs</th>
  </thead>
  <tbody>
    @foreach ($pokemons as $pokemon)
    <tr>
      <td>{{ $pokemon->name }}</td>
      <td>{{ $pokemon->type }}</td>
      <td>{{ $pokemon->num_favs_formatted }}</td>
    </tr>
    @endforeach
  </tbody>
  </table>
@endsection
