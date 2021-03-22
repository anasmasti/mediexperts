@extends('layouts.admin')

@section('content')

@section('content-wrapper')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Avis de modification</h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/print-m3">Imprimer</a></li>
      <li class="breadcrumb-item active"></li>
    </ol>
  </div><!-- /.col -->


@endsection

{{-- jquery scripts --}}
<script src={{ asset('js/jquery.js') }}></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


{{-- jquery scripts --}}


<div class="card card-dark">
  <!-- card-header -->
  <div class="card-header">
    <h3 class="card-title">Annulerr ou modifier l'état d'avis</h3>
  </div><br>
  <!-- /.card-header -->
  <form role="form" action="/add-pf" method="POST">
    {{ csrf_field() }}
    <div class="card-body">
      <div class="row">

        <div class="form-group col-lg-6 col-sm-12">
      <label>Entreprise</label>
      <select class="form-control" id="client" name="client">
        <option selected disabled>---selectionner l'entreprise---</option>
        @foreach ($client as $clt)
        <option value="{{$clt->nrc_entrp}}" > {{$clt->raisoci}} </option>
      @endforeach
      </select>
    </div>

    <div class="form-group col-lg-6 col-sm-12">
      <label>Réference plan de formation </label>
      <select class="form-control" name="plans" id="plans">
        <option selected disabled>---selectionner le plan---</option>
          <option>----</option>
          <option>-----</option>
      </select>
    </div>


    <div class="form-group col-lg-6 col-sm-12">
      <label>État d'avis</label>
      <select class="form-control" id="etat" onkeypress="getSelected()" >
        <option selected disabled>---selectionner l'état---</option>
          <option value="annulation" id="etatAnul">Annulation</option>
          <option value="modification" id="etatModif">Modification</option>
      </select>
    </div>


    <table class="table table-striped col-12 col-lg-6 border" style="margin: 16px">
      <thead>
        <tr>
          <th style="width: 10%" rowspan="6">Avis</th>
          <th style="width: 10%">Anulation</th>
          <th style="width: 10%" colspan="2"> <input type="checkbox" id="annuler"> </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th rowspan="5">Modification</th>
        </tr>
        <tr>
          <th style="width: 5%">De la date de Réalisation</th>
          <th> <input type="checkbox" name="modif" id="modif_a"> </th>
        </tr>
        <tr>
          <th style="width: 5%">De l’organisme de formation</th>
          <th> <input type="checkbox" name="modif" id="modif_b"> </th>
        </tr>
        <tr>
          <th style="width: 5%">De lieu de formation</th>
          <th> <input type="checkbox" name="modif" id="modif_c"> </th>
        </tr>
        <tr>
          <th style="width: 5%">Organisation horaire</th>
          <th> <input type="checkbox" name="modif" id="modif_d"> </th>
        </tr>
      </tbody>
    </table>



    <div class="form-group col-lg-6 col-sm-12">
      <label>Thème de l’action</label>
      <select class="form-control">
        <option selected disabled>---selectionner le thème---</option>
          <option>---</option>
          <option>---</option>
      </select>
    </div>
<div class="form-group col-lg-6 col-sm-12">
<label>Nature de l'action</label>
  <div class="form-group">
  <div class="custom-control custom-checkbox">
      <input type="checkbox" name="planifie" id="planifie" class="custom-control-input" checked>
      <label for="planifie" class="custom-control-label">Planifié</label>
  </div>
  <div class="custom-control custom-checkbox">
    <input type="checkbox" name="nonplanifie" id="nonplanifie" class="custom-control-input">
    <label for="nonplanifie" class="custom-control-label">Non planifié</label>
</div>
<div class="custom-control custom-checkbox">
  <input type="checkbox" name="alpha" id="alpha" class="custom-control-input">
  <label for="alpha" class="custom-control-label">Alpha</label>
</div>
  </div>
</div>


    <div class="form-group col-lg-6 col-sm-12">
          <label>Organisme de formation initial</label>
          <input type="text" name="" id="" class="form-control">
    </div>
    <div class="form-group col-lg-6 col-sm-12">
      <label>Nouvel Organisme de formation</label>
      <select class="form-control">
        <option selected disabled>---selectionner l'organisme---</option>
          <option>-----</option>
          <option>------</option>
      </select>
    </div>


    <div class="form-group col-lg-6 col-sm-12">
      <label>Lieu de formation initial </label>
      <input type="text" name="" id="" class="form-control">
</div>
<div class="form-group col-lg-6 col-sm-12">
  <label>Nouveau lieu</label>
  <select class="form-control">
    <option selected disabled>---selectionner le lieu---</option>
      <option>-----</option>
      <option>------</option>
  </select>
</div>
<!-- {{-- LES DATES INITIALES --}} -->
<div class="form-group col-lg-3 col-md-6 col-12">
  <label>Dates initiales de réalisation </label>
  <input class="form-control" type="date" >
</div>

<div class="form-group col-lg-3 col-md-6 col-12">
  <label>.</label>
  <input class="form-control" type="date" >
</div>

<div class="form-group col-lg-3 col-md-6 col-12">
  <label>.</label>
  <input class="form-control" type="date" >
</div>

<div class="form-group col-lg-3 col-md-6 col-12">
  <label>.</label>
  <input class="form-control" type="date" >
</div>

<!-- {{-- LES NOUVELLES DATES --}} -->
<div class="form-group col-lg-3 col-md-6 col-12">
  <label>Nouvelles Dates exactes de réalisation </label>
  <input class="form-control" type="date" >
</div>

<div class="form-group col-lg-3 col-md-6 col-12">
  <label>.</label>
  <input class="form-control" type="date" >
