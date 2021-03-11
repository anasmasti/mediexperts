@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Ajout</h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/plan">Plan formation</a></li>
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
    <h3 class="card-title">Ajout plan formation</h3>
  </div>
  <!-- /.card-header -->
  <form role="form" action="/add-plan" method="POST">
      {{ csrf_field() }}
  <div class="card-body">
    <div class="row">

      @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible col-12">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5><i class="icon fas fa-exclamation-triangle"></i>Erreurs</h5>
          <span>Veuillez vérifier les champs</span>
          <span>{{$errors}}</span>
        </div>
      @endif


      <div class="form-group col-lg-6 col-sm-12">
        <label for="nrc_e">Entreprise</label>
        @if (count($client)==0)
          <a class="btn bu-icon bu-sm btn-sm" href="/add-cl"><i class="fa fa-plus"></i></a> <!--button add-->
        @endif
        <select class="form-control {{ $errors->has('nrc_e') ? 'is-invalid' : '' }}" name="nrc_e" id="nrc_e" value="{{old('nrc_e')}}">
          <option selected disabled class="text-danger">*</option>
          @foreach ($client as $cl)
            <option value="{{$cl->nrc_entrp}}">{{$cl->raisoci}}</option>
          @endforeach
        </select>
        @if (count($client)==0)
          <div class="text-danger txt-sm">Veuillez d'abord ajouter un client</div>
        @endif

          @if ($errors->has('nrc_e'))
            <span class="invalid-feedback" role="alert">
              {{ $errors->first('nrc_e') }}
            </span>
          @endif
      </div>

      {{-- <div class="form-group col-lg-3 col-sm-12"><label>Réference PF</label><input class="form-control {{ $errors->has('refpdf') ? ' is-invalid' : '' }}" value="{{old('refpdf')}}" type="text" name="refpdf" maxlength="30" placeholder="Réf." >
      @if ($errors->has('refpdf'))
        <span class="invalid-feedback" role="alert">
          {{ $errors->first('refpdf') }}
        </span>
      @endif
      </div> --}}

      <div class="form-group col-lg-3 col-sm-12"><label>Année d'exercice</label>
        <input class="form-control  {{ $errors->has('annee') ? ' is-invalid' : 'annee' }} " value="{{old('annee')}}" type="text" name="annee" id="annee" min="4" maxlength="4" onkeypress="return isNumberKey(event)" placeholder="Année">
        @if ($errors->has('annee'))
            <span class="invalid-feedback" role="alert">
            {{ $errors->first('annee') }}
            </span>
        @endif
      </div>




      <div class="form-group col-lg-3 col-sm-12"><label>N° Contrat</label>
        <input class="form-control {{ $errors->has('n_contrat') ? ' is-invalid' : 'n_contrat' }}" value="{{old('n_contrat')}}" type="text" name="n_contrat" id="n_contrat" min="4" maxlength="15" placeholder="N° Contrat">
        @if ($errors->has('n_contrat'))
            <span class="invalid-feedback" role="alert">
            {{ $errors->first('n_contrat') }}
            </span>
        @endif
      </div>

    {{-- <div class="form-group col-12" id="ofpptTitle">
        <h3 class="text-secondary" style="line-height: .5;">OFPPT</h3>
    </div> --}}

        <div class="form-group col-lg-6 col-sm-12" id="divDf3">
            <label>{{----}}</label>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="l_tierpay_PF" id="l_tierpay_PF" class="custom-control-input" value="Préparé">
                    <label for="l_tierpay_PF" class="custom-control-label">Lettre de tiers-payant PF</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="at_approb_PFOPT" id="at_approb_PFOPT" class="custom-control-input" value="Préparé">
                    <label for="at_approb_PFOPT" class="custom-control-label">Attestation d'approbation IF</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="rpt_DS_PFOPT" id="rpt_DS_PFOPT" class="custom-control-input" value="Préparé">
                    <label for="rpt_DS_PFOPT" class="custom-control-label">Attestation d'approbation DS</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="rpt_IF_PFOPT" id="rpt_IF_PFOPT" class="custom-control-input" value="Préparé">
                    <label for="rpt_IF_PFOPT" class="custom-control-label">Rapport IF</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="f2_PFOPT" id="f2_PFOPT" class="custom-control-input" value="Préparé">
                    <label for="f2_PFOPT" class="custom-control-label">Formulaire F2</label>
                </div>
            </div>
        </div>

        <div class="form-group col-lg-6 col-sm-12" id="divDf4">
            <label>{{----}}</label>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="model1_PFOPT" id="model1_PFOPT" class="custom-control-input" value="Préparé">
                    <label for="model1_PFOPT" class="custom-control-label">Modèle 1</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="rib_PFOPT" id="rib_PFOPT" class="custom-control-input" value="Préparé">
                    <label for="rib_PFOPT" class="custom-control-label">RIB</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="f3_PFOPT" id="f3_PFOPT" class="custom-control-input" value="Préparé">
                    <label for="f3_PFOPT" class="custom-control-label">Formulaire F3</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="at_qualif_PFOPT" id="at_qualif_PFOPT" class="custom-control-input" value="Préparé">
                    <label for="at_qualif_PFOPT" class="custom-control-label">Attestation de qualification</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="eligib_cab_PFOPT" id="eligib_cab_PFOPT" class="custom-control-input" value="Préparé">
                    <label for="eligib_cab_PFOPT" class="custom-control-label">Attestation d'éligibilité cabinet</label>
                </div>
            </div>
        </div>


        <div class="form-group col-lg-6 col-sm-12" id="divDf5">
            <label for="accuse_PFOPT">Accusé (Modèle 1)</label>
            <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text">
                    <input type="checkbox" name="accuse_PFOPT" id="accuse_PFOPT" value="Préparé">
                </span>
                </div>
                <input class="form-control {{ $errors->has('dt_accuse_PFOPT') ? ' is-invalid' : 'dt_accuse_PFOPT' }}" value="{{old('dt_accuse_PFOPT')}}" type="text" name="dt_accuse_PFOPT" id="dt_accuse_PFOPT" onmouseover="(this.type='date')" placeholder="Date d'accusation">
                    @if ($errors->has('dt_accuse_PFOPT'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('dt_accuse_PFOPT') }}
                        </span>
                    @endif
            </div>
        </div>

        <div class="form-group col-lg-6 col-sm-12" id="divDf5">
            <label for="dt_recep_ct">Date réception contrat</label>
            <div class="input-group">
                <input class="form-control {{ $errors->has('dt_recep_ct') ? ' is-invalid' : 'dt_recep_ct' }}" value="{{old('dt_recep_ct')}}" type="text" name="dt_recep_ct" id="dt_recep_ct" onmouseover="(this.type='date')" placeholder="Date d'accusation">
                    @if ($errors->has('dt_recep_ct'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('dt_recep_ct') }}
                        </span>
                    @endif
            </div>
        </div>


    <div class="form-group col-12" id="divDf1">

        <table class="table table-sm table-bordered">
            <thead class="thead-light">
                <tr id="header">
                    <th scope="col" style="width:50%">Contrats</th>
                    <th scope="col" class="text-center" style="width:10%">Cabinet</th>
                    <th scope="col" class="text-center" style="width:10%">Client</th>
                    <th scope="col" class="text-center" style="width:10%">OFPPT</th>
                    <th scope="col" class="text-center" style="width:10%">Aucun</th>
                </tr>
            </thead>
            <tbody>
                <!--BEGIN OF : tr-->
                <tr id="tr_ct_PF">
                    <td>Contrat PF</td>
                    <td>
                        <div class="custom-control custom-radio text-center">
                            <input type="radio" name="ct_PF" id="ct_PF_cab" class="custom-control-input" value="cabinet">
                            <label for="ct_PF_cab" class="custom-control-label">&nbsp;</label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-radio text-center">
                            <input type="radio" name="ct_PF" id="ct_PF_cl" class="custom-control-input" value="client">
                            <label for="ct_PF_cl" class="custom-control-label">&nbsp;</label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-radio text-center">
                            <input type="radio" name="ct_PF" id="ct_PF_opt" class="custom-control-input" value="ofppt">
                            <label for="ct_PF_opt" class="custom-control-label">&nbsp;</label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-radio text-center">
                            <input type="radio" name="ct_PF" id="ct_PF_none" class="custom-control-input" value="non préparé" checked>
                            <label for="ct_PF_none" class="custom-control-label">&nbsp;</label>
                        </div>
                    </td>
                </tr>
                <!--END OF : tr-->
            </tbody>
        </table>
        </div>

        <div class="form-group col-lg-6 col-sm-12" id="divDf2"><label for="dt_contrat_PFOPT">Date dépôt contrat PF</label>
            <input class="form-control {{ $errors->has('dt_contrat_PFOPT') ? ' is-invalid' : '' }}" value="{{old('dt_contrat_PFOPT')}}" type="text" name="dt_contrat_PFOPT" onmouseover="(this.type='date')" id="dt_contrat_PFOPT" placeholder="Date dépôt demande">
            @if ($errors->has('dt_contrat_PFOPT'))
                <span class="invalid-feedback" role="alert">
                {{ $errors->first('dt_contrat_PFOPT') }}
                </span>
            @endif
        </div>

        <div class="form-group col-lg-6 col-sm-12"><label>État</label>
            <select class="form-control {{ $errors->has('etat') ? ' is-invalid' : '' }}" name="etat" id="etat" value="{{old('etat')}}">
            <option selected disabled class="text-danger">*</option>
            @php $etat_plan = ['planifié', 'réalisé', 'annulé']; @endphp
            @foreach ($etat_plan as $etat)
                <option value="{{ $etat }}">{{ $etat }}</option>
            @endforeach
            </select>
            @if ($errors->has('etat'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('etat') }}
            </span>
            @endif
        </div>

      <div class="form-group col-12"><label>Commentaire</label>
        <textarea class="form-control" type="text" rows="4" name="commentaire" maxlength="1000" placeholder="Commentaire ..">{{old('commentaire')}}</textarea>
      </div>

    </div><!--./row-->
  </div><!--./card-body-->


  <div class="card-footer text-center">
    <button class="btn bu-add" type="submit" id="add"><i class="fas fa-plus-circle"></i> Ajouter</button>

    <a class="btn bu-danger" href="/plan"><i class="fas fa-window-close"></i> Annuler</a>
  </div>

  </form>

