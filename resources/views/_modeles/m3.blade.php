<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href={{ asset('/css/modeles.css') }} />
  <title>Modèle 3</title>
  <script src={{ asset('js/jquery.js') }}></script>
  <script src={{ asset('js/myjs.js') }}></script>
</head>

<body>
<div id="app">
  <model-3></model-3>
</div>
{{-- MIX BLADE WITH Vue.js --}}
<script src="{{ mix('js/app.js')}}">
</script>
</body>
</html>
