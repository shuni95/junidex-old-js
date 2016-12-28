<!DOCTYPE html>
<html>
<head>
  <title>Search results</title>
</head>
<body>
  @foreach ($pokemons as $pokemon)
  <div>
    <p>{{ $pokemon->name }}</p>
    <p>{{ $pokemon->japanese_name }}</p>
  </div>
  @endforeach
</body>
</html>
