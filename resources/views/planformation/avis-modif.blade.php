@extends('layouts.admin')

@section('content')
  <div id="app">
   <avis-modification></avis-modification>
  </div>
@endsection
{{-- MIX BLADE WITH Vue.js --}}
<script src="{{ mix('js/app.js')}}"></script>
