@extends('app.layouts.base')

@section('title', 'Junidex')

@push('head')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/pokemon.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/search.css') }}">
@endpush

@section('content')

  <div class="ui container grid">
    <div class="row">
      <div class="ui search">
        <div class="ui icon input">
        <form method="GET">
          <input class="prompt" type="text" placeholder="Search pokemon..." name="name" value="{{ request('name') }}">
          <i class="search icon"></i>
        </form>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="ui container grid">
      @forelse ($pokemons as $pokemon)
        <div class="sixteen wide mobile eight wide tablet four wide computer column pokemon {{ strtolower($pokemon->name) }}-bg">
          <p>{{ $pokemon->name }}</p>
          <p>{{ $pokemon->japanese_name }}</p>
          <p>{{ $pokemon->japanese_katakana }}</p>
        </div>
      @empty
        <div class="ui column center aligned">
          <div class="ui message">
            Pokemon not found
          </div>
          <div class="ui segment">
            <img class="ui centered image" src="{{ asset('img/mew-no-search-results.jpg') }}">
          </div>
        </div>
      @endforelse
      </div>
    </div>
  </div>

@endsection
