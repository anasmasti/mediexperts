@extends('layouts.admin')

@section('content')


  {{-- @foreach($plan as $pf)
    @if($pf->n_form==$formation->n_form)
      @php $nform = $pf->n_form @endphp
      @php $module = $pf->module @endphp
      @php $lieu = $pf->lieu @endphp
    @endif
  @endforeach --}}


@section('content-wrapper')
  <div class="col-sm-6">
    <h1 class="m-0 text-dark">Formation</h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/formation">Formation</a></li>
      <li class="breadcrumb-item active">Modifier formation N° {{ $formation->id_form }}</li>
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
  <div class="card-header">
    <h3 class="card-title">Formation N° {{$formation->id_form}} > {{ $formation["nom_theme"] }} > {{ $formation["raisoci"] }}</h3>
  </div>
  <!-- /.card-header -->
  <form role="form" action="/edit-form/{{$formation->id_form}}" method="POST" enctype="multipart/form-data">
  <div class="card-body">
    <div class="row">
      {{ csrf_field() }}

      @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible col-12">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5><i class="icon fas fa-exclamation-triangle"></i>Erreurs</h5>
          <span>Veuillez vérifier les champs</span>
          <span>{{$errors}}</span>
        </div>
      @endif

      <div class="form-group col-12">
        <label for="n_form">Plan formation<i class="fas fa-tag icon"></i></label>
        <select class="form-control {{ $errors->has('n_form') ? 'is-invalid' : '' }}" id="n_form" name="n_form" value="{{$formation->n_form}}" readonly>
          <option selected disabled>{{--selection--}}</option>
          @foreach ($plan as $pf)
            <option {{$formation["n_form_fk"]==$pf->n_form ? 'selected' : ''}} value="{{$pf->n_form}}">Plan N° {{$pf->n_form}} {{" > "}} {{$pf["nom_theme"]}} {{" > "}} {{$pf["raisoci"]}}</option>
          @endforeach
        </select>
        @if (count($plan)==0)
          <div class="text-danger txt-sm">Veuillez ajouter un plan de formation</div>
        @endif
          @if ($errors->has('n_form'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('n_form') }}</strong>
            </span>
          @endif
      </div>



      <div class="form-group col-lg-6 col-md-6 col-12">
          <label for="id_inv">Intervenant</label>
          <select class="form-control {{ $errors->has('id_inv') ? 'is-invalid' : '' }}" name="id_inv" id="id_inv" value="{{$formation->id_inv}}">
              <option selected disabled>{{--vide--}}</option>
              @foreach ($interv as $inv)
                  @if ($formation->id_inv == $inv->id_interv)
                  {{-- @if ($formation->id_inv == $inv->id_interv && mb_strtolower($inv->etat) == "occupé") --}}
                      <option selected value="{{$inv->id_interv}}">{{$inv->nom}} {{$inv->prenom}} @if (mb_strtolower($inv->etat) == "occupé") {{"(occupé pour cette mission)"}} @endif</option>
                  {{-- @elseif ($formation->id_inv != $inv->id_interv && mb_strtolower($inv->etat) == "occupé") --}}
                  {{-- @elseif ($formation->id_inv != $inv->id_interv)
                      <option disabled value="{{$inv->id_interv}}">{{$inv->nom}} {{$inv->prenom}} (occupé)</option> --}}
                  @else
                      <option value="{{$inv->id_interv}}">{{$inv->nom}} {{$inv->prenom}}</option>
                  @endif
              @endforeach
          </select>
          @if ($errors->has('id_inv'))
          <span class="invalid-feedback" role="alert">
              {{ $errors->first('id_inv') }}
          </span>
          @endif
      </div>

      {{-- <div class="form-group col-lg-3 col-sm-12"><label>ID Formation</label>
        <input class="form-control {{ $errors->has('id_form') ? 'is-invalid' : '' }}" value="{{$formation->id_form}}" type="text" id="id_form" name="id_form" min="0" maxlength="20" placeholder="ID formation" readonly>
      </div> --}}
      <input type="hidden" name="id_form" id="id_form" value="{{$formation->id_form}}">

      <div class="form-group col-lg-3 col-sm-12">
        <label>Groupe</label>
        <select class="form-control {{ $errors->has('groupe') ? 'is-invalid' : '' }}" value="{{$formation->groupe}}" id="groupe" name="groupe" value="{{$formation->groupe}}" readonly>
          @php
            $maxgroup = $formation['nb_grp'];
          @endphp
          @for ($i = 1; $i <= $maxgroup; $i++)
            @if ($formation->groupe == $i)
                <option selected value="{{ $i }}">{{ $i }}</option>
            @else
                <option value="{{ $i }}">{{ $i }}</option>
            @endif
          @endfor
        </select>
        @if ($errors->has('groupe'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('groupe') }}</strong>
          </span>
        @endif
      </div>


      <div class="form-group col-lg-3 col-sm-12"><label>Nb. bénificiaire</label>
        <input class="form-control {{ $errors->has('nb_benif') ? 'is-invalid' : '' }}" type="text" value="{{$formation->nb_benif}}" id="nb_benif" name="nb_benif" min="0" maxlength="3" onkeypress="return isNumberKey(event)" placeholder="nb bénif.">
        @if ($errors->has('nb_benif'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('nb_benif') }}</strong>
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-sm-12">
        <label>Heure début</label>
        <div class='input-group date'>
          <input class="form-control timerpicker {{ $errors->has('hr_debut') ? 'is-invalid' : '' }}" value="{{$formation->hr_debut}}" type="text" id="hr_debut" name="hr_debut" />
          <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="far fa-clock"></i></div>
          </div>
        </div>
        @if ($errors->has('hr_debut'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('hr_debut') }}</strong>
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-sm-12">
        <label>Heure fin</label>
        <div class='input-group date'>
          <input class="form-control timerpicker {{ $errors->has('hr_fin') ? 'is-invalid' : '' }}" value="{{$formation->hr_fin}}" type="text" id="hr_fin" name="hr_fin" />
          <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="far fa-clock"></i></div>
          </div>
        </div>
        @if ($errors->has('hr_fin'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('hr_fin') }}</strong>
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-sm-12">
        <label>Pause début</label>
        <div class='input-group date'>
          <input class="form-control timerpicker {{ $errors->has('pse_debut') ? 'is-invalid' : '' }}" value="{{$formation->pse_debut}}" type="text" id="pse_debut" name="pse_debut" />
          <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="far fa-clock"></i></div>
          </div>
        </div>
        @if ($errors->has('pse_debut'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('pse_debut') }}</strong>
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-sm-12">
        <label>Pause fin</label>
        <div class='input-group date'>
          <input class="form-control timerpicker {{ $errors->has('pse_fin') ? 'is-invalid' : '' }}" value="{{$formation->pse_fin}}" type="text" id="pse_fin" name="pse_fin" />
          <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="far fa-clock"></i></div>
          </div>
        </div>
        @if ($errors->has('pse_fin'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('pse_fin') }}</strong>
          </span>
        @endif
      </div>

    </div><!--./row-->


    {{--   .-******         .-***       .-********   .-********    --}}
    {{--   .-**    **      .-** **         .-**      .-**          --}}
    {{--   .-**     **    .-**   **        .-**      .-******      --}}
    {{--   .-**    **    .-*********       .-**      .-**          --}}
    {{--   .-******     .-**       **      .-**      .-********    --}}

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
    <div class="row" id="datesInput">
      <div class="form-group col-12"><!--**************HR**************--><hr></div>
      {{-- @for ($i = 0; $i < count($dates); $i++)
        <div class="form-group col-lg-3 col-sm-12">
          <label for="{{$dates[$i]}}">
            @php $jour_numero = (int) filter_var($dates[$i], FILTER_SANITIZE_NUMBER_INT); @endphp
            {{ substr_replace($dates[$i], "Jour", -6)." ".$jour_numero}}
          </label>
          <input class="form-control {{$errors->has($dates[$i]) ? 'is-invalid' : ''}}" type="date" value="{{$formation->$dates[$i]}}" name="{{$dates[$i]}}" onmouseover="(this.type='date')" placeholder="{{$dates[$i]}}">
            @if ($errors->has($dates[$i]))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first($dates[$i]) }}</strong>
              </span>
            @endif
          </div>
      @endfor --}}
    </div>

    <div class="row">
      <div class="form-group col-12"><!--**************HR**************--><hr></div>
    </div>

    <div class="row" id="personnelsInput">
      {{-- <span class="col-12 text-lg bg-dark p-2 mb-3">Modifier les personnels pour cette formation</span>
      @for ($i = 0; $i < count($personnel); $i++)
        <div class="col-lg-4 col-sm-6">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="cin[]" id="{{$personnel[$i]['cin']}}" class="custom-control-input" value="{{$personnel[$i]['cin']}}">
            <label for="{{$personnel[$i]['cin']}}" class="custom-control-label">{{$personnel[$i]['cin']}} {{$personnel[$i]['nom']}} {{$personnel[$i]['prenom']}}</label>
          </div>
        </div>
      @endfor --}}
    </div><!--./row-->

    <div class="row">
      <div class="form-group col-12"><!--**************HR**************--><hr></div>
    </div>

    <div class="row">
      <div class="form-group col-12">
        <label>Commentaire</label>
        <textarea class="form-control" type="text" rows="2" name="commentaire" maxlength="3000" placeholder="Commentaire ..">{{$formation['comment_form']}}</textarea>
      </div>
    </div>

  </div><!--./card-body-->
  <div class="card-footer text-center">
    <button class="btn bu-add" type="submit" id="add"><i class="fas fa-edit"></i>&nbsp;Modifier</button>
    <a class="btn bu-danger" href="/intervenant"><i class="fas fa-window-close"></i>&nbsp;Annuler</a>
  </div>

  </form>


