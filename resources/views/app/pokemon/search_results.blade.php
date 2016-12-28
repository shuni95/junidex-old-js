<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Search results</title>
</head>
<body>
  @foreach ($pokemons as $pokemon)
  <div>
    <p>{{ $pokemon->name }}</p>
    <p>{{ $pokemon->japanese_name }}</p>
    <p>{{ $pokemon->japanese_katakana }}</p>
  </div>
  @endforeach
</body>
</html>
