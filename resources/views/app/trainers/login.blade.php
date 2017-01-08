@extends('app.layouts.base')

@section('title', 'Login')

@section('content')
  <div class="ui container grid center aligned">
    <div class="row">
      <img style="width: 130px; height: 130px;" class="ui image" src="{{ asset('img/PokemonSymbol.svg') }}"/>
    </div>
    <div class="row">
      <h1>Trainer's Zone</h1>
    </div>
    @if (session('error_message'))
    <div class="row">
      <div class="ui sixteen wide mobile ten wide tablet six wide computer column">
        <div class="ui error message">
        {{ session('error_message') }}
        </div>
      </div>
    </div>
    @endif
    <div class="row">
      <div class="ui huge form sixteen wide mobile ten wide tablet six wide computer column">
        <form method="POST">
          {{ csrf_field() }}
          <div class="field">
            <input type="text" name="email" placeholder="Username or Email">
          </div>
          <div class="field">
            <input type="password" name="password" placeholder="Password">
          </div>
          <div class="ui center aligned grid">
            <div class="ui column">
              <button class="huge ui fluid button blue" type="submit">Login</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="ui green segment">
      <p>Don't have an account? <a href="{{ route('app.trainers.register.showForm') }}">Register here</a></p>
      </div>
    </div>
  </div>
@endsection