</div>

<div class="form-group col-lg-3 col-md-6 col-12">
  <label>.</label>
  <input class="form-control" type="date" >
</div>

<div class="form-group col-lg-3 col-md-6 col-12">
  <label>.</label>
  <input class="form-control" type="date" >
</div>

<!-- {{-- L'HORAIRE INITIALE --}} -->


<div class="form-group col-lg-3 col-sm-12">
  <label >Organisation horaire initiale </label>
  </div>

<div class="form-group col-lg-3 col-sm-12">
  <label>Heure début</label>
  <div class='input-group date' id='datetimepicker3'>
    <input class="form-control" type="time" name="hr_debut" />
    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker"></div>
      <div class="input-group-text"><i class="far fa-clock"></i></div>
    </div>
  </div>

  <div class="form-group col-lg-3 col-sm-12">
    <label>Heure fin</label>
    <div class='input-group date' id='datetimepicker3'>
      <input class="form-control timerpicker" type="time" name="hr_fin" />
      <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker"></div>
        <div class="input-group-text"><i class="far fa-clock"></i></div>
      </div>
    </div>
</div>



<!-- L'HORAIRE Modifié -->
<div class="row">
<div class="form-group col-lg-3 col-sm-12 d-flex">
  <label >Nouvelle organisation horaire </label>
  </div>


  <div class="form-group col-lg-3 col-sm-12">
    <label>Heure début</label>
    <div class='input-group date' id='datetimepicker3'>
      <input class="form-control" type="time" name="hr_debut" />
      <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker"></div>
        <div class="input-group-text"><i class="far fa-clock"></i></div>
      </div>
    </div>
    <!-- {{--  --}} -->
    <div class="form-group col-lg-3 col-sm-12">
      <label>Heure fin</label>
      <div class='input-group date' id='datetimepicker3'>
        <input class="form-control timerpicker" type="time" name="hr_fin" />
        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker"></div>
          <div class="input-group-text"><i class="far fa-clock"></i></div>
        </div>
      </div>
  </div>
</div>








  <!-- {{-- <input class="form-control" type="date" >
  <input class="form-control" type="date" >
  <input class="form-control" type="date" > --}} -->






<div class="card-footer text-center">

        <a href="/print-m3" class="btn btn-info"><i class="fa fa-print"></i>&nbsp;Imprimer</a>
</div>

  </form>

</div><!-- ./CARD -->



<script>


$(document).ready(function () {

$('#client').on('change', function() {
  let nrc = $('#client').val();
  let fillDropdown = '';
  $.get('/fill-plan-by-client', {'nrc': nrc})
    .done((data) => {
      console.log("success action !!", data);
      data.forEach(elem => {
        fillDropdown += `<option value="${elem.id_plan}"> ${elem.refpdf}  </option>`;
      });
      // affecter les données dans select
      $('#plans').html("");
      if (data.length) {
        $('#plans').append('<option selected disabled>--sélectionner une action</option>');
        $('#plans').append(fillDropdown);
      }
      else {
        $('#plans').append('<option selected disabled>(vide) aucune action</option>');
      }
    }) //done
    .catch(err => console.log("error getting actions !!", error));
});
$('#plans').on('change', function() {
      let idPlan = $('#plans').val();
      let fillDropdown = '';
      $.get('/fill-action-form', {'idPlan': idPlan})
        .done((data) => {
          console.log("success action !!", data);
          data.forEach(elem => {
            fillDropdown += `<option value="${elem.n_form}">${elem.n_action} > ${elem.nom_theme} </option>`;
          });
          // affecter les données dans select
          $('#action').html("");
          if (data.length) {
            $('#action').append('<option selected disabled>--sélectionner une action</option>');
            $('#action').append(fillDropdown);
          }
          else {
            $('#action').append('<option selected disabled>(vide) aucune action</option>');
          }
        }) //done
        .catch(err => console.log("error getting actions !!", error));
    });

    $('#action').on('change', function() {
      $('#listPersonnel').html("") //vider la liste à chaque sélection
      $('#dates').html(""); //vider la liste à chaque sélection
      let nForm = $('#action').val();
      $.ajax({
        type: 'GET',
        url : '{!! URL::to('/fill-form-f4') !!}', //on peut utiliser l'url du formulaire 4, ça donne le même resultat
        data: {'nForm': nForm},
        success: function(data) {
          let fillFormation = '<option selected disabled>--veuillez sélectionner la formation</option>';
          console.log('success formations !!', data);
          if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
              fillFormation += `<option value="`+data[i].id_form+`">`+data[i].nom_theme+`</option>`;
            }
            $('#formation').html("");
            $('#formation').append(fillFormation);
          }
          else {
            $('#formation').html("");
            $('#formation').append('<option selected disabled>(vide) aucune formation</option>');
          }
        },
        error: function(err) { console.log("error getting formations !!", err); }
      }); //ajax
    });





  // function getSelected(){
  //   var etatAnul = Document.getElementById('etatAnul').selected;
  //   //var etatModif = Document.getElementById('etatModif').selected;
  //   var annul=Document.getElementById('annuler').disabled;
  //   var chk_a=Document.getElementById('a').disabled;
  //   var chk_b=Document.getElementById('b').disabled;
  //   var chk_c=Document.getElementById('c').disabled;
  //   var chk_d=Document.getElementById('d').disabled;
  //   var
  //   if(etatAnul)
  //   {
  //     chk_a=true;
  //     chk_b=true;
  //     chk_c=true;
  //     chk_d=true;
  //     annul.checked;
  //   }
  //   else{
  //     annul=true;
  //   }
  //  }

  </script>









@endsection


