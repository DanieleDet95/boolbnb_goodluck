{{-- Layouts/app.blade.php --}}

<!DOCTYPE html>
<html lang="en" dir="ltr">

  {{-- Include Head --}}
  @include("partials.head")

  <body class="bg-white">
    <div class="main_wrapper">

      {{-- Header --}}
      @include("partials.header")

      {{-- Main --}}
      <main>
        @yield('content')
      </main>
      {{-- end Main --}}

      {{-- Footer --}}
      @include("partials.footer")
    </div>
  </body>
</html>
