@extends('admin.layouts.base')

@section('title', 'Add Pokemon to Pokedex')

@section('content')

  @if (session('errors'))
    @foreach(session('errors')->all() as $error)
      <div>{{ $error }}</div>
    @endforeach
  @endif

  <form method="POST">
    {{ csrf_field() }}
    <input type="text" name="name">
    <input type="text" name="japanese_name">
    <input type="text" name="japanese_katakana">
    <select name="type_one">
      <option value="">Unknown</option>
      <option>Grass</option>
      <option>Fire</option>
      <option>Water</option>
      <option>Electric</option>
      <option>Flying</option>
      <option>Ice</option>
      <option>Dragon</option>
      <option>Steel</option>
      <option>Poison</option>
      <option>Bug</option>
      <option>Psychic</option>
      <option>Ghost</option>
      <option>Fairy</option>
      <option>Dark</option>
      <option>Fighting</option>
      <option>Normal</option>
      <option>Ground</option>
      <option>Rock</option>
    </select>
    <select name="type_two">
      <option>Unknown</option>
      <option>Grass</option>
      <option>Fire</option>
      <option>Water</option>
      <option>Electric</option>
      <option>Flying</option>
      <option>Ice</option>
      <option>Dragon</option>
      <option>Steel</option>
      <option>Poison</option>
      <option>Bug</option>
      <option>Psychic</option>
      <option>Ghost</option>
      <option>Fairy</option>
      <option>Dark</option>
      <option>Fighting</option>
      <option>Normal</option>
      <option>Ground</option>
      <option>Rock</option>
    </select>
    <select name="habitat">
      <option>Unknown</option>
      <option>Forest</option>
      <option>Fresh Water</option>
      <option>Mountain</option>
    </select>
    <button type="submit">Add to Pokedex</button>
  </form>

@endsection