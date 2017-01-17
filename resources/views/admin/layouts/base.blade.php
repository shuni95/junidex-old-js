<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta charset="utf-8">

  <title>@yield('title')</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('/semantic.min.css') }}">
  <script src="{{ asset('/jquery-3.1.1.min.js') }}"></script>
  <script src="{{ asset('/semantic.min.js') }}"></script>

  @stack('head')
</head>
<body>

  <div class="ui grid">
    <div class="ui two wide column">
      @include('admin.layouts.sidebar')
    </div>
    <div class="ui fourteen wide column">
      <div class="ui container">
        @yield('content')
      </div>
    </div>
  </div>

  <!-- Scripts -->
  @stack('scripts')
</body>
</html>