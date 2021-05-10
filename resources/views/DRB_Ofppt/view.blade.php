@extends('layouts.admin')

@section('content')
  <div id="app">
   <List></List>
  </div>
@endsection
{{-- MIX BLADE WITH Vue.js --}}
<script src="{{ mix('js/app.js')}}"></script>