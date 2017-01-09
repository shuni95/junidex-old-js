@extends('app.layouts.base')

@section('title', 'Junidex')

@section('content')

<div class="ui container grid">
  <div class="ui four row centered grid">
    <a href="{{ route('app.search_pokemon') }}" class="ui green button">Try our Pokemon Search</a>
  </div>
</div>

@endsection
