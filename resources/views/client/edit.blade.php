@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Client</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/client">Client</a></li>
            <li class="breadcrumb-item active">{{ $client->raisoci }}</li>
        </ol>
    </div><!-- /.col -->
@endsection

{{-- jquery scripts --}}
<script src={{ asset('js/jquery.js') }}></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
{{-- jquery scripts --}}

<!--CARD-->
<div class="card card-dark">
    <!-- card-header -->
    <div class="card-header">
        <h3 class="card-title">Modifier&nbsp;{{ $client->raisoci }}</h3>
    </div>
    <!-- /.card-header -->

    <form class="form-horizontal" action="/edit-cl/{{$client->nrc_entrp}}" method="POST" on="consultMission()">
        <div class="card-body{{-- table-responsive table-striped cus-card-height--}}">
        <div class="row">
            {{ csrf_field() }}

            @if (session()->has('warning'))
                <div class="alert alert-warning alert-dismissible col-12">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i>Succès</h5>
                    <span>Associer des actionnaires !<br>
                        <a class="text-info" href="/add-act">&nbsp;<span><i class="fas fa-plus-circle"></i>&nbsp;Ajouter des actionnaires</span></a>
                    </span>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible col-12">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Erreurs</h5>
                    <span>Veuillez vérifier les champs</span>
                    <span>{{$errors}}</span>
                </div>
            @endif
        <div class="form-group col-lg-3 col-sm-12"><label>N° RC entreprise</label>
            <input class="form-control {{ $errors->has('nrc_entrp') ? ' is-invalid' : '' }}" value="{{$client->nrc_entrp}}" type="text" name="nrc_entrp" min="0" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="N° RC entreprise" >
            @if ($errors->has('nrc_entrp'))
                <span class="invalid-feedback" role="alert">
                {{ $errors->first('nrc_entrp') }}
                </span>
            @endif
        </div>

        <div class="form-group col-lg-9 col-sm-12"><label>Raison social</label>
            <input class="form-control {{ $errors->has('raisoci') ? ' is-invalid' : '' }}" value="{{$client->raisoci}}" type="text" name="raisoci" maxlength="100" placeholder="Raison social" >
            @if ($errors->has('raisoci'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('raisoci') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-9 col-sm-12"><label>Raison social</label>
            <input class="form-control {{ $errors->has('rais_abrev') ? ' is-invalid' : '' }}" value="{{$client->rais_abrev}}" type="text" name="rais_abrev" maxlength="50" placeholder="Raison social" >
            @if ($errors->has('rais_abrev'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('rais_abrev') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Forme juridique</label>
            <input class="form-control {{ $errors->has('formjury') ? ' is-invalid' : '' }}" value="{{$client->formjury}}" type="text" name="formjury" maxlength="50" placeholder="Forme juridique" >
            @if ($errors->has('formjury'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('formjury') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Date création</label>
            <input class="form-control {{ $errors->has('dt_creat') ? ' is-invalid' : '' }}" value="{{$client->dt_creat}}" type="text" name="dt_creat" onmouseover="(this.type='date')" id="date-more" placeholder="Date création" >
            @if ($errors->has('dt_creat'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('dt_creat') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Capital social</label>
            <input class="form-control {{ $errors->has('capt_soci') ? ' is-invalid' : '' }}" value="{{$client->capt_soci}}" type="text" name="capt_soci" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="Capital social" >
            @if ($errors->has('capt_soci'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('capt_soci') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12">
            <label for="giac_rattach">GIAC rattachement</label>
            @if (count($giac)==0)
                <a href="/add-gc"><a class="btn bu-icon bu-sm btn-sm" href="/add-gc"><i class="fa fa-plus"></i></a></a>
            @endif
            <select class="form-control {{ $errors->has('giac_rattach') ? ' is-invalid' : '' }}" name="giac_rattach">
                <option selected disabled>-giac</option>
                @foreach ($giac as $gc)
                    @if ($gc->libelle == $client->giac_rattach)
                        <option selected value="{{$gc->libelle}}">{{$gc->libelle}}</option>
                    @else
                        <option value="{{$gc->libelle}}">{{$gc->libelle}}</option>
                    @endif
                @endforeach
            </select>

            @if ($errors->has('giac_rattach'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('giac_rattach') }}
                </span>
            @endif
        </div>

        <div class="form-group col-lg-6 col-sm-12"><label>Objet social</label><input class="form-control {{ $errors->has('obj_soci') ? ' is-invalid' : '' }}" value="{{$client->obj_soci}}" type="text" name="obj_soci" maxlength="150" placeholder="Objet social" >
            @if ($errors->has('obj_soci'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('obj_soci') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-lg-6 col-sm-12"><label>Secteur d'activité</label>
            <input class="form-control {{ $errors->has('sect_activ') ? ' is-invalid' : '' }}" value="{{$client->sect_activ}}" type="text" name="sect_activ" placeholder="Secteur d'activité" >
            @if ($errors->has('sect_activ'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('sect_activ') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-lg-12 col-sm-12">{{--**************HR**************--}}<hr></div>

        <div class="form-group col-lg-3 col-sm-12"><label>ICE</label><input class="form-control {{ $errors->has('ice') ? ' is-invalid' : '' }}" type="text" value="{{$client->ice}}" name="ice" min="0" maxlength="50" onkeypress="return isNumberKey(event)" placeholder="ICE" >
            @if ($errors->has('ice'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ice') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Identifiant fiscal</label>
            <input class="form-control {{ $errors->has('id_fiscal') ? ' is-invalid' : '' }}" value="{{$client->id_fiscal}}" type="text" name="id_fiscal" min="0" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="Identifiant fiscal" >
            @if ($errors->has('id_fiscal'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('id_fiscal') }}</strong>
            </span>
            @endif
        </div>

        {{-- <div class="form-group col-lg-3 col-sm-12"><label>Identifiant entreprise</label>
            <input class="form-control {{ $errors->has('id_entrp') ? ' is-invalid' : '' }}" value="{{$client->id_entrp}}" type="text" name="id_entrp" min="0" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="Identifiant entreprise" >
            @if ($errors->has('id_entrp'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('id_entrp') }}</strong>
            </span>
            @endif
        </div> --}}

        <div class="form-group col-lg-3 col-sm-12"><label>N° CNSS</label>
            <input class="form-control {{ $errors->has('ncnss') ? ' is-invalid' : '' }}" type="text" value="{{$client->ncnss}}" name="ncnss" min="0" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="N° CNSS" >
            @if ($errors->has('ncnss'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('ncnss') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>N° patente</label>
            <input class="form-control {{ $errors->has('npatente') ? ' is-invalid' : '' }}" type="text" value="{{$client->npatente}}" name="npatente" min="0" maxlength="8" onkeypress="return isNumberKey(event)" placeholder="N° patente" >
            @if ($errors->has('npatente'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('npatente') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-lg-12 col-sm-12">{{--**************HR**************--}}<hr></div>

        <div class="form-group col-lg-12 col-sm-12"><label>Siège social</label>
            <input class="form-control {{ $errors->has('sg_soci') ? ' is-invalid' : '' }}" type="text" value="{{$client->sg_soci}}" name="sg_soci" maxlength="150" placeholder="Siège social" >
            @if ($errors->has('sg_soci'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('sg_soci') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-lg-6 col-sm-12"><label>Ville siège</label>
            <input class="form-control {{ $errors->has('local_2') ? ' is-invalid' : '' }}" type="text" value="{{$client->local_2}}" name="local_2" maxlength="50" placeholder="Localisation 1" >
            @if ($errors->has('local_2'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('local_2') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-lg-6 col-sm-12">
            <label for="ville">Ville (nomenclature)</label>
            <?php $villes =
                [
                    'Casablanca', 'Settat', 'Salé', 'Fès', 'Tanger', 'Marrakech', 'Meknès', 'Rabat', 'Oujda', 'Kénitra', 'Agadir', 'Tétouan',
                    'Témara', 'Safi', 'Mohammédia', 'El Jadida', 'Béni Mellal', 'Taza', 'Khémisset', 'Taourirt'
                ];
            ?>
            <select class="form-control {{ $errors->has('ville') ? ' is-invalid' : '' }}" id="ville" name="ville" value="{{$client->ville}}">
                <option selected disabled>{{--vide--}}</option>
                @foreach ($villes as $vl)
                    @if ($client->ville == $vl)
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

        {{-- <div class="form-group col-lg-6 col-sm-12"><label>Localisation 3 (Ville)</label>
            <input class="form-control {{ $errors->has('ville') ? ' is-invalid' : '' }}" type="text" value="{{$client->ville}}" name="ville" maxlength="50" placeholder="Localisation 2" >
            @if ($errors->has('ville'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('ville') }}</strong>
            </span>
            @endif
        </div> --}}


        <div class="form-group col-lg-12 col-sm-12">{{--**************HR**************--}}<hr></div>

        <div class="form-group col-lg-3 col-sm-12"><label>Chiffre d'affaire - 1</label>
            <input class="form-control {{ $errors->has('chif_aff_1') ? ' is-invalid' : '' }}" type="number" value="{{$client->chif_aff_1}}" name="chif_aff_1" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="en DH" >
            @if ($errors->has('chif_aff_1'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('chif_aff_1') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Chiffre d'affaire - 2</label>
            <input class="form-control {{ $errors->has('chif_aff_2') ? ' is-invalid' : '' }}" type="number" value="{{$client->chif_aff_2}}" name="chif_aff_2" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="en DH" >
            @if ($errors->has('chif_aff_2'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('chif_aff_2') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Chiffre d'affaire - 3</label>
            <input class="form-control {{ $errors->has('chif_aff_3') ? ' is-invalid' : '' }}" type="number" value="{{$client->chif_aff_3}}" name="chif_aff_3" min="0"maxlength="13" onkeypress="return isNumberKey(event)" placeholder="en DH" >
            @if ($errors->has('chif_aff_3'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('chif_aff_3') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Chiffre d'affaire - 4</label>
            <input class="form-control {{ $errors->has('chif_aff_4') ? ' is-invalid' : '' }}" type="number" value="{{$client->chif_aff_4}}" name="chif_aff_4" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="en DH" >
            @if ($errors->has('chif_aff_4'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('chif_aff_4') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Masse salarial</label>
            <input class="form-control {{ $errors->has('mass_salar') ? ' is-invalid' : '' }}" type="number" value="{{$client->mass_salar}}" name="mass_salar" min="0" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="en DH" >
            @if ($errors->has('mass_salar'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('mass_salar') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Tax formation personnel</label>
            <input class="form-control {{ $errors->has('tax_form_pers') ? ' is-invalid' : '' }}" value="{{$client->tax_form_pers}}" type="number" name="tax_form_pers" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="en DH" >
            @if ($errors->has('tax_form_pers'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('tax_form_pers') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Dernière année CSF</label>
            <input class="form-control {{ $errors->has('der_annee_csf') ? ' is-invalid' : '' }}" value="{{$client->der_annee_csf}}" type="number" name="der_annee_csf" min="0" maxlength="4" onkeypress="return isNumberKey(event)" placeholder="une année" >
            @if ($errors->has('der_annee_csf'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('der_annee_csf') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-lg-12 col-sm-12">{{--**************HR**************--}}<hr></div>

        <div class="form-group col-lg-3 col-sm-12"><label>Effectif</label>
            <input class="form-control {{ $errors->has('effectif') ? ' is-invalid' : '' }}" type="number" name="effectif" value="{{$client->effectif}}" min="0" maxlength="10" onkeypress="return isNumberKey(event)" placeholder="Effectif" >
            @if ($errors->has('effectif'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('effectif') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Nb. permanents</label>
            <input class="form-control {{ $errors->has('nb_permanent') ? ' is-invalid' : '' }}" type="number" value="{{$client->nb_permanent}}" name="nb_permanent" min="0" maxlength="10" onkeypress="return isNumberKey(event)" placeholder="nombre" >
            @if ($errors->has('nb_permanent'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nb_permanent') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Nb. employés</label>
            <input class="form-control {{ $errors->has('nb_employe') ? ' is-invalid' : '' }}" type="number" value="{{$client->nb_employe}}" name="nb_employe" min="0" maxlength="10" onkeypress="return isNumberKey(event)" placeholder="nombre" >
            @if ($errors->has('nb_employe'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nb_employe') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Nb. occasionnels</label>
            <input class="form-control {{ $errors->has('nb_occasional') ? ' is-invalid' : '' }}" type="number" value="{{$client->nb_occasional}}" name="nb_occasional" min="0" maxlength="10" onkeypress="return isNumberKey(event)" placeholder="nombre" >
            @if ($errors->has('nb_occasional'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nb_occasional') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Nb. Ouvriers</label>
            <input class="form-control {{ $errors->has('nb_ouvrier') ? ' is-invalid' : '' }}" type="number" value="{{$client->nb_ouvrier}}" name="nb_ouvrier" min="0" maxlength="10" onkeypress="return isNumberKey(event)" placeholder="nombre" >
            @if ($errors->has('nb_ouvrier'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nb_ouvrier') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Nb. Cadres</label>
            <input class="form-control {{ $errors->has('nb_cadre') ? ' is-invalid' : '' }}" type="number" value="{{$client->nb_cadre}}" name="nb_cadre" min="0" maxlength="10" onkeypress="return isNumberKey(event)" placeholder="nombre" >
            @if ($errors->has('nb_cadre'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nb_cadre') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-12 col-sm-12">{{--**************HR**************--}}<hr></div>
        <!--FORM-CHECK-->
        <div class="form-group col-lg-3 col-sm-12">
            <label>Missions réalisées 1</label>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="IF1_1" id="IF1_1" class="custom-control-input" value="{{$client->IF1_1}}" @if($client->IF2_1=== 'réalisée')  checked="1" @endif/>
                    <label for="IF1_1" id="lbl1" class="custom-control-label">Ingénieurie de formation</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="DS1_2" id="DS1_2" class="custom-control-input" value="{{$client->DS1_2}}" @if($client->DS1_2==='réalisée')  checked="1" @endif/>
                    <label for="DS1_2" class="custom-control-label">diagnostic stratégique</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="PF1_3" id="PF1_3" class="custom-control-input" value="{{$client->PF1_3}}" @if($client->PF1_3==='réalisée')  checked="1" @endif/>
                    <label for="PF1_3" class="custom-control-label">Plan de formation</label>
                </div>
            </div>
        </div>
        <div class="form-group col-lg-3 col-sm-12">
                <label>Missions réalisées 2</label>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="IF2_1" id="IF2_1" value="{{$client->IF2_1}}"  @if($client->IF2_1==='réalisée')  checked="1" @endif/>
                        <label for="IF2_1" class="custom-control-label">Ingénieurie de formation</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="DS2_2" id="DS2_2" value="{{$client->DS2_2}}" @if($client->DS2_2==='réalisée')  checked="1" @endif/>
                        <label for="DS2_2" class="custom-control-label">diagnostic stratégique</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="PF2_3" id="PF2_3" value="{{$client->PF2_3}}" @if($client->PF2_3==='réalisée')  checked="1" @endif/>
                        <label for="PF2_3" class="custom-control-label">Plan de formation</label>
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-3 col-sm-12">
                <label>Missions réalisées 3</label>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="IF3_1" id="IF3_1" value="{{$client->IF3_1}}" @if($client->IF3_1==='réalisée')  checked="1" @endif/>
                        <label for="IF3_1" class="custom-control-label">Ingénieurie de formation</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="DS3_2" id="DS3_2" value="{{$client->DS3_2}}" @if($client->DS3_2==='réalisée')  checked="1" @endif/>
                        <label for="DS3_2" class="custom-control-label">diagnostic stratégique</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="PF3_3" id="PF3_3" value="{{$client->PF3_3}}" @if($client->PF3_3==='réalisée')  checked="1" @endif/>
                        <label for="PF3_3" class="custom-control-label">Plan de formation</label>
                    </div>
                </div>
            </div>
        <!--./FORM-CHECK-->

        <div class="form-group col-lg-12 col-sm-12">{{--**************HR**************--}}<hr></div>

        <div class="form-group col-lg-3 col-sm-12"><label>Année Missions 1</label>
            <input class="form-control {{ $errors->has('annee_deja1') ? ' is-invalid' : '' }}" type="number" value="{{$client->annee_deja1}}" name="annee_deja1" min="0" maxlength="4" onkeypress="return isNumberKey(event)" placeholder="année" >
            @if ($errors->has('annee_deja1'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('annee_deja1') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Année Missions 2</label>
            <input class="form-control {{ $errors->has('annee_deja2') ? ' is-invalid' : '' }}" type="number" value="{{$client->annee_deja2}}" name="annee_deja2" min="0" maxlength="4" onkeypress="return isNumberKey(event)" placeholder="année" >
            @if ($errors->has('annee_deja2'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('annee_deja2') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Année Missions 3</label>
            <input class="form-control {{ $errors->has('annee_deja3') ? ' is-invalid' : '' }}" type="number" value="{{$client->annee_deja3}}" name="annee_deja3" min="0" maxlength="4" onkeypress="return isNumberKey(event)" placeholder="année" >
            @if ($errors->has('annee_deja3'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('annee_deja3') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-12 col-sm-12">{{--**************HR**************--}}<hr></div>

        <div class="form-group col-lg-3 col-sm-12"><label>Tél. 1</label>
            <input class="form-control {{ $errors->has('tel_1') ? ' is-invalid' : '' }}" type="text" value="{{$client->tel_1}}" name="tel_1" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="+(212)" >
            @if ($errors->has('tel_1'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('tel_1') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Tél. 2</label>
            <input class="form-control {{ $errors->has('tel_2') ? ' is-invalid' : '' }}" type="text" value="{{$client->tel_2}}" name="tel_2" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="+(212)" >
            @if ($errors->has('tel_2'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('tel_2') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Fix 1</label>
            <input class="form-control {{ $errors->has('fix_1') ? ' is-invalid' : '' }}" type="text" value="{{$client->fix_1}}" name="fix_1" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="+(212)" >
            @if ($errors->has('fix_1'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('fix_1') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Fix 2</label>
            <input class="form-control {{ $errors->has('fix_2') ? ' is-invalid' : '' }}" type="text" value="{{$client->fix_2}}" name="fix_2" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="+(212)" >
            @if ($errors->has('fix_2'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('fix_2') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Fax 1</label>
            <input class="form-control {{ $errors->has('fax_1') ? ' is-invalid' : '' }}" type="text" value="{{$client->fax_1}}" name="fax_1" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="+(212)" >
            @if ($errors->has('fax_1'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('fax_1') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Fax 2</label>
            <input class="form-control {{ $errors->has('fax_2') ? ' is-invalid' : '' }}" type="text" value="{{$client->fax_2}}" name="fax_2" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="+(212)" >
            @if ($errors->has('fax_2'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('fax_2') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-6 col-sm-12"><label>Site-Web</label>
            <input class="form-control {{ $errors->has('website') ? ' is-invalid' : '' }}" type="url" value="{{$client->website}}" name="website" placeholder="URL" >
            @if ($errors->has('website'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('website') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-12 col-sm-12">{{--**************HR**************--}}<hr></div>

        <div class="form-group col-lg-3 col-sm-12"><label>Nom DG 1</label>
            <input class="form-control {{ $errors->has('nom_dg1') ? ' is-invalid' : '' }}" type="text" value="{{$client->nom_dg1}}" name="nom_dg1" placeholder="nom" >
            @if ($errors->has('nb_cadre'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nb_cadre') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Fonction DG 1</label>
            <input class="form-control {{ $errors->has('fonct_dg1') ? ' is-invalid' : '' }}"type="text" value="{{$client->fonct_dg1}}" name="fonct_dg1" placeholder="fonction" >
            @if ($errors->has('fonct_dg1'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('fonct_dg1') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>GSM DG 1</label>
            <input class="form-control {{ $errors->has('gsm_dg1') ? ' is-invalid' : '' }}"type="text" value="{{$client->gsm_dg1}}" name="gsm_dg1" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="+(212)" >
            @if ($errors->has('gsm_dg1'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('gsm_dg1') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Email DG 1</label>
            <input class="form-control {{ $errors->has('email_dg1') ? ' is-invalid' : '' }}" type="email" value="{{$client->email_dg1}}" name="email_dg1" placeholder="email" >
            @if ($errors->has('email_dg1'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email_dg1') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Nom DG 2</label>
            <input class="form-control {{ $errors->has('nom_dg2') ? ' is-invalid' : '' }}" type="text" value="{{$client->nom_dg2}}" name="nom_dg2" placeholder="nom" >
            @if ($errors->has('nom_dg2'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nom_dg2') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Fonction DG 2</label>
            <input class="form-control {{ $errors->has('fonct_dg2') ? ' is-invalid' : '' }}" type="text" value="{{$client->fonct_dg2}}" name="fonct_dg2" placeholder="fonction" >
            @if ($errors->has('fonct_dg2'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('fonct_dg2') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>GSM DG 2</label>
            <input class="form-control {{ $errors->has('gsm_dg2') ? ' is-invalid' : '' }}" type="text" value="{{$client->gsm_dg2}}" name="gsm_dg2" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="+(212)" >
            @if ($errors->has('gsm_dg2'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('gsm_dg2') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Email DG 2</label>
            <input class="form-control {{ $errors->has('email_dg2') ? ' is-invalid' : '' }}"type="email" value="{{$client->email_dg2}}" name="email_dg2" placeholder="email" >
            @if ($errors->has('email_dg2'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email_dg2') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Nom responsable</label>
            <input class="form-control {{ $errors->has('nom_resp') ? ' is-invalid' : '' }}" type="text" value="{{$client->nom_resp}}" name="nom_resp" placeholder="nom" >
            @if ($errors->has('nom_resp'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nom_resp') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Fonction responsable</label>
            <input class="form-control {{ $errors->has('fonct_resp') ? ' is-invalid' : '' }}" type="text" value="{{$client->fonct_resp}}" name="fonct_resp" placeholder="fonction" >
            @if ($errors->has('fonct_resp'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('fonct_resp') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>GSM responsable</label>
            <input class="form-control {{ $errors->has('gsm_resp') ? ' is-invalid' : '' }}" type="text" value="{{$client->gsm_resp}}" name="gsm_resp" min="0" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="+(212)" >
            @if ($errors->has('gsm_resp'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('gsm_resp') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>E-Mail responsable</label>
            <input class="form-control {{ $errors->has('email_resp') ? ' is-invalid' : '' }}" type="email" value="{{$client->email_resp}}" name="email_resp" placeholder="email" >
            @if ($errors->has('email_resp'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email_resp') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-12 col-sm-12">{{--**************HR**************--}}<hr></div>

        <div class="form-group col-lg-6 col-sm-12"><label>RIB bancaire</label>
            <input class="form-control {{ $errors->has('rib') ? ' is-invalid' : '' }}" type="text" value="{{$client->rib}}" name="rib" min="0" maxlength="30" onkeypress="return isNumberKey(event)" placeholder="rib" >
            @if ($errors->has('rib'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('rib') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Agence bancaire</label>
            <input class="form-control {{ $errors->has('agence_banc') ? ' is-invalid' : '' }}"type="text" min="2" maxlength="20" value="{{$client->agence_banc}}" name="agence_banc" placeholder="agence" >
            @if ($errors->has('agence_banc'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('agence_banc') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-12 col-sm-12">{{--**************HR**************--}}<hr></div>

        <div class="form-group col-lg-3 col-sm-12"><label>Estim. budget DS</label>
            <input class="form-control {{ $errors->has('estim_bgd_DS') ? ' is-invalid' : '' }}" type="text" value="{{$client->estim_bgd_DS}}" name="estim_bgd_DS" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="en DH" >
            @if ($errors->has('estim_bgd_DS'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('estim_bgd_DS') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Estim. budget IF</label>
            <input class="form-control {{ $errors->has('estim_bdg_IF') ? ' is-invalid' : '' }}" type="text" value="{{$client->estim_bdg_IF}}" name="estim_bdg_IF" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="en DH" >
            @if ($errors->has('estim_bdg_IF'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('estim_bdg_IF') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Estim. budget PF</label>
            <input class="form-control {{ $errors->has('estim_bdg_PF') ? ' is-invalid' : '' }}" type="text" value="{{$client->estim_bdg_PF}}" name="estim_bdg_PF" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="en DH" >
            @if ($errors->has('estim_bdg_PF'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('estim_bdg_PF') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-12 col-sm-12">{{--**************HR**************--}}<hr></div>

        <div class="form-group col-lg-4 col-sm-12"><label>Date relation</label>
            <input class="form-control {{ $errors->has('dt_relation') ? ' is-invalid' : '' }}" type="text" value="{{$client->dt_relation}}" name="dt_relation" onmouseover="(this.type='date')" id="date-more" placeholder="date" >
            @if ($errors->has('dt_relation'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('dt_relation') }}</strong>
                </span>
            @endif
        </div>

        {{-- <div class="form-group col-lg-3 col-sm-12"><label>TAG</label><input class="form-control {{ $errors->has('tag1') ? ' is-invalid' : '' }}" type="text" value="{{$client->tag1}}" name="tag1" min="0" maxlength="2" onkeypress="return isNumberKey(event)" placeholder="TAG" >
            @if ($errors->has('tag1'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('tag1') }}</strong>
                </span>
            @endif
        </div> --}}

        <div class="form-group col-lg-12 col-sm-12"><label>Commentaire</label>
            <textarea class="form-control" type="text" rows="4" name="commentaire" maxlength="1000" placeholder="Commentaire ..">{{$client->commentaire}}</textarea>
        </div>

        </div><!--./row-->
    </div><!--./card-body-->

        <div class="card-footer text-center">
            <button class="btn bu-add" type="submit" ><i class="fas fa-pen-square"></i>&nbsp;Modifier</button>
            <a class="btn bu-danger" href="/detail-cl/{{ $client->nrc_entrp }}"><i class="fas fa-window-close"></i>&nbsp;Annuler</a>
        </div>
    </form>
</div>
<!--/.CARD-->



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
