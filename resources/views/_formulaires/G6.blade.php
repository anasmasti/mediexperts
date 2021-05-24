<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('/css/modeles.css') }} />
    <link rel="stylesheet" href="{{ asset('/css/A4.css') }}">
    <title>G6</title>
    <script src={{ asset('js/jquery.js') }}></script>
    <script src={{ asset('js/myjs.js') }}></script>
  </head>
  <body>

    <div id="app">
      <print-g6></print-g6>
     </div>

      {{-- Laravel MIX --}}
     <script src="{{ mix('js/app.js')}}">

     </script>
  </body>
</html>
