<!DOCTYPE html>
<html>
<head>
  <title>Register trainer</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('/semantic.min.css') }}">
  <script src="{{ asset('/semantic.min.js') }}"></script>
</head>
<body>
  <div class="ui container">
    <form class="ui form" method="POST">
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
    <button class="ui button blue" type="submit">Register</button>
    </form>
  </div>
</body>
</html>
