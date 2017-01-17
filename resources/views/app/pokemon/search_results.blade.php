@extends('app.layouts.base')

@section('title', 'Junidex')

@push('head')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/pokemon.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/search.css') }}">
@endpush

@section('content')

  <div class="ui container grid">

    <form class="ui container grid" method="GET">
      <div class="four wide column">
        <div class="ui search">
          <div class="ui icon input">
            <input class="prompt" type="text" placeholder="Search pokemon..." name="name" value="{{ request('name') }}">
            <i class="search icon"></i>
          </div>
        </div>
      </div>
      <div class="four wide column">
        <div class="ui fluid search selection dropdown">
          <input type="hidden" name="type" value="{{ request('type') }}">
          <i class="dropdown icon"></i>
          <div class="default text">Select Type</div>
          <div class="menu">
          <div class="item fire-type">Fire</div>
          <div class="item water-type">Water</div>
          <div class="item grass-type">Grass</div>
          <div class="item rock-type">Rock</div>
          <div class="item ground-type">Ground</div>
          <div class="item ice-type">Ice</div>
          <div class="item poison-type">Poison</div>
          <div class="item flying-type">Flying</div>
          <div class="item psychic-type">Psychic</div>
          <div class="item ghost-type">Ghost</div>
          <div class="item bug-type">Bug</div>
          <div class="item dark-type">Dark</div>
          <div class="item normal-type">Normal</div>
          <div class="item fairy-type">Fairy</div>
          <div class="item steel-type">Steel</div>
          <div class="item fighting-type">Fighting</div>
          </div>
        </div>
      </div>
      <div class="two wide column">
        <button class="ui blue button">Search</button>
      </div>
      {{-- <select class="ui search dropdown"> --}}
    </form>

    <div class="row">
      <div class="ui container grid">
      @forelse ($pokemons as $pokemon)
        <div class="sixteen wide mobile eight wide tablet four wide computer column pokemon {{ strtolower($pokemon->name) }}-bg">
          <p>{{ $pokemon->name }}</p>
          <p>{{ $pokemon->japanese_name }}</p>
          <p>{{ $pokemon->japanese_katakana }}</p>
          <a id="fav-{{ $pokemon->id }}" class="fav-pokemon"><i class="{{ $pokemon->is_favorite ? 'star icon' : 'empty star icon' }}" id="icon-{{ $pokemon->id }}"></i></a>
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

@push('scripts')
  <script>
    var fav_url = "{{ route('app.trainers.pokemon_favorites.add') }}";
    var unfav_url = "{{ route('app.trainers.pokemon_favorites.remove') }}";
    var token = "{{ csrf_token() }}";
  </script>
  <script src="{{ asset('js/fav_pokemon.js') }}"></script>
@endpush
