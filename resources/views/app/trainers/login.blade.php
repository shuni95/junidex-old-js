<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <title>Login - Trainers</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('/semantic.min.css') }}">
  <script src="{{ asset('/jquery-3.1.1.min.js') }}"></script>
  <script src="{{ asset('/semantic.min.js') }}"></script>
</head>
<body>
  <div class="ui container grid center aligned">
    <div class="row">
      <img class="ui image" src="{{ asset('img/PokemonSymbol.svg') }}"/>
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
  </div>
</body>
</html>
