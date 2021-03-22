@extends('layouts.admin')

@section('content')

@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Détails</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/PlanFormation">Action formation</a></li>
            <li class="breadcrumb-item active">{{ $plan->n_form }}</li>
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
      <a class="btn btn-dark btn-sm bu-lg-ic" href="/PlanFormation"><i class="fa fa-arrow-left"></i></a>
      <h3 class="card-title card-h3">Action N° {{ $plan->n_form }} > {{ $plan_props['raisoci'] }}</h3>
      <a class="btn btn-sm btn-danger bu-ic" onclick="confirmDelete({{$plan->n_form}}, 'pf/')"><i class="fa fa-trash-alt"></i></a>
      <a class="btn btn-sm btn-warning bu-ic" href="/edit-pf/{{ $plan->n_form }}"><i class="fa fa-edit"></i></a>
      <a class="btn btn-sm btn-secondary bu-ic" href="/detail-action-formation/{{ $plan->n_form }}"><i class="fa fa-list-alt"></i></a>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-striped p-0">
        <table class="table table-md">
            <thead class="thead">
              @if (session()->has('warning'))
                  <div class="alert alert-warning alert-dismissible col-12">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h5><i class="icon fas fa-warning"></i>Avertisement</h5>
                      <span>Veuillez modifier les dates de formations !<br>
                        <a class="text-info" href="/formation">&nbsp;<span><i class="fas fa-edit"></i>Formations</span></a>
                      </span>
                  </div>
              @endif
            </thead>
            <tbody>
                <tr><th class="th-det">État</th>
                    <td>{{ ucfirst($plan->etat) }}</td></tr>
                <tr><th class="th-det">N° action</th>
                    <td>{{ $plan->n_action }}</td></tr>
                <tr><th class="th-det">Réference formation</th>
                    <td>{{ $plan_props['refpdf'] }}</td></tr>
                <tr><th class="th-det">N° RC entreprise</th>
                    <td><a href="/detail-cl/{{$plan_props['nrc_entrp']}}">{{$plan_props['raisoci']}}</a></td></tr>
                <tr><th class="th-det">Intervenant</th>
                    <td>{{ $plan_props['nom'] }} {{ $plan_props['prenom'] }}</td></tr>
                <tr><th class="th-det">Domaine</th>
                    <td>{{$module_props['nom_domain']}}</td></tr>
                <tr><th class="th-det">Nom module</th>
                    <td>{{ $module_props['nom_theme'] }} {{-- $plan->id_thm --}}</td></tr>

                <tr><th class="th-det">Modèle 5</th>
                    <td>
                        {{ $plan->model5 }}
                        {!! ($plan->model5=="préparé") ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>' !!}
                    </td>
                </tr>
                <tr><th class="th-det">Modèle 3</th>
                    <td>
                        {{ $plan->model3 }}
                        {!! ($plan->model3=="préparé") ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>' !!}
                    </td>
                </tr>
                <tr><th class="th-det">Formulaire 4</th>
                    <td>
                        {{ $plan->f4 }}
                        {!! ($plan->f4=="préparé") ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>' !!}
                    </td>
                </tr>
                <tr><th class="th-det">Fiche d'évaluation</th>
                    <td>
                        {{ $plan->fiche_eval }}
                        {!! ($plan->fiche_eval=="préparé") ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>' !!}
                    </td>
                </tr>
                <tr><th class="th-det">Support de formation</th>
                    <td>
                        {{ $plan->support_form }}
                        {!! ($plan->support_form=="préparé") ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>' !!}
                    </td>
                </tr>
                <tr><th class="th-det">CV des intervenants</th>
                    <td>
                        {{ $plan->cv_inv }}
                        {!! ($plan->cv_inv=="préparé") ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>' !!}
                    </td>
                </tr>
                <tr><th class="th-det">Avis d'affichage</th>
                    <td>
                        {{ $plan->avis_affich }}
                        {!! ($plan->avis_affich=="préparé") ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>' !!}
                    </td>
                </tr>

                <tr><th class="th-det">Date début</th>
                    <td>{{ $plan->dt_debut }}</td></tr>
                <tr><th class="th-det">Date fin</th>
                    <td>{{ $plan->dt_fin }}</td></tr>
                <tr><th class="th-det">Nb. jours</th>
                    <td>{{ $plan->nb_jour }} Jours</td></tr>
                <tr><th class="th-det">Type formation</th>
                    <td>{{ $plan->type_form }}</td></tr>
                <tr><th class="th-det">Organisme</th>
                    <td>{{ $plan->organisme }}</td></tr>
                <tr><th class="th-det">Lieu</th>
                    <td>{{ $plan->lieu }}</td></tr>
                <tr><th class="th-det">Nom responsable</th>
                    <td>{{ $plan->nom_resp }}</td></tr>
                <tr><th class="th-det">Nombre groupes</th>
                    <td>{{ $plan->nb_grp }} groupes</td></tr>
                <tr><th class="th-det">Nb. particip. total</th>
                    <td>{{ $plan->nb_partcp_total }} participants</td></tr>
                <tr><th class="th-det">Nb. cadres</th>
                    <td>{{ $plan->nb_cadre }} cadres</td></tr>
                <tr><th class="th-det">Nb. employés</th>
                    <td>{{ $plan->nb_employe }} employés</td></tr>
                <tr><th class="th-det">Nb. ouvriers</th>
                    <td>{{ $plan->nb_ouvrier }} Ouvriers</td></tr>
                <tr><th class="th-det">Budget par jour</th>
                    <td>{{ $plan->bdg_jour }} DH</td></tr>
                <tr><th class="th-det">Budget Total (HT)</th>
                    <td>{{ $plan->bdg_total }} DH</td></tr>
                <tr><th class="th-det">Budget en Lettre (TTC)</th>
                    <td>{{ ucfirst($plan->bdg_letter) }} dirhams</td></tr>
                <tr><th class="th-det">Commentaire</th>
                    <td>{{ $plan->commentaire }}</td></tr>
                {{-- <tr><th class="th-det">Fiche présence</th>
                    <td>{{ $plan->fiche_pres }}</td></tr>
                <tr><th class="th-det">Syntèse d'évaluation</th>
                    <td>{{ $plan->synt_eval }}</td></tr>
                <tr><th class="th-det">Fiche d'évaluation individuel</th>
                    <td>{{ $plan->fiche_eval_indiv }}</td></tr> --}}
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
