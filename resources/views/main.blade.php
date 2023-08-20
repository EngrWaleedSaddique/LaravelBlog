<!DOCTYPE html>
<html lang="en">
<head>
@include('partials._head')
</head>
  <body>
    <!-- Default Bootstrap Navbar -->
      @include('partials._nav')
     <!-- container starts from here -->
    <div class="container">
        @include('partials._messages')
        
        @yield('content')
        @include('partials._footer')
    </div>
    <!-- containers ends from here -->

    @include('partials._javascript')
    @yield('scripts')


  </body>
</html>