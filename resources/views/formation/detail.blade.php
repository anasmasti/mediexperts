@extends('layouts.admin')


@section('content')

@section('content-wrapper')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Détails</h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/formation">Formation</a></li>
      <li class="breadcrumb-item active">{{ $formation->id_form }}</li>
    </ol>
  </div><!-- /.col -->
@endsection

{{-- jquery scripts --}}
<script src={{ asset('js/jquery.js') }}></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
{{-- jquery scripts --}}

<!-- CARD -->
<div class="card card-dark">
  <!-- card-header -->
  <div class="card-header" >
    <a class="btn btn-dark btn-sm bu-lg-ic" href="/formation"><i class="fa fa-arrow-left fa-1x"></i></a>
    <h3 class="card-title card-h3">Formation N° {{ $formation->id_form }} > Action N° {{ $plan->n_action }} > {{$formation["nom_theme"]}} > {{$formation["raisoci"]}}</h3>
    @if (Auth::user()->type_user != "comptable")
    <a class="btn btn-sm bua bu-ic" onclick="confirmDelete({{$formation->id_form}}, 'form/')"><i class="fa fa-trash-alt"></i></a>
    <a class="btn btn-sm buaj bu-ic" href="/edit-form/{{ $formation->id_form }}"><i class="fa fa-edit"></i></a>
    @endif
  </div>
  <!-- /.card-header -->
  <div class="card-body table-striped p-0">
    <table class="table table-md">
      <thead class="thead">
      </thead>
      <tbody>
        @php
          $dates =
          [
            'date1'=>$formation['date1'], 'date2'=>$formation['date2'], 'date3'=>$formation['date3'], 'date4'=>$formation['date4'], 'date5'=>$formation['date5'],
            'date6'=>$formation['date6'], 'date7'=>$formation['date7'], 'date8'=>$formation['date8'], 'date9'=>$formation['date9'], 'date10'=>$formation['date10'],
            'date11'=>$formation['date11'], 'date12'=>$formation['date12'], 'date13'=>$formation['date13'], 'date14'=>$formation['date14'], 'date15'=>$formation['date15'],
            'date16'=>$formation['date16'], 'date17'=>$formation['date17'], 'date18'=>$formation['date18'], 'date19'=>$formation['date19'], 'date20'=>$formation['date20'],
            'date21'=>$formation['date21'], 'date22'=>$formation['date22'], 'date23'=>$formation['date23'], 'date24'=>$formation['date24'], 'date25'=>$formation['date25'],
            'date26'=>$formation['date26'], 'date27'=>$formation['date27'], 'date28'=>$formation['date28'], 'date29'=>$formation['date29'], 'date30'=>$formation['date30']
          ];
        @endphp

        <tr><th class="th-det">ID</th>
          <td>{{ $formation->id_form }}</td></tr>
        <tr>
          <th class="th-det">Action formation</th>
          <td>
          <a href="/detail-pf/{{$plan->n_form}}">N° {{ $plan->n_action }}</a>
          de <a href="/detail-cl/{{$formation["nrc_entrp"]}}">{{$formation["raisoci"]}}</a>
          </td>
        </tr>
        <tr><th class="th-det">N° facture</th>
          <td>{{ $formation->n_facture }}</td></tr>
        <tr><th class="th-det">Groupe</th>
          <td>{{ $formation->groupe }}</td></tr>
        <tr><th class="th-det">Nb. bénificiares</th>
          <td>{{ $formation->nb_benif }}</td></tr>
        <tr><th class="th-det">Heure début</th>
          <td>{{ $formation->hr_debut }}</td></tr>
        <tr><th class="th-det">Heure fin</th>
          <td>{{ $formation->hr_fin }}</td></tr>
        <tr><th class="th-det">Pause début</th>
          <td>{{ $formation->pse_debut }}</td></tr>
        <tr><th class="th-det">Pause fin</th>
          <td>{{ $formation->pse_fin }}</td></tr>
        @foreach ($dates as $key => $date)
          @if ($date !== null)
          <tr>
            <th class="th-det">
              @php $jour_numero = (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT); @endphp
              {{ substr_replace($key, "Jour", -6)." ".$jour_numero }}
            </th>
            <td>{{ Carbon\Carbon::parse($date)->format('d/m/Y') }}</td>
          </tr>
          @endif
        @endforeach
        <tr>
          <td colspan="12" class="text-lg bg-dark">Personnels de formation</td>
        </tr>
        @for ($i=0; $i < count($personnel); $i++)
          <tr>
            <th class="th-det"><a href="/detail-pers/{{$personnel[$i]['cin']}}">{{$personnel[$i]['cin']}}</a></th>
            <td>{{$personnel[$i]['nom']}} {{$personnel[$i]['prenom']}}, <span class="text-bold"><br/>CNSS</span> : {{$personnel[$i]['cnss']}}</td>
          </tr>
        @endfor

        <tr>
          <th>Commentaire</th>
          <td>{{ $formation['comment_form'] }}</td>
        </tr>
      </tbody>
    </table>
  </div><!-- ./card-body -->

</div><!-- ./CARD -->

{{-- TOASTR NOTIFICATIONS --}}
@if (Session::has('added'))
<script>
  $(document).ready(function() {
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.success("{{ Session::get("added") }}");
  });
</script>
@endif
@if (Session::has('updated'))
<script>
  $(document).ready(function() {
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.success("{{ Session::get("updated") }}");
  });
</script>
@endif
@if (Session::has('deleted'))
<script>
  $(document).ready(function() {
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.success("{{ Session::get("deleted") }}");
  });
</script>
@endif
@if (Session::has('success'))
<script>
  $(document).ready(function() {
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.success("{{ Session::get("success") }}");
  });
</script>
@endif
@if (Session::has('warning'))
<script>
  $(document).ready(function() {
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.warning("{{ Session::get("warning") }}");
  });
</script>
@endif
@if (Session::has('info'))
<script>
  $(document).ready(function() {
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.info("{{ Session::get("info") }}");
  });
</script>
@endif
@if (Session::has('error'))
<script>
  $(document).ready(function() {
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.error("{{ Session::get("error") }}");
  });
</script>
@endif
{{-- TOASTR NOTIFICATIONS --}}



@endsection