</div><!-- ./CARD -->

<script>
$(document).ready(function() {

  // APPELER LES FONCTIONS EN ORDRE
  MakeInputDates();
  FindPersonnel();
  FindPersonnelFormation();
  // FindPersonnelFormationDeja();

  function MakeInputDates() {
    var datesInput = $('#datesInput');
    var nForm = $('#n_form').val();
    var nbJour = 0;
    $.ajax({
      type: 'get',
      url: '{!! URL::to('/findnbjours') !!}',
      data: {'nForm': nForm},
      success: function(data) {
        console.log('success nb_jour !!');
        console.log(data);
        nbJour = data[0].Nombre_Dates;
      },
      error: function(msg) { console.log('error getting nb_jour !!'); }
    }); //ajax
    //chercher le nb de jours associé au "Plan de formation" choisi dans "Formations"
    $.ajax({
        type: 'get',
        url: '{!! URL::to('/finddates') !!}',
        data: {'nForm': nForm},
        success: function(data) {
          console.log('success dates !!');
          console.log(data);
          var createDateInput = '';
          for (var i = 1; i <= nbJour; i++) {
            createDateInput +=
            `<div class="form-group col-lg-3 col-sm-12">
            <label for="date`+i+`">Date `+i+`</label>
            <input class="form-control {{ $errors->has('date`+i+`') ? 'is-invalid' : '' }}" type="date" value="`+data[0]["date"+i]+`" name="date`+i+`" onmouseover="(this.type='date')" placeholder="date`+i+`" >
              @if ($errors->has('date`+i+`'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('date`+i+`') }}</strong>
                </span>
              @endif
            </div>`;
        }
        $('#datesInput').html(""); //clear input values
        $('#datesInput').append(createDateInput);
      },
      error: function(msg) { console.log('error getting dates !!'); }
    }); //ajax
  }

  $('#n_form').on('change', function() {
    MakeInputDates();
  });

  function FindPersonnel() {
    //---------- personnels ----------
    var nForm = $('#n_form').val();
    var personnelsInput = $('#personnelsInput');
    var titleSection = `<span class="col-12 text-lg bg-dark p-2 mb-3">Sélectionner les personnels pour cette formation</span>`;
    $.ajax({
      type: 'GET',
      url: '{!! URL::to('/findpersonnel') !!}',
      data: {'nForm': nForm},
      success: function(data) {
        console.log('success personnel !!', data);
        var grabData = "";
        for (let i = 0; i < data.length; i++) {
          grabData +=
          `<div class="form-group col-lg-4 col-sm-6">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="cin[]" id="`+data[i]["cin"]+`" class="custom-control-input" value="`+data[i]["cin"]+`">
            <label for="`+data[i]["cin"]+`" class="custom-control-label">`+data[i]["nom"]+' '+data[i]["prenom"]+'<br>'+ data[i]["fonction"]+`</label>
          </div>
          </div>`;
        }
        personnelsInput.html("");
        personnelsInput.append(titleSection);
        personnelsInput.append(grabData);
      },
      error: function(error) { console.log('error getting personnels'); },
    }); //ajax fun 2
  } //fun

  function FindPersonnelFormation() {
    setTimeout(() => {
        var idForm = $('#id_form').val();
        $.ajax({
        type: 'GET',
        url: '{!! URL::to('/findpersonnelformation') !!}',
        data: {'idForm': idForm},
        success: function(data) {
            console.log("success form pers !!", data);
            for (let i = 0; i < data.length; i++) {
            let cin = data[i]['cin'];
            let targetCheckbox = document.getElementById(cin);
            // if (targetCheckbox) {
                // targetCheckbox.prop("checked", true);
                targetCheckbox.checked = true;
            // }
            } //endfor
        },
        error: function(error) { console.log("error : ", error); }
        });
    }, 400);
  }

  function FindPersonnelFormationDeja() {
    setTimeout(() => {
        var idForm = $('#id_form').val();
        var nForm = $('#n_form').val();
        console.log(" idForm : " + idForm + ",nForm : " + nForm);
        $.ajax({
        type: 'GET',
        url: '{!! URL::to('/find-personnel-formation-deja') !!}',
        data: {'idForm': idForm, 'nForm': nForm},
        success: function(data) {
            console.log("success personnel deja !!", data);
            for (let i = 0; i < data.length; i++) {
                let cin = data[i]['cin'];
                let targetCheckbox = document.getElementById(cin);
                targetCheckbox.disabled = true;
            } //endfor
        },
        error: function(error) { console.log("error : ", error); }
        });
    }, 700);
  }

}); //ready

