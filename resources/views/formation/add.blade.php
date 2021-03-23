@extends('layouts.admin')

@section('content')


@section('content-wrapper')
  <div class="col-sm-6">
    <h1 class="m-0 text-dark">Ajout</h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/formation">Formation</a></li>
      <li class="breadcrumb-item active">Ajout</li>
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
    <h3 class="card-title">Ajout Formation</h3>
  </div>
  <!-- /.card-header -->
  <form role="form" action="/add-form" method="POST" enctype="multipart/form-data">
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

      <div class="form-group col-lg-6 col-sm-12">
        <label for="n_form">Action de formation<span>&nbsp;<i class="fas fa-tag"></i></span></label>
        @if (count($plan)==0)
          <a class="btn bu-icon bu-sm btn-sm" href="/add-pf"><i class="fa fa-plus"></i></a>
        @endif
        <select class="form-control {{ $errors->has('n_form') ? 'is-invalid' : '' }}" name="n_form" id="n_form" value="{{old('n_form')}}">
          <option selected disabled>{{--selection--}}</option>
          {{-- @foreach ($plan as $pf)
            @foreach ($client as $cl)
              @if ($cl->nrc_entrp == $pf->nrc_e)
                @php $nom_client = $cl->raisoci; @endphp
                @php $nbjour = $pf->nb_jour; @endphp
              @endif
            @endforeach
            <option value="{{$pf->n_form}}">{{$pf->domaine}} > {{$nom_client}}</option>
          @endforeach --}}
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

      <div class="form-group col-lg-6 col-12">
        <label for="id_inv">Intervenant</label>
        @if (count($interv)==0)
          <a class="btn bu-icon bu-sm btn-sm" href="/add-inv"><i class="fa fa-plus"></i></a> {{--button add--}}
        @endif
        <select class="form-control {{ $errors->has('id_inv') ? 'is-invalid' : '' }}" name="id_inv" id="id_inv" value="{{old('id_inv')}}">
          <option selected disabled>{{--vide--}}</option>
          @php $nbIntervAvailable = 0; @endphp
          @foreach ($interv as $inv)
            {{-- @if (mb_strtolower($inv->etat) == "occupé") --}}
              {{-- <option disabled value="{{$inv->id_interv}}">{{$inv->nom}} {{$inv->prenom}} (occupé)</option> --}}
            {{-- @else --}}
              <option value="{{$inv->id_interv}}">{{$inv->nom}} {{$inv->prenom}}</option>
              @php $nbIntervAvailable += 1; @endphp
            {{-- @endif --}}
          @endforeach
        </select>
        @if (count($interv)==0)
        <div class="text-danger txt-sm">Veuillez d'abord ajouter un intervenant</div>
        @endif
        @if ($nbIntervAvailable == 0)
        <div class="text-danger txt-sm"><a href="/add-inv">
          Aucun intervenant n'est disponible. Souhaitez-vous l'ajouter ?</a></div>
        @endif

          @if ($errors->has('id_inv'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('id_inv') }}
          </span>
          @endif
      </div>

      {{-- <div class="form-group col-lg-3 col-sm-12"><label>ID formation</label>
        <input class="form-control {{ $errors->has('id_form') ? 'is-invalid' : '' }}" type="text" value="{{rand(1, 10000000)}}" name="id_form" min="0" maxlength="20" placeholder="ID Formation" readonly>
      </div> --}}

      <div class="form-group col-lg-3 col-sm-12">
        <label>Groupe</label>
        <select class="form-control {{ $errors->has('groupe') ? 'is-invalid' : '' }}" value="{{old('groupe')}}" id="groupe" name="groupe">
          <option selected disabled>*</option>
          {{-- @php
            $maxgroup = $formation['nb_grp'];
          @endphp
          @for ($i = 1; $i <= $maxgroup; $i++)
            <option value="{{ $g }}">{{ $g }}</option>
          @endfor --}}
        </select>
        @if ($errors->has('groupe'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('groupe') }}</strong>
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-sm-12"><label>Nb. bénificiaire</label>
        <input class="form-control {{ $errors->has('nb_benif') ? 'is-invalid' : '' }}" type="text" value="{{old('nb_benif')}}" name="nb_benif" id="nb_benif" min="0" maxlength="3" onkeypress="return isNumberKey(event)" placeholder="nb bénif.">
        @if ($errors->has('nb_benif'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('nb_benif') }}</strong>
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-sm-12">
        <label>Heure début</label>
        <div class='input-group date'>
          <input class="form-control {{ $errors->has('hr_debut') ? 'is-invalid' : '' }}" value="{{old('hr_debut') ? old('hr_debut') : "09:00"}}" type="time" name="hr_debut" />
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
          <input class="form-control timerpicker {{ $errors->has('hr_fin') ? 'is-invalid' : '' }}" value="{{old('hr_fin') ? old('hr_fin') : "16:00"}}" type="time" name="hr_fin" />
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
        <div class='input-group date' id='datetimepicker3'>
          <input class="form-control timerpicker {{ $errors->has('pse_debut') ? 'is-invalid' : '' }}" value="{{old('pse_debut') ? old('pse_debut') : "12:30"}}" type="time" name="pse_debut" />
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
        <div class='input-group date' id='datetimepicker3'>
          <input class="form-control timerpicker {{ $errors->has('pse_fin') ? 'is-invalid' : '' }}" value="{{old('pse_fin') ? old('pse_fin') : "13:30"}}" type="time" name="pse_fin" />
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

    <div class="row" id="datesInput">
      {{-- here where date inputs will appear --}}
    </div><!--./row-->

    {{-- <i class="fa fa-plus-circle text-warning" id="addDateInput" style="font-size: 24px; cursor: pointer;">
    </i> --}}

    <div class="row">
      <div class="form-group col-12"><!--**************HR**************--><hr></div>
    </div>

    <div class="row" id="personnelsInput">
      {{-- here where personnel inputs will appear --}}
    </div><!--./row-->


    <div class="row">
      <div class="form-group col-12">
        <label>Commentaire</label>
        <textarea class="form-control" type="text" rows="3" name="commentaire" maxlength="3000" placeholder="Commentaire ..">{{old('commentaire')}}</textarea>
      </div>
    </div>

  </div><!--./card-body-->

  <div class="card-footer text-center">
    <button class="btn bu-add" type="submit" id="add"><i class="fas fa-plus-circle"></i>&nbsp;Ajouter</button>
    <a class="btn bu-danger" href="/formation"><i class="fas fa-window-close"></i>&nbsp;Annuler</a>
  </div>
