@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Ajout</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/drb-gc">Demande remboursement GIAC</a></li>
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
        <h3 class="card-title">Ajout demande remboursement GIAC</h3>
    </div>
    <!-- /.card-header -->
    <form role="form" action="/add-drb-gc" method="POST">
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
                <label for="n_df">Demande financement</label>
                @if (count($df)==0)
                    <a class="btn bu5 bu-sm btn-sm" href="/add-df"><i class="fa fa-plus"></i></a>
                @endif
                <select class="form-control {{ $errors->has('n_df') ? ' is-invalid' : '' }}" id="n_df" name="n_df" value="{{old('n_df')}}">
                    <option selected disabled></option>
                    @foreach ($df as $d)
                        <option value="{{$d->n_df}}">{{$d->n_df}}</option>
                    @endforeach
                </select>
                @if (count($df)==0)
                    <div class="text-danger txt-sm">Veuillez d'abord ajouter une demande financement</div>
                @endif
                @if ($errors->has('n_df'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('n_df') }}
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-4 col-sm-12">
            <label>Documents</label>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="fact_cab_entr" id="fact_cab_entr" class="custom-control-input" value="Préparé">
                    <label for="fact_cab_entr" class="custom-control-label">Facture cabinet entreprise</label>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="relv_banc_cab" id="relv_banc_cab" class="custom-control-input" value="Préparé">
                    <label for="relv_banc_cab" class="custom-control-label">Relevé bancaire cabinet</label>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="relv_banc_entrp" id="relv_banc_entrp" class="custom-control-input" value="Préparé">
                    <label for="relv_banc_entrp" class="custom-control-label">Relevé bancaire entreprise</label>
                </div>
                {{-- DR --}}
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="drb_ds" id="drb_ds" class="custom-control-input" value="Préparé">
                    <label for="drb_ds" class="custom-control-label">Dem. rembours. DS</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="drb_if" id="drb_if" class="custom-control-input" value="Préparé">
                    <label for="drb_if" class="custom-control-label">Dem. rembours. IF</label>
                </div>
            </div>

            {{-- Moyen de remboursement --}}
            <div class="form-group col-lg-4 col-sm-12">
            <label>Moyen de paiement</label>
                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input type="radio" name="moyen_rb" onclick="checkEtatRbOpt()" id="chequeCheck" class="custom-control-input" value="chèque" />
                        <label for="chequeCheck" class="custom-control-label">Chèque</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="moyen_rb" onclick="checkEtatRbOpt()" id="virmCheck" class="custom-control-input" value="ordre de virement" />
                        <label for="virmCheck" class="custom-control-label">Ordre de virement</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="moyen_rb" onclick="checkEtatRbOpt()" id="effetCheck" class="custom-control-input" value="effet" />
                        <label for="effetCheck" class="custom-control-label">Effet</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="moyen_rb" onclick="checkEtatRbOpt()" id="aucunCheck" class="custom-control-input" value="non préparé" checked />
                        <label for="aucunCheck" class="custom-control-label">Pas encore</label>
                    </div>
                </div>
            </div>

            <div class="form-group col-lg-4 col-sm-12" id="chequeElements">
            <label>Chèque</label>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remise_avis" onclick="checkEtatRbOpt()" id="cheque_remise" class="custom-control-input" value="préparé">
                        <label for="cheque_remise" class="custom-control-label">Remise</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="releve" onclick="checkEtatRbOpt()" id="cheque_releve" class="custom-control-input" value="préparé">
                        <label for="cheque_releve" class="custom-control-label">Relevé</label>
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-4 col-sm-12" id="virmElements">
            <label>Ordre de virement</label>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remise_avis" onclick="checkEtatRbOpt()" id="virm_avis" class="custom-control-input" value="préparé">
                        <label for="virm_avis" class="custom-control-label">Avis d'opération</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="releve" onclick="checkEtatRbOpt()" id="virm_releve" class="custom-control-input" value="préparé">
                        <label for="virm_releve" class="custom-control-label">Relevé</label>
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-4 col-sm-12" id="effetElements">
            <label>Effet</label>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remise_avis" onclick="checkEtatRbOpt()" id="effet_remise" class="custom-control-input" value="préparé">
                        <label for="effet_remise" class="custom-control-label">Remise</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="releve" onclick="checkEtatRbOpt()" id="effet_releve" class="custom-control-input" value="préparé">
                        <label for="effet_releve" class="custom-control-label">Relevé</label>
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-4 col-sm-12" id="aucunElements">{{--aucun--}}</div>
            {{-- ./ Moyen de remboursement --}}

            <div class="form-group col-lg-3 col-sm-12">
            <label>Part GIAC</label>
                <select class="form-control {{ $errors->has('part_giac') ? ' is-invalid' : '' }}" id="part_giac" name="part_giac" value="{{old('part_giac')}}">
                    <option selected disabled>-part giac</option>
                    <option value="70 %">70 %</option>
                    <option value="80 %">80 %</option>
                </select>
            </div>


            <div class="form-group col-lg-3 col-sm-12">
                <label>Date paiement entreprise</label>
                <input class="form-control {{ $errors->has('dt_pay_entrp') ? ' is-invalid' : '' }}" value="{{old('dt_pay_entrp')}}" type="text" name="dt_pay_entrp" onmouseover="(this.type='date')" id="dt_pay_entrp" onchange="checkDate()" placeholder="date payement">
                @if ($errors->has('dt_pay_entrp'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('dt_pay_entrp') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-lg-3 col-sm-12">
                <label>Montant HT (Quote part. - TVA)</label>
                <input class="form-control {{ $errors->has('montant_entrp_ht') ? ' is-invalid' : '' }}" value="{{old('montant_entrp_ht')}}" type="text" id="montant_entrp_ht" name="montant_entrp_ht" min="0" maxlength="15" onkeypress="return isNumberKey(event)" placeholder="Montant HT">
                @if ($errors->has('montant_entrp_ht'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('montant_entrp_ht') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-lg-3 col-sm-12">
                <label>Montant paiement TTC (Quote part entrp.)</label>
                <input class="form-control {{ $errors->has('montant_entrp_ttc') ? ' is-invalid' : '' }}" value="{{old('montant_entrp_ttc')}}" type="text" id="montant_entrp_ttc" name="montant_entrp_ttc" min="0" maxlength="15" onkeypress="return isNumberKey(event)" placeholder="Montant TTC">
                @if ($errors->has('montant_entrp_ttc'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('montant_entrp_ttc') }}
                    </span>
                @endif
            </div>

            <div class="form-group col-12">{{--**************HR**************--}}<hr></div>

            <div class="form-group col-lg-12 col-sm-12">
                <label>Date dépôt dem. rembours.</label>
                <input class="form-control {{ $errors->has('dt_depo_drb') ? ' is-invalid' : '' }}" value="{{old('dt_depo_drb')}}" type="text" id="dt_depo_drb" name="dt_depo_drb" onmouseover="(this.type='date')" onchange="checkDate()" placeholder="date dépôt">
                @if ($errors->has('dt_depo_drb'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('dt_depo_drb') }}
                    </span>
                @endif
            </div>

            <div class="form-group col-12">{{--**************HR**************--}}<hr></div>

            <div class="form-group col-lg-3 col-sm-12">
                <label>Date remboursement</label>
                <input class="form-control {{ $errors->has('dt_rb') ? ' is-invalid' : '' }}" value="{{old('dt_rb')}}" type="text" name="dt_rb" id="dt_rb" onchange="checkDate()" onmouseover="(this.type='date')" placeholder="date rembours.">
                @if ($errors->has('dt_rb'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('dt_rb') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-lg-3 col-sm-12"><label>Montant remboursement</label><input class="form-control {{ $errors->has('montant_rb') ? ' is-invalid' : '' }}" value="{{old('montant_rb')}}" type="text" id="montant_rb" name="montant_rb" min="0" maxlength="15" onkeypress="return isNumberKey(event)" placeholder="Montant Rembours.">
                @if ($errors->has('montant_rb'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('montant_rb') }}
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-3 col-sm-12">
                <label>Ref. moyen paiement</label>
                <input class="form-control {{ $errors->has('ref_paiem') ? ' is-invalid' : '' }}" id="ref_paiem" value="{{old('ref_paiem')}}" type="text" name="ref_paiem" min="0" maxlength="15" placeholder="ref.">
                @if ($errors->has('ref_paiem'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('ref_paiem') }}
                    </span>
                @endif
            </div>

            {{-- Etat Demande Buttons --}}
            <div class="form-group col-lg-6 col-sm-12"><input onmousemove="checkEtat()" id="etat" class="form-control {{ $errors->has('etat') ? ' is-invalid' : 'etat' }} etat-miss" value="Initié" type="hidden" name="etat" maxlength="50" placeholder="état" readonly>
                @if ($errors->has('etat'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('etat') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-12">
                <div class="callout callout-warning">
                    <h5 class="text-bold text-center">État demande</h5>
                    <p class="text-center etat-miss" id="etat-txt"></p>
                    <p class="text-center etat-miss" id="etat-nb"></p>
                </div>
            </div>

            <div class="form-group col-12"><label>Commentaire</label><textarea class="form-control" type="text" rows="4" name="commentaire" maxlength="1900" placeholder="Commentaire ..">{{old('commentaire')}}</textarea></div>

        </div><!--./row-->
    </div><!--./card-body-->

    <div class="card-footer text-center">
        @if (count($df)!=0)
            <button class="btn buaj2" type="submit" id="add"><i class="fas fa-plus-circle"></i>&nbsp;Ajouter</button>
        @endif
        <a class="btn bua2" href="/drb-gc"><i class="fas fa-window-close"></i>&nbsp;Annuler</a>
    </div>

    </form>
</div><!-- ./CARD -->


<script type="text/javascript">
    $(document).ready(function() {

        // On Load
        $('#chequeElements').css('display', 'none');
        $('#virmElements').css('display', 'none');
        $('#effetElements').css('display', 'none');
        $('#aucunElements').css('display', 'inline-block');

        $('#virmCheck').click(function () {
            $('#virmElements').css('display', 'inline-block');
            $('#virm_avis').prop("checked", false);
            $('#virm_releve').prop("checked", false);

            $('#chequeElements').css('display', 'none');
            $('#cheque_remise').prop("checked", false);
            $('#cheque_releve').prop("checked", false);

            $('#effetElements').css('display', 'none');
            $('#effet_remise').prop("checked", false);
            $('#effet_releve').prop("checked", false);

            $('#aucunElements').css('display', 'none');
        });
        $('#chequeCheck').click(function () {
            $('#chequeElements').css('display', 'inline-block');
            $('#cheque_remise').prop("checked", false);
            $('#cheque_releve').prop("checked", false);

            $('#effetElements').css('display', 'none');
            $('#effet_remise').prop("checked", false);
            $('#effet_releve').prop("checked", false);

            $('#virmElements').css('display', 'none');
            $('#virm_avis').prop("checked", false);
            $('#virm_releve').prop("checked", false);

            $('#aucunElements').css('display', 'none');
        });
        $('#effetCheck').click(function () {
            $('#effetElements').css('display', 'inline-block');
            $('#effet_remise').prop("checked", false);
            $('#effet_releve').prop("checked", false);

            $('#chequeElements').css('display', 'none');
            $('#cheque_remise').prop("checked", false);
            $('#cheque_releve').prop("checked", false);

            $('#virmElements').css('display', 'none');
            $('#virm_avis').prop("checked", false);
            $('#virm_releve').prop("checked", false);

            $('#aucunElements').css('display', 'none');
        });
        $('#aucunCheck').click(function () {
            $('#aucunElements').css('display', 'inline-block');

            $('#effetElements').css('display', 'none');
            $('#effet_remise').prop("checked", false);
            $('#effet_releve').prop("checked", false);

            $('#chequeElements').css('display', 'none');
            $('#cheque_remise').prop("checked", false);
            $('#cheque_releve').prop("checked", false);

            $('#virmElements').css('display', 'none');
            $('#virm_avis').prop("checked", false);
            $('#virm_releve').prop("checked", false);
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


