<!DOCTYPE html>
<html>
<head>
  <title>My Profile</title>
</head>
<body>
<div>
  <p>Name: {{ $user->name }}</p>
  <p>Lastname: {{ $user->lastname }}</p>
  <p>Username: {{ $user->username }}</p>
  <p>Birthday: {{ $user->birthday_formatted }}</p>
  <p>Email: {{ $user->email }}</p>
</div>
</body>
</html>