</div><!-- ./CARD -->



{{-- DROP DOWN SCRIPT --}}
<script type="text/javascript">

var nbSelectedPers = 0;
var nbPers = 0;

// function CheckNbPers() {
//   let checkboxPers = document.getElementsByName('personnel');
//   let
// }

$(document).ready(function() {

  //chercher domain dont la ville est la même du "Client" choisi dans "Plan de formation"
  $(document).on('change', '#nrc_e', function() {
    var nrc = $(this).val();

    $.ajax({
      type: 'get',
      url: '{!! URL::to('/finddomaindependvilleclient') !!}',
      data: {'nrc': nrc},
      success: function(data, resp) {
        console.log('success !!');
        console.log(data.data);
        console.log(data.data.length);

        var fillDropDown = '<option selected disabled>Sélectionner le domaine</option>';
        for (var i = 0; i < data.data.length; i++) {
          fillDropDown += '<option value="'+ data.data[i].id_domain + '">' + data.data[i].nom_domain + '</option>';
        }
        if (data.data.length == 0) {
          fillDropDown = '<option selected>veuillez ajouter un domaine avec la ville du client</option>';
        }
        $('#nom_resp').val(data.resp);
        $('#id_dom').html(""); //clear input values
        $('#id_dom').append(fillDropDown);
      },
      error: function(msg) {
        console.log('error getting data !!');
      }
    });
  });

  //chercher le domaine associé au "Thème" choisi dans "Plan de formation"
  $(document).on('change', '#id_dom', function() {
    var idDomain = $(this).val();

    $.ajax({
      type: 'get',
      url: '{!! URL::to('/findthemesdomain') !!}',
      data: {'idDomain': idDomain},
      success: function(data) {
        console.log('success !!');
        console.log(data);

        var fillDropDown = '<option selected disabled>Sélectionner le thème</option>';
        for (var i = 0; i < data.length; i++) {
          fillDropDown += '<option value="'+ data[i].id_theme + '">' + data[i].nom_theme + '</option>';
        }

        $('#bdg_jour').val(data[0].cout); //clear input values
        $('#id_thm').html(""); //clear input values
        $('#id_thm').append(fillDropDown);
      },
      error: function(msg) {
        console.log('error getting data !!');
      }
    });
  });

  //chercher l'organisme avec l'id de l'intervenant
  $(document).on('change', '#id_inv', function() {
    var idInv = $(this).val();

    $.ajax({
      type: 'get',
      url: '{!! URL::to('/findorganismeinterv') !!}',
      data: {'idInv': idInv},
      success: function(data) {
        console.log('success !!');
        console.log(data);

        var fillDropDown = '';
        // var fillDropDown = '<option selected disabled>Sélectionner l\'organisme</option>';
        for (var i = 0; i < data.length; i++) {
        fillDropDown += '<option value="' + data[i].raisoci + '">' + data[i].raisoci + '</option>';
        }
        $('#organisme').html(""); //clear input values
        $('#organisme').append(fillDropDown);
      },
      error:function(msg) {
        console.log('error getting data !!');
      }
    });
  });


});

</script>



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


