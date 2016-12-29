<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Evolution Chain</title>
</head>
<body>
@foreach ($evolutions_array as $evolution)
<div>
<p>{{ $evolution['pokemon']->name }} evolves into {{ $evolution['evolution']->name }} at {{ $evolution['details'] }}</p>
</div>
@endforeach
</body>
</html>
