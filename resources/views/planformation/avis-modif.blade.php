
@extends('layouts.admin')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Mediexperts</title>
  <script src={{ asset('js/jquery.js') }}></script>
  <script src={{ asset('js/myjs.js') }}></script>
  {{-- <title>TEST</title> --}}
</head>
<body>
@section('content')
  <div id="app">
   <avis-modification></avis-modification>

  </div>
  {{-- MIX BLADE WITH Vue.js --}}
  <script src="{{ mix('js/app.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
@endsection
</body>
</html>
