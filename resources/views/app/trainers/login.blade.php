<!DOCTYPE html>
<html>
<head>
  <title>Login - Trainers</title>
</head>
<body>
@if (session('error_message'))
  {{ session('error_message') }}
@endif
<form method="POST">
  <input type="text" name="email">
  <input type="password" name="password">
  <button type="submit">Login</button>
</form>
</body>
</html>