</script>

{{-- TOASTR NOTIFICATIONS --}}
@if (Session::has('added'))
<script>
  $(document).ready(function() {
    toastr.options.progressBar = true;
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.success("{{ Session::get("added") }}", {timeOut: 10000});
  });
</script>
@endif
@if (Session::has('updated'))
<script>
  $(document).ready(function() {
    toastr.options.progressBar = true;
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.success("{{ Session::get("updated") }}", {timeOut: 10000});
  });
</script>
@endif
@if (Session::has('deleted'))
<script>
  $(document).ready(function() {
    toastr.options.progressBar = true;
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.success("{{ Session::get("deleted") }}", {timeOut: 10000});
  });
</script>
@endif
@if (Session::has('success'))
<script>
  $(document).ready(function() {
    toastr.options.progressBar = true;
    toastr.options.timeOut = 0;
    toastr.options.extendedTimeOut = 0;
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
    toastr.options.progressBar = true;
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.options.timeOut = 0;
    toastr.options.extendedTimeOut = 0;
    toastr.warning("{{ Session::get("warning") }}");
  });
</script>
@endif
@if (Session::has('info'))
<script>
  $(document).ready(function() {
    toastr.options.progressBar = true;
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.options.timeOut = 0;
    toastr.options.extendedTimeOut = 0;
    toastr.info("{{ Session::get("info") }}");
  });
</script>
@endif
@if (Session::has('error'))
<script>
  $(document).ready(function() {
    toastr.options.progressBar = true;
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.options.timeOut = 0;
    toastr.options.extendedTimeOut = 0;
    toastr.error("{{ Session::get("error") }}");
  });
</script>
@endif
{{-- TOASTR NOTIFICATIONS --}}



@endsection
