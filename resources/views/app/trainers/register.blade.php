<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <title>Register trainer</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('/semantic.min.css') }}">
  <script src="{{ asset('/jquery-3.1.1.min.js') }}"></script>
  <script src="{{ asset('/semantic.min.js') }}"></script>
</head>
<body>
  <div class="ui container grid">
    <div class="row"></div>
    @if (session('errors'))
    <div class="row">
      <div class="one wide tablet two wide computer column"></div>
      <div class="sixteen wide mobile fourteen wide tablet twelve wide computer column">
        <div class="ui error message">
          <i class="close icon"></i>
          <div class="header">Whoops!</div>
          <ul class="list">
          @foreach (session('errors')->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
          </ul>
        </div>
      </div>
      <div class="one wide tablet two wide computer column"></div>
    </div>
    @endif
    <div class="row">
      <div class="one wide tablet two wide computer column"></div>
      <div class="ui form sixteen wide mobile fourteen wide tablet twelve wide computer column">
        <form method="POST">
        {{ csrf_field() }}
        <h4 class="ui dividing header">Trainer Information</h4>
        <div class="field">
          <label>Name</label>
          <div class="two fields">
            <div class="field">
              <input type="text" name="name" placeholder="First Name">
            </div>
            <div class="field">
              <input type="text" name="lastname" placeholder="Last Name">
            </div>
          </div>
        </div>
        <div class="field">
          <label>Birthday</label>
          <div class="field">
            <input type="date" name="birthday" placeholder="{{ date('Y-m-d') }}">
          </div>
        </div>
        <h4 class="ui dividing header">Credentials</h4>
        <div class="field">
          <label>Username</label>
          <div class="field">
            <input type="text" name="username" placeholder="Username">
          </div>
        </div>
        <div class="field">
          <label>Email</label>
          <input type="text" name="email" placeholder="Email">
        </div>
        <div class="fields">
          <div class="eight wide field">
            <label>Password</label>
            <input type="password" name="password">
          </div>
          <div class="eight wide field">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password">
          </div>
        </div>
        <div class="field"></div>
        <div class="ui center aligned grid">
          <div class="ui sixteen wide mobile six wide computer column">
            <button class="large ui fluid button blue" type="submit">Register</button>
          </div>
        </div>
        </form>
      </div>
      <div class="one wide tablet two wide computer column"></div>
    </div>
  </div>

  <script>
    $('.message .close').on('click', function() {
      $(this).closest('.message').transition('fade');
    });
  </script>
</body>
</html>
