@extends('admin.layouts.base')

@section('title', 'Add Pokemon to Pokedex')

@section('content')

  @if (session('errors'))
  <div class="ui error message">
    <i class="close icon"></i>
    <div class="header">Whoops!</div>
    <ul class="list">
    @foreach (session('errors')->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
    </ul>
  </div>
  @endif

  <div class="ui segment">
    <h2>Add Pokemon</h2>
  </div>

  <form class="ui form" method="POST">
    {{ csrf_field() }}
    <div class="field">
      <label>Name</label>
      <input type="text" name="name">
    </div>

    <div class="field">
      <label>Japanese Name</label>
      <input type="text" name="japanese_name">
    </div>

    <div class="field">
      <label>Japanese Katakana</label>
      <input type="text" name="japanese_katakana">
    </div>

    <div class="field">
      <label>Type primary</label>
      <select name="type_one">
        <option value="">Select a type</option>
        <option>Grass</option>
        <option>Fire</option>
        <option>Water</option>
        <option>Electric</option>
        <option>Flying</option>
        <option>Ice</option>
        <option>Dragon</option>
        <option>Steel</option>
        <option>Poison</option>
        <option>Bug</option>
        <option>Psychic</option>
        <option>Ghost</option>
        <option>Fairy</option>
        <option>Dark</option>
        <option>Fighting</option>
        <option>Normal</option>
        <option>Ground</option>
        <option>Rock</option>
      </select>
    </div>

    <div class="field">
      <label>Type secondary</label>
      <select name="type_two">
        <option value="">Select a type</option>
        <option>Grass</option>
        <option>Fire</option>
        <option>Water</option>
        <option>Electric</option>
        <option>Flying</option>
        <option>Ice</option>
        <option>Dragon</option>
        <option>Steel</option>
        <option>Poison</option>
        <option>Bug</option>
        <option>Psychic</option>
        <option>Ghost</option>
        <option>Fairy</option>
        <option>Dark</option>
        <option>Fighting</option>
        <option>Normal</option>
        <option>Ground</option>
        <option>Rock</option>
      </select>
    </div>

    <div class="field">
      <label>Habitat</label>
      <select name="habitat">
        <option>Unknown</option>
        <option>Forest</option>
        <option>Fresh Water</option>
        <option>Mountain</option>
      </select>
    </div>

    <div class="field">
      <div class="ui center aligned grid">
        <div class="column">
          <button class="ui green button" type="submit">Add to Pokedex</button>
        </div>
      </div>
    </div>
  </form>

@endsection

@push('scripts')
<script>
  $('.message .close').on('click', function() {
    $(this).closest('.message').transition('fade');
  });
</script>
@endpush
