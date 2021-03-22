@extends('layouts.admin')


@section('content')

@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Détails</h1>
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

<!-- CARD -->
<div class="card card-dark">
    <!-- card-header -->
    <div class="card-header">
        <a class="btn btn-dark btn-sm bu-lg-ic" href="/client"><i class="fa fa-arrow-left"></i></a>
        <h3 class="card-title card-h3">{{ $client->raisoci }}</h3>

        <?php $A = false; $B = false; $C = false; $D = false; ?>

        @foreach($action as $act)
            @if($client->nrc_entrp==$act->nrc_e)
            <?php $A = true; ?>
            @endif
        @endforeach

        @foreach($df as $d)
            @if($client->nrc_entrp==$d->nrc_e)
            <?php $B = true; ?>
            @endif
        @endforeach

        @foreach($drb as $dr)
            @if($client->nrc_entrp==$dr->nrc_e)
            <?php $C = true; ?>
            @else
            @endif
        @endforeach

        @foreach($plan as $pf)
            @if($client->nrc_entrp==$pf->nrc_e)
                <?php $D = true; ?>
            @endif
        @endforeach

        @if ($A==true | $B==true | $C==true | $D==true)
            <a class="btn btn-sm bua bu-ic" onclick="IsChild()"><i class="fa fa-trash-alt"></i></a>
        @elseif ($A==false && $B==false && $C==false && $D==false)
            <a class="btn btn-sm bua bu-ic" onclick="confirmDelete({{$client->nrc_entrp}}, 'cl/')"><i class="fa fa-trash-alt"></i></a>
        @endif

        <a class="btn btn-sm buaj bu-ic" href="/edit-cl/{{ $client->nrc_entrp }}"><i class="fa fa-edit"></i></a>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-striped p-0">
        <table class="table">
            <thead class="thead">
            </thead>
            <tbody>
                <tr><th class="th-det">N° RC entreprise</th>
                <td>{{ $client->nrc_entrp }}</td></tr>
                <tr><th class="th-det">Raison social</th>
                <td>{{ $client->raisoci }}</td></tr>
                <tr><th class="th-det">Abréviation</th>
                <td>{{ $client->rais_abrev }}</td></tr>
                <tr><th class="th-det">Forme juridique</th>
                <td>{{ $client->formjury }}</td></tr>
                <tr><th class="th-det">Date Création</th>
                <td>{{ $client->dt_creat }}</td></tr>
                <tr><th class="th-det">Objet social</th>
                <td>{{ $client->obj_soci }}</td></tr>
                <tr><th class="th-det">Capital social</th>
                <td>{{ $client->capt_soci }}</td></tr>
                <tr><th class="th-det">Secteur d'activité</th>
                <td>{{ $client->sect_activ }}</td></tr>
                <tr><th class="th-det">GIAC de rattachement</th>
                <td>{{ $client->giac_rattach }}</td></tr>
                <tr><th class="th-det">Id. fiscal</th>
                <td>{{ $client->id_fiscal }}</td></tr>
                <tr><th class="th-det">ICE</th>
                <td>{{ $client->ice }}</td></tr>
                <tr><th class="th-det">N° CNSS</th>
                <td>{{ $client->ncnss }}</td></tr>
                <tr><th class="th-det">N° patente</th>
                <td>{{ $client->npatente }}</td></tr>
                <tr><th class="th-det">Siège social</th>
                <td>{{ $client->sg_soci }}</td></tr>
                <tr><th class="th-det">Chiffre d'affaire</th>
                <td>{{ $client->chif_aff_1 ? $client->chif_aff_1 . " Dhs" : "--" }}</td></tr>
                <tr><th class="th-det">Chiffre d'affaire -1</th>
                <td>{{ $client->chif_aff_2 ? $client->chif_aff_2 . " Dhs" : "--" }}</td></tr>
                <tr><th class="th-det">Chiffre d'affaire -2</th>
                <td>{{ $client->chif_aff_3 ? $client->chif_aff_3 . " Dhs" : "--" }}</td></tr>
                <tr><th class="th-det">Chiffre d'affaire -3</th>
                <td>{{ $client->chif_aff_4 ? $client->chif_aff_4 . " Dhs" : "--" }}</td></tr>
                <tr><th class="th-det">Localisation 1</th>
                <td>{{ $client->sg_soci }}</td></tr>
                <tr><th class="th-det">Localisation 2</th>
                <td>{{ $client->local_2 }}</td></tr>
                <tr><th class="th-det">Localisation 3</th>
                <td>{{ $client->ville }}</td></tr>
                <tr><th class="th-det">Effectif</th>
                <td>{{ $client->effectif }}</td></tr>
                <tr><th class="th-det">Masse salarial</th>
                <td>{{ $client->mass_salar ? $client->mass_salar . " Dhs" : "--" }}</td></tr>
                <tr><th class="th-det">Tax formation personnel</th>
                <td>{{ $client->tax_form_pers ? $client->tax_form_pers . " Dhs" : "--" }}</td></tr>
                <tr><th class="th-det">Dernière année CSF</th>
                <td>{{ $client->der_annee_csf }}</td></tr>
                <tr><th class="th-det">Nb. permanents</th>
                <td>{{ $client->nb_permanent }}</td></tr>
                <tr><th class="th-det">Nb. employés</th>
                <td>{{ $client->nb_employe }}</td></tr>
                <tr><th class="th-det">Nb. occasionnels</th>
                <td>{{ $client->nb_occasional }}</td></tr>
                <tr><th class="th-det">Nb. ouvriers</th>
                <td>{{ $client->nb_ouvrier }}</td></tr>
                <tr><th class="th-det">Nb. cadres</th>
                <td>{{ $client->nb_cadre }}</td></tr>
                <tr><th class="th-det">Ingénieurie de formation 1</th>
                <td>{{ $client->IF1_1 }}</td></tr>
                <tr><th class="th-det">Diagnostic stratégique  1</th>
                <td>{{ $client->DS1_2 }}</td></tr>
                <tr><th class="th-det">Plan de formation 1</th>
                <td>{{ $client->PF1_3 }}</td></tr>
                <tr><th class="th-det">Année réalisation 1</th>
                <td>{{ $client->annee_deja1 }}</td></tr>
                <tr><th class="th-det">Ingénieurie de formation 2</th>
                <td>{{ $client->IF2_1 }}</td></tr>
                <tr><th class="th-det">Diagnostic stratégique  2</th>
                <td>{{ $client->DS2_2 }}</td></tr>
                <tr><th class="th-det">Plan de formation  2</th>
                <td>{{ $client->PF2_3 }}</td></tr>
                <tr><th class="th-det">Année réalisation 2</th>
                <td>{{ $client->annee_deja2 }}</td></tr>
                <tr><th class="th-det">Ingénieurie de formation 3</th>
                <td>{{ $client->IF3_1 }}</td></tr>
                <tr><th class="th-det">Diagnostic stratégique  3</th>
                <td>{{ $client->DS3_2 }}</td></tr>
                <tr><th class="th-det">Plan de formation  3</th>
                <td>{{ $client->PF3_3 }}</td></tr>
                <tr><th class="th-det">Année réalisation 3</th>
                <td>{{ $client->annee_deja3 }}</td></tr>
                <tr><th class="th-det">Tél. 1</th>
                <td>{{ $client->tel_1 }}</td></tr>
                <tr><th class="th-det">Tél. 2</th>
                <td>{{ $client->tel_2 }}</td></tr>
                <tr><th class="th-det">Fix 1</th>
                <td>{{ $client->fix_1 }}</td></tr>
                <tr><th class="th-det">Fix 2</th>
                <td>{{ $client->fix_2 }}</td></tr>
                <tr><th class="th-det">Fax 1</th>
                <td>{{ $client->fax_1 }}</td></tr>
                <tr><th class="th-det">Fax 2</th>
                <td>{{ $client->fax_2 }}</td></tr>
                <tr><th class="th-det">Site-Web</th>
                <td><a href="{{ $client->website }}" target="_blank">{{ $client->website }}</a></td></tr>
                <tr><th class="th-det">Nom DG 1</th>
                <td>{{ $client->nom_dg1 }}</td></tr>
                <tr><th class="th-det">Fonction DG 1</th>
                <td>{{ $client->fonct_dg1 }}</td></tr>
                <tr><th class="th-det">GSM DG 1</th>
                <td>{{ $client->gsm_dg1 }}</td></tr>
                <tr><th class="th-det">Email DG 1</th>
                <td><a href="mailto:{{ $client->email_dg1 }}">{{ $client->email_dg1 }}</a></td></tr>
                <tr><th class="th-det">Nom DG 2</th>
                <td>{{ $client->nom_dg2 }}</td></tr>
                <tr><th class="th-det">Fonction DG 2</th>
                <td>{{ $client->fonct_dg2 }}</td></tr>
                <tr><th class="th-det">GSM DG 2</th>
                <td>{{ $client->gsm_dg2 }}</td></tr>
                <tr><th class="th-det">Email DG 2</th>
                <td><a href="mailto:{{ $client->email_dg2 }}">{{ $client->email_dg2 }}</a></td></tr>
                <tr><th class="th-det">Nom Responsable</th>
                <td>{{ $client->nom_resp }}</td></tr>
                <tr><th class="th-det">Fonction responsable</th>
                <td>{{ $client->fonct_resp }}</td></tr>
                <tr><th class="th-det">GSM responsable</th>
                <td>{{ $client->gsm_resp }}</td></tr>
                <tr><th class="th-det">E-MAIL responsable</th>
                <td><a href="mailto:{{ $client->email_resp }}">{{ $client->email_resp }}</a></td></tr>
                <tr><th class="th-det">RIB</th>
                <td>{{ $client->rib }}</td></tr>
                <tr><th class="th-det">Agence bancaire</th>
                <td>{{ $client->agence_banc }}</td></tr>
                <tr><th class="th-det">Estim. budget DS</th>
                <td>{{ $client->estim_bgd_DS }}</td></tr>
                <tr><th class="th-det">Estim. budget IF</th>
                <td>{{ $client->estim_bdg_IF }}</td></tr>
                <tr><th class="th-det">Estim. budget PF</th>
                <td>{{ $client->estim_bdg_PF }}</td></tr>
                <tr><th class="th-det">Date d'entrée en relation</th>
                <td>{{ $client->dt_relation }}</td></tr>
                <tr><th class="th-det">Tag 1</th>
                <td>{{ $client->tag1 }}</td></tr>
                <tr><th class="th-det">Date der. modif.</th>
                <td>{{ $client->updated_at }}</td></tr>
                <tr><th class="th-det">Commentaire</th>
                <td>{{ $client->commentaire }}</td></tr>
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





