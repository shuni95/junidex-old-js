@extends('app.layouts.base')

@section('title', 'Register')

@section('content')
  <div class="ui container grid">
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
              <input type="text" name="name" placeholder="First Name" value="{{ old('name') }}">
            </div>
            <div class="field">
              <input type="text" name="lastname" placeholder="Last Name" value="{{ old('lastname') }}">
            </div>
          </div>
        </div>
        <div class="field">
          <label>Birthday</label>
          <div class="two fields">
            <div class="field">
              <input type="date" name="birthday" placeholder="{{ date('Y-m-d') }}" value="{{ old('birthday') }}">
            </div>
          </div>
        </div>
        <h4 class="ui dividing header">Credentials</h4>
        <div class="field">
          <div class="two fields">
            <div class="field">
              <label>Username</label>
              <input type="text" name="username" placeholder="Username" value="{{ old('username') }}">
            </div>
            <div class="field">
              <label>Email</label>
              <input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
            </div>
          </div>
        </div>
        <div class="field">
          <div class="two fields">
            <div class="field">
              <label>Password</label>
              <input type="password" name="password">
            </div>
            <div class="field">
              <label>Confirm Password</label>
              <input type="password" name="password_confirmation">
            </div>
          </div>
        </div>
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
@endsection

@push('scripts')
<script>
  $('.message .close').on('click', function() {
    $(this).closest('.message').transition('fade');
  });
</script>
@endpush
