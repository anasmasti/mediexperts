@extends('layouts.admin')


@section('content')

  {{-- @foreach($client as $cl)
  @if($cl->nrc_entrp==$df->nrc_e)
    @php $nrc = $cl->nrc_entrp @endphp
    @php $name = $cl->raisoci @endphp
  @endif
  @endforeach --}}

  @php
    $ds = "diagnostic stratégique";
    $if = "ingénierie de formation";
    $gcagro = "giac agroalimentaire";
    $cl = "client";
    $cab = "cabinet";
    $gc = "giac";
    $opt = "ofppt";
  @endphp

  {{-- check child data --}}
  @php $A = false; $B = false; @endphp
  @foreach($drb as $dr)
    @if($df->n_df==$dr->n_df)
      @php $A = true; @endphp
    @endif
  @endforeach

  @foreach($misinv as $mis)
    @if($df->n_df==$mis->n_df)
      @php $B = true; @endphp
    @endif
  @endforeach

@section('content-wrapper')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Détails</h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/df">Demande financement</a></li>
      <li class="breadcrumb-item active">{{$client[0]['raisoci']}}</li>
    </ol>
  </div><!-- /.col -->
@endsection

{{-- jquery scripts --}}
<script src={{ asset('js/jquery.js') }}></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
{{-- jquery scripts --}}

