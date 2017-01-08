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
          <i class="home icon"></i> Home
        </a>
      </div>
      <div class="right menu">
        @if (Auth::guard('trainer')->check())
        <div class="ui buttons">
          <div class="ui button">{{ Auth::guard('trainer')->user()->user->username }}</div>
          <div class="ui floating dropdown icon button">
            <i class="dropdown icon"></i>
            <div class="menu">
              <div class="item">
              <form id="logout-form" action="{{ route('app.trainers.logout') }}" method="POST">
              {{ csrf_field() }}
              <button class="ui red button" type="submit">Logout</button>
              </form>
            </div>
          </div>
        </div>
        @else
        <div class="ui inverted buttons">
          <a class="ui inverted button" href="{{ route('app.trainers.login.showForm') }}">Login</a>
          <div class="ui floating inverted dropdown icon button">
            <i class="dropdown icon"></i>
            <div class="menu">
              <a class="item ui inverted button" href="{{ route('app.trainers.register.showForm') }}">Register</a>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
  <script>
    $('.ui.dropdown').dropdown();
  </script>
</body>
</html>