</form>

</div><!-- ./CARD -->



<script>

    // VerifyGroupe = async (data, nForm) => {
    //     var fillDropDownGrp = "";
    //     for (let grp = 1; grp <= data[0].nb_grp; grp++) {
    //     $.get("/verify-groupe", {'nForm': nForm, 'grp': grp})
    //         .done((data) => {
    //             console.log("groupe : ", data);
    //             if (data.groupe != grp) {fillDropDownGrp += '<option value="'+ grp +'">'+ grp +'</option>';}
    //             else {fillDropDownGrp += '<option selected disabled>'+ grp +'</option>';}
    //         });
    //     }
    //     return fillDropDownGrp;
    // }

  //chercher le nom d'entreprise, nom domaine/theme associé au Plan de Formation
  $(document).ready(function() {

    // $('#addDateInput').click(function() {
    //   var selDatesInput = document.querySelectorAll('.formation-date');
    //   var lastIndex = selDatesInput.length + 1;
    //   if (lastIndex <= 30) {
    //     var newInput =
    //     `<div class="form-group col-lg-3 col-sm-12">
    //       <label for="date${lastIndex}">Jour ${lastIndex}</label>
    //       <input class="form-control {{ $errors->has('date${lastIndex}') ? 'is-invalid' : '' }} formation-date" type="text" value="" name="date${lastIndex}" onmouseover="(this.type='date')" placeholder="date${lastIndex}" >
    //       @if ($errors->has('date${lastIndex}'))
    //         <span class="invalid-feedback" role="alert">
    //           <strong>{{ $errors->first('date${lastIndex}') }}</strong>
    //         </span>
    //       @endif
    //     </div>`;
    //     $('#datesInput').append(newInput);
    //   } else {
    //     $('#addDateInput').prop('disabled', true);
    //   }
    // });

    var nForm = $('#n_form').val();
    $.ajax({
      type: 'get',
      url: '{!! URL::to('/findplanformationprops') !!}',
      data: {'nForm': nForm},
      success: function(data) {
        console.log('success PlanFormation props !!');
        console.log(data);

        var fillDropDown = '<option selected disabled>Sélectionner le plan de formation</option>';
        for (var i = 0; i < data.length; i++) {
          fillDropDown += '<option value="' + data[i].n_form + '">' + data[i].raisoci + ' > ' + data[i].nom_theme + '</option>';
        }
        $('#n_form').html(""); //clear input values
        $('#n_form').append(fillDropDown);
      },
      error: function(msg) {
        console.log('error getting plan data !!');
      }
    }); //ajax

  //chercher le nb de jours associé au "action de formation" choisi dans "Formations"
  $(document).on('change', '#n_form', function() {
    // $('#add').show(100);
    var nForm = $(this).val();
    //---------- dates ----------
    var datesInput = $('#datesInput');
    $.ajax({
      type: 'get',
      url: '{!! URL::to('/findnbjours') !!}',
      data: {'nForm': nForm},
      success: function(data) {
        console.log('success find nb jour !!', data);
        var createDateInput = '';
        for (var i = 1; i <= data[0].nb_jour; i++) {
            let date_debut_fin = "";
            if (i === 1) {
                // affecter la date de début de l'action de formation
                date_debut_fin = data[0].dt_debut;
            }
            else if (i == data[0].nb_jour) {
                // ou affecter la date de début de l'action de formation
                date_debut_fin = data[0].dt_fin;
            }
            createDateInput +=
                `<div class="form-group col-lg-3 col-sm-12">
                <label for="date${i}">Jour ${i}</label>
                <input class="form-control {{ $errors->has('date${i}') ? 'is-invalid' : '' }} formation-date" type="text" value="${date_debut_fin}" name="date${i}" onmouseover="(this.type='date')" placeholder="date${i}" >
                  @if ($errors->has('date${i}'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('date${i}') }}</strong>
                    </span>
                  @endif
                </div>`;
        }
        // si l'action a un seul groupe of affect le nombre total au nombre de bénéficiaires
        if (data[0].nb_grp == 1) {
          $('#nb_benif').val(data[0].nb_partcp_total);
        }
        $('#datesInput').html(""); //clear input values
        $('#datesInput').append(createDateInput);

        var fillDropDownGrp = "";

        for (let grp = 1; grp <= data[0].nb_grp; grp++) {
          $.get("/verify-groupe", {'nForm': nForm, 'grp': grp})
            .done((data) => {
                console.log("groupe : ", data);
                if (data.groupe != grp) {fillDropDownGrp += '<option value="'+ grp +'">'+ grp +'</option>';}
                else {fillDropDownGrp += '<option disabled>'+ grp +' déjà défini</option>';}

                $('#groupe').html("");
                $('#groupe').append(fillDropDownGrp);
                console.log('fillDropDownGrp', fillDropDownGrp);
            });
        }
      },
      error: function(err) { console.log('error getting dates !!', err); }
    }); //ajax fun 1
    //---------- personnels ----------
    var personnelsInput = $('#personnelsInput');
    var titleSection = `<span class="col-12 text-lg bg-dark p-2 mb-3">Sélectionner les personnels pour cette formation</span>`;
    $.ajax({
      type: 'GET',
      url: '{!! URL::to('/findpersonnel') !!}',
      data: {'nForm': nForm},
      success: function(data) {
        console.log('success personnel !!', data);

        var grabData = "";
        if (Object.keys(data).length > 0) {
          for (let i = 0; i < data.length; i++) {
            grabData +=
            `<div class="form-group col-lg-4 col-sm-6">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="cin[]" id="${data[i]["cin"]}" class="custom-control-input" value="${data[i]["cin"]}">
                <label for="${data[i]["cin"]}" class="custom-control-label">${data[i]["nom"]} ${data[i]["prenom"]} ${data[i]["fonction"]}</label>
              </div>
            </div>`;
          }
        }
        else {
          // Afficher un message d'erreur si la liste des personnels est vide
          grabData = `<div class="alert alert-danger col" role="alert">
                      Liste des personnels est vide pour cette entreprise. Voici des suggestions : <br>
                      <a href="/import"><i class="fas fa-upload"></i> Importer une liste</a><br>
                      <a href="/add-pers"><i class="fas fa-plus"></i>Ajouter des personnels</a>
                    </div>`;
          $('#add').prop('disabled', false); //désactiver button 'ajouter' si liste personnel est vide
        }
        personnelsInput.html("");
        personnelsInput.append(titleSection);
        personnelsInput.append(grabData);
      },
      error: function(error) {
        console.log('error getting personnels');
      },
    }); //ajax fun 2
  }); //onChange


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