<!-- CARD -->
<div class="card card-dark">
    <!--card-header-->
    <div class="card-header">
      <a class="btn btn-dark btn-sm bu-lg-ic" href="/df"><i class="fa fa-arrow-left"></i></a></th>
      <h3 class="card-title card-h3">Demande Financ. > {{ucfirst($df->type_miss)}} > {{$client[0]['raisoci']}}</h3>
      @if ($A==true | $B==true)
        <a class="btn btn-sm btn-danger bu-ic" onclick="IsChild()"><i class="fa fa-trash-alt"></i></a>
      @elseif ($A==false | $B==false)
        <a class="btn btn-sm btn-danger bu-ic" onclick="confirmDelete({{$df->n_df}}, 'df/')"><i class="fa fa-trash-alt"></i></a>
      @endif
      <a class="btn btn-sm btn-warning bu-ic" href="/edit-df/{{ $df->n_df }}"><i class="fa fa-edit"></i></a>
      <a class="btn btn-sm btn-secondary bu-ic" href="/drb-df-gc/{{ $df->n_df }}"><i class="fa fa-list-alt"></i></a>
    </div>

    <!--card-body-->
    <div class="card-body table-striped p-0 {{-- table-responsive table-striped p-0 cus-card-height--}}">
      <table class="table table-head-fixed">
        <thead class="thead">
          <tr>
            <div class="progress" style="height: 20px;">
              <div class="progress-bar progress-bar-striped {{ mb_strtolower($df->etat=='approuvé') ? 'bg-success' : (mb_strtolower($df->etat=='annulé') ? 'bg-danger' : 'bg-warning progress-bar-animated') }}"
                @if (mb_strtolower($df->etat) == "annulé") style="width: 100%" @endif
                @if (mb_strtolower($df->etat) == "initié") style="width: 16%" @endif
                @if (mb_strtolower($df->etat) == "instruction dossier") style="width: 32%" @endif
                @if (mb_strtolower($df->etat) == "déposé") style="width: 64%" @endif
                @if (mb_strtolower($df->etat) == "accordé") style="width: 80%" @endif
                @if (mb_strtolower($df->etat) == "réalisé") style="width: 92%" @endif
                @if (mb_strtolower($df->etat) == "approuvé") style="width: 100%" @endif>
              </div>
            </div>
          </tr>

        </thead>

        <tbody>
          <tr>
            <th>ÉTAT DEMANDE</th>
            <td class="th-det text-capitalize">
              @if (mb_strtolower($df->etat) == "annulé")
                <i class="fa fa-times"></i>
                {{$df->etat}}
              @elseif (mb_strtolower($df->etat) == "initié")
                <i class="fa fa-battery-quarter"></i>
                {{$df->etat}}
              @elseif (mb_strtolower($df->etat) == "instruction dossier")
                <i class="fa fa-hourglass-half"></i>
                {{$df->etat}}
              @elseif (mb_strtolower($df->etat) == "déposé")
                <i class="fa fa-folder-open"></i>
                {{$df->etat}}
              @elseif (mb_strtolower($df->etat) == "accordé")
                <i class="fa fa-signature"></i>
                {{$df->etat}}
              @elseif (mb_strtolower($df->etat) == "réalisé")
                <i class="fa fa-check-square"></i>
                {{$df->etat}}
              @elseif (mb_strtolower($df->etat) == "approuvé")
                <i class="fa fa-check-circle"></i>
                {{$df->etat}}
              @endif
          </tr>
          <tr>
            <th>Entreprise&nbsp;<i class="fas fa-tag"></i></th>
            <td class="th-det text-capitalize"><a href="/detail-cl/{{ $df->nrc_e }}">{{$client[0]['raisoci']}}</a></td>
          </tr>
          <tr>
            <th>Type mission</th>
            <td class="th-det">
              {{ ucfirst($df->type_miss) }}
            </td>
          </tr>

          <tr>
            <th>GIAC de rattachement</th>
            <td class="th-det">{{ $df->gc_rattach }}</td>
          </tr>
          <tr>
            <th>Année d'exercice</th>
            <td class="th-det">{{ $df->annee_exerc }}</td>
          </tr>
          <tr>
            <th>
              Éligibilité CSF entreprise
            </th>
            <td class="th-det text-capitalize">
              @if ($df->d_eligib_csf_entrp=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>Nb. intervenants</th>
            <td class="th-det text-capitalize">{{ ($df->nb_interv) ? $df->nb_interv." intervenants" : "--" }}</td>
          </tr>
          <tr>
            <th>Date demande financement</th>
            <td class="th-det text-capitalize">{{ $df->dt_df }}</td>
          </tr>
          <tr>
            <th>Jour homme demandé</th>
            <td class="th-det text-capitalize">{{ $df->jr_hm_demande }} jour homme</td>
          </tr>
          <tr>
            <th>Budget demandé</th>
            <td class="th-det text-capitalize">{{ ($df->bdg_demande) ? $df->bdg_demande." dhs" : "--" }}</td>
          </tr>
          <tr>
            <th>Pourcentage Quote part demandé</th>
            <td class="th-det text-capitalize">{{ $df->prc_cote_part }}</td>
          </tr>

          <!-- Dossier Giac -->
          <tr>
            <td colspan="12" class="text-lg bg-dark">Dossier GIAC</td>
          </tr>
          @if (mb_strtolower($df->gc_rattach == "giac technologies"))
            <tr>
              <th>
                <i class="fas fa-file-alt"></i>
                Re-adhèsion
              </th>
              <td class="th-det text-capitalize">
                {{ $df->d_bulltin_adhes }}
                @if ($df->d_bulltin_adhes==$cab)
                <i class="fas fa-hourglass-half"></i>
                @elseif ($df->d_bulltin_adhes==$cl)
                <i class="fas fa-hourglass-half"></i>
                @elseif ($df->d_bulltin_adhes==$gc)
                  <i class="fas fa-check-circle"></i>
                @else
                  <i class="fas fa-times-circle"></i>
                @endif
              </td>
            </tr>
          @else
            <tr>
              <th>
                <i class="fas fa-file-alt"></i>
                Bulletin d'adhèsion
              </th>
              <td class="th-det text-capitalize text-capitalize">
                {{ $df->d_bulltin_adhes }}
                @if ($df->d_bulltin_adhes==$cab)
                <i class="fas fa-hourglass-half"></i>
                @elseif ($df->d_bulltin_adhes==$cl)
                <i class="fas fa-hourglass-half"></i>
                @elseif ($df->d_bulltin_adhes==$gc)
                  <i class="fas fa-check-circle"></i>
                @else
                  <i class="fas fa-times-circle"></i>
                @endif
              </td>
            <!-- <td class="th-det text-capitalize">$df->d_readhes</td></tr> -->
            </tr>
          @endif
          @if (mb_strtolower($df->type_miss) == $ds && mb_strtolower($client[0]['giac_rattach']) == $gcagro)
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Demande financement DS
            </th>
            <td class="th-det text-capitalize">
              {{ $df->d_df_DS }}
              @if ($df->d_df_DS==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_df_DS==$cl)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_df_DS==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @endif
          @if (mb_strtolower($df->type_miss) == $if && mb_strtolower($client[0]['giac_rattach']) == $gcagro)
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Demande financement IF
            </th>
            <td class="th-det text-capitalize">
              {{ $df->d_df_IF }}
              @if ($df->d_df_IF==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_df_IF==$cl)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_df_IF==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @endif
          <tr>
            <th>
              <i class="fas fa-money-check"></i>
              Chèques
            </th>
            <td class="th-det text-capitalize text-capitalize">
              {{ $df->d_cheque }}
              @if ($df->d_cheque==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_cheque==$cl)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_cheque==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Fiche de renseignement entreprise
            </th>
            <td class="th-det text-capitalize">
              {{ $df->f_renseign_entrp }}
              @if ($df->f_renseign_entrp==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->f_renseign_entrp==$cl)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->f_renseign_entrp==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @if (mb_strtolower($df->type_miss) == $ds)
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Fiche d'étude DS
            </th>
            <td class="th-det text-capitalize">
              {{ $df->f_etude_DS }}
              @if ($df->f_etude_DS==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->f_etude_DS==$cl)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->f_etude_DS==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @endif
          @if (mb_strtolower($df->type_miss) == $if)
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Fiche d'étude IF
            </th>
            <td class="th-det text-capitalize">
              {{ $df->f_etude_IF }}
              @if ($df->f_etude_IF==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->f_etude_IF==$cl)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->f_etude_IF==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @endif
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Déclaration sur l'honneur
            </th>
            <td class="th-det text-capitalize">
              {{ $df->d_honor }}
              @if ($df->d_honor==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_honor==$cl)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_honor==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @if (mb_strtolower($df->type_miss) == $ds)
          <tr>
            <th>
              <i class="fas fa-scroll"></i>
              Lettre tiers payant DS
            </th>
            <td class="th-det text-capitalize">
              {{ $df->l_tierpay_DS }}
              @if ($df->l_tierpay_DS==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->l_tierpay_DS==$cl)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->l_tierpay_DS==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @elseif (mb_strtolower($df->type_miss) == $if)
          <tr>
            <th>
              <i class="fas fa-scroll"></i>
              Lettre tiers payant IF
            </th>
            <td class="th-det text-capitalize">
              {{ $df->l_tierpay_IF }}
              @if ($df->l_tierpay_IF==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->l_tierpay_IF==$cl)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->l_tierpay_IF==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @endif
          {{-- <tr><th>Model 6 (N-1)</th>
            <td class="th-det text-capitalize">{{ $df->d_model6_n_1 }}</td></tr>
          <tr><th>Model 6 (N-2)</th>
            <td class="th-det text-capitalize">{{ $df->d_model6_n_2 }}</td></tr> --}}

          <tr>
            <th>
              <i class="fas fa-folder-open"></i>
              Dossier Juridique
            </th>
            <td class="th-det text-capitalize">
              {{ $df->doss_jury }}
              @if ($df->doss_jury==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->doss_jury==$cl)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->doss_jury==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>

          <tr>
            <th>
              <i class="fas fa-folder-open"></i>
              Attestation CSF
            </th>
            <td class="th-det text-capitalize">
              {{ $df->at_csf_doc }}
              @if ($df->at_csf_doc==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->at_csf_doc==$cl)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->at_csf_doc==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>

          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Modèle 6 (N-1)
            </th>
            <td class="th-det text-capitalize">
              {{ $df->d_model6_n_1 }}
              @if ($df->d_model6_n_1=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>

          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Modèle 6 (N-2)
            </th>
            <td class="th-det text-capitalize">
              {{ $df->d_model6_n_2 }}
              @if ($df->d_model6_n_2=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>

          <tr>
            <th>
              <i class="fas fa-scroll"></i>
              Déclaration sur l'honneur de réalisation des actions (G6)
            </th>
            <td class="th-det text-capitalize">
              {{ $df->d_honor_act_form }}
              @if ($df->d_honor_act_form=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>

          <!-- Dossier CSF -->
          <tr>
            <td colspan="12" class="text-lg bg-dark">Dossier CSF</td>
          </tr>
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Lettre demande CSF
            </th>
            <td class="th-det text-capitalize">
              {{ $df->dem_csf }}
              @if ($df->dem_csf==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->dem_csf==$cl)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->dem_csf==$opt)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Formulaire F1
            </th>
            <td class="th-det text-capitalize">
              {{ $df->f1 }}
              @if ($df->f1==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->f1==$cl)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->f1==$opt)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Status
            </th>
            <td class="th-det text-capitalize">
              {{ $df->d_statut }}
              @if ($df->d_statut==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_statut==$cl)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_statut==$opt)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Pouvoirs
            </th>
            <td class="th-det text-capitalize">
              {{ $df->d_pouvoir }}
              @if ($df->d_pouvoir==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_pouvoir==$cl)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_pouvoir==$opt)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>

          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Registre de commerce
            </th>
            <td class="th-det text-capitalize">
              {{ $df->d_rc }}
              @if ($df->d_rc==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_rc==$cl)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_rc==$opt)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Attestation de domiciliation Bancaire
            </th>
            <td class="th-det text-capitalize">
              {{ $df->at_domic_banc }}
              @if ($df->at_domic_banc==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->at_domic_banc==$cl)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->at_domic_banc==$opt)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Attestation CSF entreprise
            </th>
            <td class="th-det text-capitalize">
              {{ $df->at_csf_entrp }}
              @if ($df->at_csf_entrp=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>

          <!-- Dossier CABINET -->
          <tr>
            <td colspan="12" class="text-lg bg-dark">Dossier Cabinet</td>
          </tr>
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Attestation qualif. cabinet
            </th>
            <td class="th-det text-capitalize">
              {{ $df->at_qual_cab }}
              @if ($df->at_qual_cab==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->at_qual_cab==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Fiche de renseignement cabinet
            </th>
            <td class="th-det text-capitalize">
              {{ $df->f_renseign_cab }}
              @if ($df->f_renseign_cab==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->f_renseign_cab==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Attestation de compte
            </th>
            <td class="th-det text-capitalize">
              {{ $df->at_compte }}
              @if ($df->at_compte==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->at_compte==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>
              <i class="fas fa-file-invoice"></i>
              Eligibilité CSF cabinet
            </th>
            <td class="th-det text-capitalize">
              {{ $df->d_eligib_csf_cab }}
              @if ($df->d_eligib_csf_cab==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_eligib_csf_cab==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @if (mb_strtolower($df->type_miss) == $ds)
          <tr>
            <th>
              <i class="fas fa-file-invoice-dollar"></i>
              Facture proforama DS
            </th>
            <td class="th-det text-capitalize">
              {{ $df->d_fact_proforama_ds }}
              @if ($df->d_fact_proforama_ds==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_fact_proforama_ds==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @elseif (mb_strtolower($df->type_miss) == $if)
          <tr>
            <th>
              <i class="fas fa-file-invoice-dollar"></i>
              Facture proforama IF
            </th>
            <td class="th-det text-capitalize">
              {{ $df->d_fact_proforama_if }}
              @if ($df->d_fact_proforama_if==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_fact_proforama_if==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @endif
          @if (mb_strtolower($df->type_miss) == $ds)
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Propal DS
            </th>
            <td class="th-det text-capitalize">
              {{ $df->d_propal_DS }}
              @if ($df->d_propal_DS==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_propal_DS==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @elseif (mb_strtolower($df->type_miss) == $if)
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Propal IF
            </th>
            <td class="th-det text-capitalize">
              {{ $df->d_propal_IF }}
              @if ($df->d_propal_IF==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_propal_IF==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @endif
          <tr>
            <th>
              <i class="fas fa-id-badge"></i>
              CV consultants designés pour la mission
            </th>
            <td class="th-det text-capitalize">
              {{ $df->d_cv_consult_miss }}
              @if ($df->d_cv_consult_miss==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->d_cv_consult_miss==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>


          @if (mb_strtolower($df->type_miss) == $if)
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Budget PF
            </th>
            <td class="th-det text-capitalize">
              {{ $df->bdg_pf ? $df->bdg_pf." DH" : "" }}
            </td>
          </tr>
          @endif

          <!-- autres données -->
          <tr>
            <td colspan="12" class="text-lg bg-dark">Accord</td>
          </tr>

          @if (mb_strtolower($df->type_miss) == $ds)
          <tr>
            <th>
              <i class="fas fa-file-contract"></i>
              Contrat DS
            </th>
            <td class="th-det text-capitalize">
              {{ $df->ct_DS }}
              @if ($df->ct_DS==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->ct_DS==$cl)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->ct_DS==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @elseif (mb_strtolower($df->type_miss) == $if)

          <tr>
            <th>
              <i class="fas fa-file-contract"></i>
              Contrat IF
            </th>
            <td class="th-det text-capitalize">
              {{ $df->ct_IF }}
              @if ($df->ct_IF==$cab)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->ct_IF==$cl)
                <i class="fas fa-hourglass-half"></i>
              @elseif ($df->ct_IF==$gc)
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @endif
          {{-- <tr>
            <th>N Contrat</th>
            <td class="th-det text-capitalize">{{ $df->n_contrat }}</td>
          </tr> --}}
          <tr>
            <th>
              Date dépôt demande
            </th>
            <td class="th-det text-capitalize">{{ $df->dt_depos_df }}</td>
          </tr>

          <tr>
            <th>Date d'accord</th>
            <td class="th-det text-capitalize">{{ $df->dt_accord }}</td>
          </tr>

          <tr>
            <th>Date début mission</th>
            <td class="th-det text-capitalize">{{ $df->dt_debut_miss }}</td>
          </tr>
          <tr>
            <th>Date fin mission</th>
            <td class="th-det text-capitalize">{{ $df->dt_fin_miss }}</td>
          </tr>
          <tr>
            <th>Jour homme validé</th>
            <td class="th-det text-capitalize">{{ $df->jr_hm_valid }} jour homme</td>
          </tr>
          <tr>
            <th>Budget accordé</th>
            <td class="th-det text-capitalize">{{ $df->bdg_accord }} dhs</td>
          </tr>
          <tr>
            <th>Quote part entreprise</th>
            <td class="th-det text-capitalize">{{ $df->cote_part_entrp }} dhs</td>
          </tr>
          <tr>
            <th>Pourcentage Quote part </th>
            <td class="th-det text-capitalize">{{ $df->prc_cote_part }}</td>
          </tr>


          <tr>
            <td colspan="12" class="text-lg bg-dark">Réalisation</td>
          </tr>

          @if (mb_strtolower($df->type_miss) == $ds)
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Avis réalisation DS</th>
            <td class="th-det text-capitalize">
              {{ $df->av_realis_DS }}
              @if ($df->av_realis_DS=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @elseif (mb_strtolower($df->type_miss) == $if)
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Avis réalisation IF</th>
            <td class="th-det text-capitalize">
              {{ $df->av_realis_IF }}
              @if ($df->av_realis_IF=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @endif
          <tr>
            <th>Date envoi avis</th>
            <td class="th-det text-capitalize">{{ $df->dt_envoi_av }}</td>
          </tr>
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Rapport Réalisé</th>
            <td class="th-det text-capitalize">
              {{ $df->rpt_realis }}
              @if ($df->rpt_realis=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>Date fin réalisation rapport</th>
            <td class="th-det text-capitalize">{{ $df->dt_fin_realis }}</td>
          </tr>
          @if (mb_strtolower($df->type_miss) == $ds)
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Planing DS</th>
            <td class="th-det text-capitalize">
              {{ $df->planing_DS }}
              @if ($df->planing_DS=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @endif
          @if (mb_strtolower($df->type_miss) == $if)
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Planing IF</th>
            <td class="th-det text-capitalize">
              {{ $df->planing_IF }}
              @if ($df->planing_IF=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @endif
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Rapport réalisé</th>
            <td class="th-det text-capitalize">
              {{ $df->rpt_realis }}
              @if ($df->rpt_realis=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>Date fin réalisation</th>
            <td class="th-det text-capitalize">{{ $df->dt_fin_realis }}</td>
          </tr>
          <tr>
            <th>
              <i class="fas fa-check-square"></i>
              Réception approbation</th>
            <td class="th-det text-capitalize">
              {{ $df->at_approb }}
              @if ($df->at_approb=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>Date d'approbation</th>
            <td class="th-det text-capitalize">{{ $df->dt_approb }}</td>
          </tr>

          <tr>
            <td colspan="12" class="text-lg bg-dark">Approbation</td>
          </tr>

          @if (mb_strtolower($df->type_miss) == $ds)
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Page de garde DS</th>
            <td class="th-det text-capitalize">
              {{ $df->p_garde_DS }}
              @if ($df->p_garde_DS=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @endif
          @if (mb_strtolower($df->type_miss) == $if)
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Page de garde IF</th>
            <td class="th-det text-capitalize">
              {{ $df->p_garde_IF }}
              @if ($df->p_garde_IF=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @endif
          @if (mb_strtolower($df->type_miss) == $ds && mb_strtolower($client[0]['giac_rattach']) == $gcagro)
          <tr>
            <th>
              <i class="fas fa-scroll"></i>
              Demande d'approb. DS</th>
            <td class="th-det text-capitalize">
              {{ $df->dem_approb_ds }}
              @if ($df->dem_approb_ds=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @endif
          @if (mb_strtolower($df->type_miss) == $if && mb_strtolower($client[0]['giac_rattach']) == $gcagro)
          <tr>
            <th>
              <i class="fas fa-scroll"></i>
              Demande d'approb. IF</th>
            <td class="th-det text-capitalize">
              {{ $df->dem_approb_if }}
              @if ($df->dem_approb_if=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @endif

          @if (mb_strtolower($df->type_miss) == $if)
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Formulaire F2</th>
            <td class="th-det text-capitalize">
              {{ $df->f2 }}
              @if ($df->f2=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Modèle 1</th>
            <td class="th-det text-capitalize">
              {{ $df->model_1 }}
              @if ($df->model_1=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          @endif

          <tr>
            <th>
              <i class="fas fa-file-alt"></i>
              Rapport déposé</th>
            <td class="th-det text-capitalize">
              {{ $df->rpt_depose }}
              @if ($df->rpt_depose=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>Date dépôt rapport</th>
            <td class="th-det text-capitalize">{{ $df->dt_depos_rpt }}</td>
          </tr>

      <!-- PLAN FORMATION OFPPT -->
      {{-- @if (mb_strtolower($df->type_miss) == "ingénierie de formation")
          <tr>
            <td colspan="12" class="text-lg bg-dark">Dossier Plan de formation - OFPPT</td>
          </tr>
          <tr>
            <th>Contrat PF</th>
            <td class="th-det text-capitalize">
              {{ $df->ct_PF }}
              @if ($df->ct_PF=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>Lettre tiers-payant PF</th>
            <td class="th-det text-capitalize">
              {{ $df->l_tierpay_PF }}
              @if ($df->l_tierpay_PF=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>Attestation d'approbation (PF)</th>
            <td class="th-det text-capitalize">
              {{ $df->at_approb_ds }}
              @if ($df->at_approb_ds=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>Rapport DS (PF)</th>
            <td class="th-det text-capitalize">
              {{ $df->rpt_DS_PFOPT }}
              @if ($df->rpt_DS_PFOPT=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>Rapport IF (PF)</th>
            <td class="th-det text-capitalize">
              {{ $df->rpt_IF_PFOPT }}
              @if ($df->rpt_IF_PFOPT=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>Formulaire F2 (PF)</th>
            <td class="th-det text-capitalize">
              {{ $df->f2_PFOPT }}
              @if ($df->f2_PFOPT=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>Modèle 1 (PF)</th>
            <td class="th-det text-capitalize">
              {{ $df->model1_PFOPT }}
              @if ($df->model1_PFOPT=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>RIB (PF)</th>
            <td class="th-det text-capitalize">
              {{ $df->rib_PFOPT }}
              @if ($df->rib_PFOPT=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>F3 (PF)</th>
            <td class="th-det text-capitalize">
              {{ $df->f3_PFOPT }}
              @if ($df->f3_PFOPT=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>Attestation de qualification (PF)</th>
            <td class="th-det text-capitalize">
              {{ $df->at_qualif_PFOPT }}
              @if ($df->at_qualif_PFOPT=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>Eligibilité cabinet (PF)</th>
            <td class="th-det text-capitalize">
              {{ $df->eligib_cab_PFOPT }}
              @if ($df->eligib_cab_PFOPT=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>Accusé (PF)</th>
            <td class="th-det text-capitalize">
              {{ $df->accuse_PFOPT }}
              @if ($df->accuse_PFOPT=="préparé")
                <i class="fas fa-check-circle"></i>
              @else
                <i class="fas fa-times-circle"></i>
              @endif
            </td>
          </tr>
          <tr>
            <th>Date d'accusation (PF)</th>
            <td class="th-det text-capitalize">{{ $df->dt_accuse_PFOPT }}</td>
          </tr>
      @endif <!-- /. PF OFPPT --> --}}

          <tr>
            <th>Date der. modif.</th>
            <td class="th-det text-capitalize">
              {{ $df->updated_at }}
              <i class="fas fa-history"></i>
            </td>
          </tr>
          <tr>
            <th>Commentaire</th>
            <td class="th-det text-truncate">{{ $df->commentaire }}</td>
          </tr>
        </tbody>
      </table>

    </div><!--/.card-body-->
  </div>
  <!-- CARD -->



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
