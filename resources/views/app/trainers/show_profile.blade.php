<!DOCTYPE html>
<html>
<head>
  <title>{{ $user->username }}'s Profile</title>
</head>
<body>
<div>
  <p>Name: {{ $user->name }}</p>
  <p>Lastname: {{ $user->lastname }}</p>
  <p>Username: {{ $user->username }}</p>
  <p>Birthday: {{ $user->birthday_formatted }}</p>
</div>
</body>
</html>
