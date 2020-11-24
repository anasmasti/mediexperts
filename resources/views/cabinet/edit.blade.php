@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Cabinet</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/cabinet">Cabinet</a></li>
        <li class="breadcrumb-item active">{{ $cabinet->raisoci }}</li>
    </ol>
</div>
@endsection


{{-- jquery scripts --}}
<script src={{ asset('js/jquery.js') }}></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
{{-- jquery scripts --}}


<!-- CARD -->
<div class="card card-dark">
    <!-- card-header -->
    <div class="card-header">
        <h3 class="card-title">Modifier&nbsp;{{ $cabinet->raisoci }}</h3>
    </div>
    <!-- /.card-header -->
    <form role="form" action="/edit-cab/{{ $cabinet->nrc_cab }}" method="POST">
        {{ csrf_field() }}

        <div class="card-body">
            <div class="row">

            @if (session()->has('warning'))
                <div class="alert alert-warning alert-dismissible col-12">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i>Succès</h5>
                    <span>Associer des intervenants !<br>
                        <a class="text-info" href="/add-inv">&nbsp;<span><i class="fas fa-plus-circle"></i>&nbsp;Ajouter des intervenant</span></a>
                    </span>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible col-12">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Erreurs</h5>
                    <span>Veuillez vérifier les champs</span>
                    {{-- <span>{{$errors}}</span> --}}
                </div>
            @endif

            <div class="form-group col-lg-3 col-sm-12"><label>N° RC cabinet</label>
                <input class="form-control {{ $errors->has('nrc_cab') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->nrc_cab}}" name="nrc_cab"  min="0" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="N°" >
                @if ($errors->has('nrc_cab'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nrc_cab') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-9 col-sm-12"><label>Raison social</label>
                <input class="form-control {{ $errors->has('raisoci') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->raisoci}}" name="raisoci" maxlength="50" placeholder="raison social" >
                @if ($errors->has('raisoci'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('raisoci') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group col-lg-3 col-sm-12"><label>Forme juridique</label>
                <input class="form-control {{ $errors->has('formjury') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->formjury}}" name="formjury" maxlength="50" placeholder="forme juridique" >
                @if ($errors->has('formjury'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('formjury') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-3 col-sm-12"><label>Capital social</label>
                <input class="form-control {{ $errors->has('cap_soci') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->cap_soci}}" name="cap_soci" min="0" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="en DH" >
                @if ($errors->has('cap_soci'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('cap_soci') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group col-lg-3 col-sm-12"><label>Date création</label>
                <input class="form-control {{ $errors->has('dt_creat') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->dt_creat}}" name="dt_creat" onmouseover="(this.type='date')" placeholder="date" >
                @if ($errors->has('dt_creat'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('dt_creat') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group col-12">{{--**************HR**************--}}<hr></div>

            <div class="form-group col-lg-4 col-sm-12"><label>Domaine de compétence 1</label>
                <input class="form-control {{ $errors->has('dom_compet1') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->dom_compet1}}" name="dom_compet1" maxlength="50" placeholder="" >
                @if ($errors->has('dom_compet1'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('dom_compet1') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group col-lg-4 col-sm-12"><label>Domaine de compétence 2</label>
                <input class="form-control {{ $errors->has('dom_compet2') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->dom_compet2}}" name="dom_compet2" maxlength="50" placeholder="" >
                @if ($errors->has('dom_compet2'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('dom_compet2') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group col-lg-4 col-sm-12"><label>Domaine de compétence 3</label>
                <input class="form-control {{ $errors->has('dom_compet3') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->dom_compet3}}" name="dom_compet3" maxlength="50" placeholder="" >
                @if ($errors->has('dom_compet3'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('dom_compet3') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group col-lg-4 col-sm-12"><label>Moyens matériels pédagogiques 1</label>
                <input class="form-control {{ $errors->has('materiel1') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->materiel1}}" name="materiel1" maxlength="100" placeholder="" >
                @if ($errors->has('materiel1'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('materiel1') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-4 col-sm-12"><label>Moyens matériels pédagogiques 2</label>
                <input class="form-control {{ $errors->has('materiel2') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->materiel2}}" name="materiel2" maxlength="100" placeholder="" >
                @if ($errors->has('materiel2'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('materiel2') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-4 col-sm-12"><label>Moyens matériels pédagogiques 3</label>
                <input class="form-control {{ $errors->has('materiel3') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->materiel3}}" name="materiel3" maxlength="100" placeholder="" >
                @if ($errors->has('materiel3'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('materiel3') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-12">{{--**************HR**************--}}<hr></div>

            <div class="form-group col-lg-4 col-sm-12"><label>ID fiscal</label>
                <input class="form-control {{ $errors->has('id_fiscal') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->id_fiscal}}" name="id_fiscal" min="0" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="identifiant" >
                @if ($errors->has('id_fiscal'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('id_fiscal') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-4 col-sm-12"><label>N° CNSS</label>
                <input class="form-control {{ $errors->has('ncnss') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->ncnss}}" name="ncnss" min="0" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="N°" >
                @if ($errors->has('ncnss'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ncnss') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group col-lg-4 col-sm-12"><label>N° patente</label>
                <input class="form-control {{ $errors->has('npatente') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->npatente}}" name="npatente" min="0" maxlength="8" onkeypress="return isNumberKey(event)" placeholder="N°" >
                @if ($errors->has('npatente'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('npatente') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group col-12">{{--**************HR**************--}}<hr></div>

            <div class="form-group col-lg-3 col-sm-12"><label>Effectif</label>
                <input class="form-control {{ $errors->has('effectif') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->effectif}}" name="effectif" min="0" maxlength="10" onkeypress="return isNumberKey(event)" placeholder="effectif" >
                @if ($errors->has('effectif'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('effectif') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-3 col-sm-12"><label>Nb. permanents</label>
                <input class="form-control {{ $errors->has('nb_permanent') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->nb_permanent}}" name="nb_permanent" min="0" maxlength="10" onkeypress="return isNumberKey(event)" placeholder="nombre" >
                @if ($errors->has('nb_permanent'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nb_permanent') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-3 col-sm-12"><label>Nb. vacataires</label>
                <input class="form-control {{ $errors->has('nb_vacataire') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->nb_vacataire}}" name="nb_vacataire" min="0" maxlength="10" onkeypress="return isNumberKey(event)" placeholder="nombre" >
                @if ($errors->has('nb_vacataire'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nb_vacataire') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-3 col-sm-12"><label>Nb. formateurs</label>
                <input class="form-control {{ $errors->has('nb_formateur') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->nb_formateur}}" name="nb_formateur" min="0" maxlength="10" onkeypress="return isNumberKey(event)" placeholder="nombre" >
                @if ($errors->has('nb_formateur'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nb_formateur') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-3 col-sm-12"><label>Autre employés</label>
                <input class="form-control {{ $errors->has('autre_emp') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->autre_emp}}" name="autre_emp" min="0" maxlength="10" onkeypress="return isNumberKey(event)" placeholder="nombre" >
                @if ($errors->has('autre_emp'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('autre_emp') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-12">{{--space--}}</div>

            <div class="form-group col-lg-3 col-sm-12"><label>Effectif étrangers</label>
                <input class="form-control {{ $errors->has('effectif_etr') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->effectif_etr}}" name="effectif_etr" min="0" maxlength="10" onkeypress="return isNumberKey(event)" placeholder="nombre" >
                @if ($errors->has('effectif_etr'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('effectif_etr') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-3 col-sm-12"><label>Permanents étrangers</label>
                <input class="form-control {{ $errors->has('nb_permanent_etr') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->nb_permanent_etr}}" name="nb_permanent_etr" min="0" maxlength="10" onkeypress="return isNumberKey(event)" placeholder="nombre" >
                @if ($errors->has('nb_permanent_etr'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nb_permanent_etr') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-3 col-sm-12"><label>Vacataires étrangers</label>
                <input class="form-control {{ $errors->has('nb_vacataire_etr') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->nb_vacataire_etr}}" name="nb_vacataire_etr" min="0" maxlength="10" onkeypress="return isNumberKey(event)" placeholder="nombre" >
                @if ($errors->has('nb_vacataire_etr'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nb_vacataire_etr') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-3 col-sm-12"><label>Formateurs étrangers</label>
                <input class="form-control {{ $errors->has('nb_formateur_etr') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->nb_formateur_etr}}" name="nb_formateur_etr" min="0" maxlength="10" onkeypress="return isNumberKey(event)" placeholder="nombre" >
                @if ($errors->has('nb_formateur_etr'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nb_formateur_etr') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-3 col-sm-12"><label>Autre employés étrangers</label>
                <input class="form-control {{ $errors->has('autre_emp_etr') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->autre_emp_etr}}" name="autre_emp_etr" min="0" maxlength="10" onkeypress="return isNumberKey(event)" placeholder="nombre" >
                @if ($errors->has('autre_emp_etr'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('autre_emp_etr') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-12">{{--space--}}</div>


            {{-- RADIO BUTTON --}}
            <div class="form-group col-lg-6 col-sm-12">
                <label>L'organisme appartient-il à un groupe étranger ? <span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-lg-2 col-sm-6">
                <div class="custom-control custom-radio">
                    <input type="radio" name="org_etranger" id="oui" class="custom-control-input" value="oui" {{ (mb_strtolower($cabinet->org_etranger)=="oui") ? 'checked' : '' }}>
                    <label for="oui" class="custom-control-label">Oui</label>
                </div>
            </div>
            <div class="form-group col-lg-2 col-sm-6">
                <div class="custom-control custom-radio">
                    <input type="radio" name="org_etranger" id="non" class="custom-control-input" value="non" {{ (mb_strtolower($cabinet->org_etranger)=="non") ? 'checked' : '' }}>
                    <label for="non" class="custom-control-label">Non</label>
                </div>
            </div>
            {{-- ./ RADIO BUTTON --}}
            <div class="form-group col-12">{{--**************HR**************--}}<hr></div>

            <div class="form-group col-lg-3 col-sm-12"><label>Nom gérant 1</label>
                <input class="form-control {{ $errors->has('nom_gr1') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->nom_gr1}}" name="nom_gr1" maxlength="50" placeholder="nom" >
                @if ($errors->has('nom_gr1'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nom_gr1') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group col-lg-3 col-sm-12"><label>Prénom gérant 1</label>
                <input class="form-control {{ $errors->has('pren_gr1') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->pren_gr1}}" name="pren_gr1" maxlength="50" placeholder="prénom" >
                @if ($errors->has('pren_gr1'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('pren_gr1') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group col-lg-3 col-sm-12"><label>Qualité gérant 1</label>
                <input class="form-control {{ $errors->has('qualit_gr1') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->qualit_gr1}}" name="qualit_gr1" maxlength="50" placeholder="prénom" >
                @if ($errors->has('qualit_gr1'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('qualit_gr1') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group col-12">{{--space--}}</div>

            <div class="form-group col-lg-3 col-sm-12"><label>Nom gérant 2</label>
                <input class="form-control {{ $errors->has('nom_gr2') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->nom_gr2}}" name="nom_gr2" maxlength="50" placeholder="nom" >
                @if ($errors->has('nom_gr2'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nom_gr2') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group col-lg-3 col-sm-12"><label>Prénom gérant 2</label>
                <input class="form-control {{ $errors->has('pren_gr2') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->pren_gr2}}" name="pren_gr2" maxlength="50" placeholder="prénom" >
                @if ($errors->has('pren_gr2'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('pren_gr2') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group col-lg-3 col-sm-12"><label>Qualité gérant 2</label>
                <input class="form-control {{ $errors->has('qualit_gr2') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->qualit_gr2}}" name="qualit_gr2" maxlength="50" placeholder="prénom" >
                @if ($errors->has('qualit_gr2'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('qualit_gr2') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group col-12">{{--**************HR**************--}}<hr></div>

            <div class="form-group col-lg-9 col-sm-12"><label>Adresse</label>
                <input class="form-control {{ $errors->has('adress') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->adress}}" name="adress" maxlength="100" placeholder="adresse" >
                @if ($errors->has('adress'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('adress') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-lg-6 col-sm-12">
                <label for="ville">Ville</label>
                <?php $villes =
                    [
                        'Casablanca', 'Settat', 'Salé', 'Fès', 'Tanger', 'Marrakech', 'Meknès', 'Rabat', 'Oujda', 'Kénitra', 'Agadir', 'Tétouan',
                        'Témara', 'Safi', 'Mohammédia', 'El Jadida', 'Béni Mellal', 'Taza', 'Khémisset', 'Taourirt'
                    ];
                ?>
                <select class="form-control {{ $errors->has('ville') ? ' is-invalid' : '' }}" id="ville" name="ville" value="{{$cabinet->ville}}">
                    <option selected disabled>{{--vide--}}</option>
                    @foreach ($villes as $vl)
                        @if ($cabinet->ville == $vl)
                            <option selected value="{{$vl}}">{{$vl}}</option>
                        @else
                            <option value="{{$vl}}">{{$vl}}</option>
                        @endif
                    @endforeach
                </select>
                    @if ($errors->has('ville'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('ville') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group col-lg-3 col-sm-12"><label>Téléphone</label>
                <input class="form-control {{ $errors->has('tele') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->tele}}" name="tele" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="+(212)" >
                @if ($errors->has('tele'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('tele') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group col-lg-3 col-sm-12"><label>Fax</label>
                <input class="form-control {{ $errors->has('fax') ? ' is-invalid' : '' }}" type="text" value="{{$cabinet->fax}}" name="fax" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="+(212)" >
                @if ($errors->has('fax'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('fax') }}</strong>
                </span>
                @endif
            </div>


            <div class="form-group col-lg-3 col-sm-12"><label>E-Mail</label>
                <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" value="{{$cabinet->email}}" name="email" maxlength="50" placeholder="email" >
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group col-lg-6 col-sm-12"><label>Site-Web</label>
                <input class="form-control {{ $errors->has('website') ? ' is-invalid' : '' }}" type="url" value="{{$cabinet->website}}" name="website" maxlength="50" placeholder="url" >
                @if ($errors->has('website'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('website') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group col-12"><label>Commentaire</label>
            <textarea class="form-control" type="text" rows="4" name="commentaire" maxlength="900" placeholder="Commentaire ..">{{$cabinet->commentaire}}</textarea></div>

            </div><!-- ./row -->
        </div><!-- ./card-body -->

    <div class="card-footer text-center">
        <button class="btn buaj2" type="submit" id="edit" ><i class="fas fa-pen-square"></i>&nbsp;Modifier</button>
        <a class="btn bua2" href="/detail-cab/{{ $cabinet->nrc_cab }}"><i class="fas fa-window-close"></i>&nbsp;Annuler</a>
    </div>

    </form>
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
        toastr.options.timeOut = 0;
        toastr.options.extendedTimeOut = 0;
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
