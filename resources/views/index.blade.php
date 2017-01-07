<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <title>Junidex</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('/semantic.min.css') }}">
  <script src="{{ asset('/jquery-3.1.1.min.js') }}"></script>
  <script src="{{ asset('/semantic.min.js') }}"></script>
</head>
<body>
  <div class="ui inverted segment">
    <div class="ui inverted menu">
      <div class="ui inverted secondary pointing menu">
        <a class="active item" href="{{ url('/') }}">
          Home
        </a>
      </div>
      <div class="right menu">
      <div class="item">
        @if (Auth::guard('trainer')->check())
          {{ Auth::guard('trainer')->user()->user->username }}
        @else
        <a class="ui inverted button" href="{{ route('app.trainers.login.showForm') }}">
          Login
        </a>
        @endif
      </div>
      </div>
    </div>
  </div>
</body>
</html>