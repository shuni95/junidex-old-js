@extends('admin.layouts.base')

@section('title', 'Login')

@section('content')

  <div class="ui segment">
    <h1>Welcome {{ $user->username }}-sama!</h1>
  </div>

@endsection
