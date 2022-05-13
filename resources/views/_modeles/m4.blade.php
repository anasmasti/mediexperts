<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <script src={{ asset('js/jquery.js') }}></script>
    <script src={{ asset('js/myjs.js') }}></script>
    <script src={{ asset('js/NumberToLetter.js') }}></script>
</head>

<body>

  <style>
    .paper {
      padding:20px; height:27.9cm; width:21cm;font-size:14px; padding-left:.25px;
    }
    input { width:100%; padding: .2rem; border: none !important; outline: none !important; }
    input { word-wrap: break-all; }
    input[type=radio] { outline: 1px solid #000; }
    input[type="text"] { background-color: #fff; }
    table {
      border: 1px solid #000;
      border-collapse: collapse;
      width: 100%;
      text-align: center;
    }
    td, tr, th {
      border: 1px solid #000;
      padding: .5rem;
    }
    .border-none { border: none !important; }
    .flex-row {
      display: flex;
      flex-flow: row wrap;
    }
    .flex-column {
        display: flex; flex-flow: column nowrap;
        justify-content: center; align-items: center;
        text-align: center;
    }
    .d-none { display: none; }
    .container { width: 100% !important; }
    .bordered { border: 1px solid #000; padding: .2rem; }
    .highlighted { background-color: #ffff99 !important; }
    .text-bold { font-weight: 600; }
    .text-center { text-align: center !important; }
    .bu-print {
      padding:0; margin:0 0 50px 0;
      display: inline-block; width:47%; height:50px;
      color:#393939; background: linear-gradient(to right, #393939 50%, #fff 50%);
      background-size: 200% 100%;
      background-position: right;
      border-radius:5px; text-align:center; line-height:1.75;
      font-size:25px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; text-decoration:none;
      border: 2px solid #393939;
      transition: .2s all ease-out;
    }
    #footer {
        display: none !important;
    }
    .bu-print:hover {
      color: #fff;
      background-color: #393939;
      border-radius: 10px;
      background-position: left;
    }
    @media print {
      .hide-from-print { display: none; }
      .highlighted { background-color: #fff !important; }
      .display-in-print { display: inline-block !important; }
      input[type="date"]::-webkit-calendar-picker-indicator,
      input[type="date"]::-webkit-inner-spin-button{
          display: none !important;
      }
      #footer {
          display: flex !important;
      }
    }
</style>

<div class="hide-from-print">
  <div style="display:flex; justify-content:space-between;">
    <a class="bu-print" id="" href="/formation">Retour</a>
    <a class="bu-print" id="buPrintM4" href="#" onclick="window.print()">Imprimer le formulaire</a>
  </div>
</div>

<div class="" id="paper" style="font-family:Calibri, 'Segoe UI', Geneva, Verdana, sans-serif; background-color: #fff;">

  <div style="width:100%; height:130px;"><!--space--></div>

  <input type="hidden" id="idForm" value="{{$formation->id_form}}" readonly>
  <table>
    <tr>
      <th style="width:40%;">Entreprise</th>
      <th>Facture N°</th>
      <th>Date</th>
    </tr>
    <tr>
      <td class="flex-column border-none">
        <strong class="">
          {{ $formation["raisoci"] }}
        </strong>
        <span class="text-center">
            ICE
            {{ $formation["ice"] }}
        </span>
      </td>
      <td>
        <input class="highlighted text-center" type="text" name="n_facture" id="nFacture" value="{{$formation->n_facture}}" style="font-size: 15px; font-family:Calibri">
        <button class="hide-from-print" id="saveBtn">Enregistrer</button>
      </td>

      <td>
          {{-- date facture --}}
          <input type="date" name="dtFacture" id="dtFacture" class="text-center" value={{($formation['dt_facture'] != null) ? $formation['dt_facture'] : $formation['dt_fin']}}>
      </td>
    </tr>
    <tr>
      <th>Lieu de formation</th>
      <th colspan="2">{{ $formation["lieu"] }}</th>
    </tr>
  </table>

  <div style="width:100%;height:10px;"><!--space--></div>

  <table>
    <tr>
      <th style="width:40%;">THEMES</th>
      <th style="width:25%;">Jours réels de formation par groupe</th>
      <th style="width:15%;">Nbre de bénéficiaires</th>
      <th style="width:20%;">Montant HT / Jour</th>
    </tr>
    <tr>
      <td>
        {{ $formation["nom_theme"] }} <br />
        @php
          $action = \App\PlanFormation::select('plan_formations.*', 'formations.*')
            ->join('formations', 'plan_formations.n_form', 'formations.n_form')
            ->where('plan_formations.n_form', $formation["n_form"])
            ->first();
           $avis_modification = \App\AvisModification:: select('avis_modifications.*')
            ->where('avis_modifications.n_form', $action['n_form'])
            ->orderby('created_at','DESC')
            ->first(); 
        @endphp
        @if ($action["nb_grp"] > 1)
          Groupe {{ $formation["groupe"] }}
        @endif
      </td>
      <td>
      @empty($avis_modification)
        @if ($formation["date1"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date1"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date2"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date2"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date3"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date3"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date4"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date4"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date5"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date5"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date6"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date6"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date7"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date7"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date8"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date8"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date9"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date9"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date10"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date10"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date11"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date11"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date12"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date12"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date13"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date13"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date14"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date14"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date15"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date15"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date16"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date16"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date17"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date17"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date18"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date18"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date19"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date19"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date20"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date20"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date21"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date21"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date22"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date22"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date23"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date23"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date24"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date24"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date25"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date25"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date26"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date26"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date27"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date27"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date28"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date28"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date29"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date29"])->format('d/m/Y') }}</span> @endif
        @if ($formation["date30"] != null) <span class="dates"> {{ Carbon\Carbon::parse($formation["date30"])->format('d/m/Y') }}</span> @endif
      @endempty

      @empty(!$avis_modification)
        @if ($avis_modification["new_date1"] != null) <span class="dates"> {{ Carbon\Carbon::parse($avis_modification["new_date1"])->format('d/m/Y') }}</span> @endif
        @if ($avis_modification["new_date2"] != null) <span class="dates"> {{ Carbon\Carbon::parse($avis_modification["new_date2"])->format('d/m/Y') }}</span> @endif
        @if ($avis_modification["new_date3"] != null) <span class="dates"> {{ Carbon\Carbon::parse($avis_modification["new_date3"])->format('d/m/Y') }}</span> @endif
        @if ($avis_modification["new_date4"] != null) <span class="dates"> {{ Carbon\Carbon::parse($avis_modification["new_date4"])->format('d/m/Y') }}</span> @endif
        @if ($avis_modification["new_date5"] != null) <span class="dates"> {{ Carbon\Carbon::parse($avis_modification["new_date5"])->format('d/m/Y') }}</span> @endif
        @if ($avis_modification["new_date6"] != null) <span class="dates"> {{ Carbon\Carbon::parse($avis_modification["new_date6"])->format('d/m/Y') }}</span> @endif
        @if ($avis_modification["new_date7"] != null) <span class="dates"> {{ Carbon\Carbon::parse($avis_modification["new_date7"])->format('d/m/Y') }}</span> @endif
        @if ($avis_modification["new_date8"] != null) <span class="dates"> {{ Carbon\Carbon::parse($avis_modification["new_date8"])->format('d/m/Y') }}</span> @endif
        @if ($avis_modification["new_date9"] != null) <span class="dates"> {{ Carbon\Carbon::parse($avis_modification["new_date9"])->format('d/m/Y') }}</span> @endif
        @if ($avis_modification["new_date10"] != null) <span class="dates"> {{ Carbon\Carbon::parse($avis_modification["new_date10"])->format('d/m/Y') }}</span> @endif
      @endempty
      </td>
      <td>{{ $formation["nb_benif"] }}</td>
      <td>{{ $formation["bdg_jour"] }} DH</td>
    </tr>
    <tr>
      {{-- <th colspan="2"></th> --}}
      <th colspan="3">TOTAL H.T</th>
      <th>{{ $formation["bdg_total"] }} DH</th>
    </tr>
    <tr>
      {{-- <th colspan="2"></th> --}}
      <th colspan="3">TVA 20%</th>
      <th>{{ ($formation["bdg_total"] * .2) }} DH</th>
    </tr>
    <tr>
      {{-- <th colspan="2"></th> --}}
      <th colspan="3">TOTAL TTC</th>
      <th>{{ ($formation["bdg_total"] * .2 + $formation["bdg_total"]) }} DH</th>
    </tr>
    @if ($formation['type_contrat'] == 'normal')
        <div></div>
    @else
    <tr>
      <th colspan="3">QUOTE PART OFPPT TIERS PAYANT H.T</th>
      {{-- <th></th> --}}
      <th>{{ $formation["bdg_total"] * .7 }} DH</th>
    </tr>
    <tr>
      <th colspan="3" rowspan="2">QUOTE PART ENTREPRISE TTC<br/>(30% du montant H.T + TVA du montant global)</th>
      {{-- <th rowspan="2"></th> --}}
      <th rowspan="2">{{ ($formation["bdg_total"] * .3 + $formation["bdg_total"] * .2) }} DH</th>
    </tr>
    @endif
  
  </table>

  <div style="width:100%; height:30px;"><!--space--></div>

  <div class="container">
    <span class="text-bold">Arrêtée la présente facture à la somme de : </span>
    {{-- BUDGET TTC --}}
    <input type="text" class="highlighted" id="bdgLetter" name="bdgLetter" value=""
      style="display: inline !important; width:50%" readonly />
      {{-- HIDDEN BUDGET TTC LETTER --}}
      <input type="hidden" name="bdgTTC" id="bdgTTC" value="{{($formation["bdg_total"] * .2 + $formation["bdg_total"])}}" />
      {{-- HIDDEN BUDGET TTC LETTER --}}

  </div>

  <div style="width:100%; height:20px;"><!--space--></div>

  <div class="container">
    <span class="text-bold">Mode et référence de paiement : </span>
    <input type="text" id="type_paiement_ref" class="highlighted" style="display: inline !important; width:50%"
      placeholder=". . . . . . . . . . . . . . . ." />
  </div>

  <div style="width:100%; height:25px;"><!--space--></div>

  <div id="footer" class="container" style="display:flex;flex-direction:column;justify-content:center;position:fixed; bottom:0; width:100%; padding-bottom:150px;background-color:red !important">
    <p style="margin: 20px; margin-left: 60%;text-align:center">RAID SOUFIANE, ADIL BELMOKADEM</p>
    <p style="margin: 5px; margin-left: 60%;text-align:center">CO-GÉRANTS</p>
  </div>
</div>


{{-- script to print page --}}
<script type="text/javascript">
    function getBdgTTCLetter() {
      let bdgTTC = $("#bdgTTC").val();
      console.log(bdgTTC);
      let result = NumberToLetter(bdgTTC).toUpperCase() + " DIRHAMS";
      $('#bdgLetter').val(result);
      console.log(result);
    }
    $(document).ready(function () {
      // BUDGET TTC EN LETTRE
      getBdgTTCLetter();
      // $('#paper').on('mousemove', function() {
      // })
      $('#saveBtn').on('click', function() {
        var idForm = $('#idForm').val();
        var nFacture = $('#nFacture').val();
        var dtFacture = $('#dtFacture').val();
        console.log("idForm : "+idForm+" nFacture : "+nFacture, "dtFacture : "+dtFacture);
        $.ajax({
          type: 'POST',
          url: '{!! URL::to('/save-nfacture') !!}',
          data: {
            "_token": "{{ csrf_token() }}",
            'nFacture': nFacture, 'idForm': idForm, 'dtFacture': dtFacture
          },
          contentType: "application/x-www-form-urlencoded",
          success: function(data) {
            console.log(data);
            if (data[0].length == 0) { $('#saveBtn').html("Erreur"); }
            else {
              $('#saveBtn').html(data.msg);
              $('#saveBtn').css({
                outline: 'none',
                padding: '.4rem',
                backgroundColor: "#32CD32",
                color: "#ffffff",
                border: "none",
                boxShadow: '1px 2px 5px 2px #32CD3270'
              });
              // reset css btn after saving
              setTimeout(() => {
                $('#saveBtn').html("Enregistrer");
                $('#saveBtn').css({
                  outline: 'initial',
                  padding: '.4rem',
                  backgroundColor: "gray",
                  color: "#fff",
                  boxShadow: 'none'
                });
              }, 1000);
            }
            console.log(data);
          },
          error: (err) => { console.log(err); }
        });
      });
    });
</script>
{{-- ******************** --}}


</body>

</html>