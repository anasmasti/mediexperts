<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <script src={{ asset('js/jquery.js') }}></script>
    <script src={{ asset('js/NumberToLetter.js') }}></script>
    @php
      $infos_drb = \App\DemandeFinancement::select('demande_financements.*', 'clients.*')
              ->join('clients', 'demande_financements.nrc_e', 'clients.nrc_entrp')
              ->where('demande_financements.n_df', $df->n_df)
              ->first();
      $typeMiss = ($infos_drb->type_miss == "diagnostic stratégique") ? "DS" : "IF"
    @endphp
    <title>

      {{ $typeMiss." - ".$infos_drb->rais_abrev." -  Facture N ".$infos_drb->n_facture }}
    </title>
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
    .flex-nowrap {
      display: flex;
      flex-flow: row nowrap;
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
    .bu-print:hover {
      color: #fff;
      background-color: #393939;
      border-radius: 10px;
      background-position: left;
    }
    #footer {
        display: none !important;
    }
    /* [type="date"]::-webkit-inner-spin-button {
      display: none;
    }
    [type="date"]::-webkit-calendar-picker-indicator {
      opacity: 0;
    } */
    @media print {
      .hide-from-print { display: none !important; }
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
    .display-in-print { display: none; }
</style>

<div class="hide-from-print">
  <div style="display:flex; justify-content:space-between;">
    <a class="bu-print" id="" href="/df">Retour</a>
    <a class="bu-print" id="" href="#" onclick="window.print()">Imprimer le formulaire</a>
  </div>
</div>

<div class="" style="font-family:Calibri, 'Segoe UI', Geneva, Verdana, sans-serif; background-color: #fff; font-size: 16px;">

  <div class="" style="width:100%; height:100px;"><!--space--></div>

  <input type="hidden" id="ndf" value="{{$df->n_df}}" readonly>

  <div style="width: 100%; text-align: end">
    <div style="margin-left: auto">
      <span style="font-size: 18px;">
        Casablanca le
        <input type="date" name="date" id="dtFacture" style="font-size: 16px; width: 23%" value={{($df['dt_facture'] != null) ? $df['dt_facture'] : $df['dt_fin_miss']}}>
      </span>
    </div>
  </div>

  <div class="text-center">
    <h2 style="margin-bottom: 0 !important">
      {{"« ".$df['raisoci']." »"}}
    </h2>
    <h3 style="margin-top: 0 !important">
      {{-- I.C.E: {{ $df['ice'] }} --}}
    </h3>
  </div>

  <div class="text-center" style="font-size: 20px; padding-bottom: 30px">
    <span class="text-bold">
      Facture Pro-forma N°
    </span>
    <input type="text" id="nFacture" class="highlighted" maxlength="30" value="{{$df['n_facture']}}" style="width: 30%; font-size: 18px;">
    <button class="hide-from-print" type="submit" id="saveBtn">Enregister</button>
  </div>

  <table>
    <tr>
      <th style="width:40%; padding: 1rem;">Désignation</th>
      <th style="width:25%; padding: 1rem;">Prix Unitaire en DH (HT)</th>
      <th style="width:15%; padding: 1rem;">Nombre de jours</th>
      <th style="width:20%; padding: 1rem;">Prix Total en DH (HT)</th>
    </tr>
    <tr>
      <td style="padding: 2rem;">
        Réalisation d’une étude de <br />
        <strong>{{ ucfirst($df["type_miss"]) }}</strong> <br /><br />
        Excercice : {{$df["annee_exerc"]}} <br /><br />
        {{-- Du {{ Carbon\Carbon::parse($df["dt_debut_miss"])->format('d/m/Y') }} au {{ Carbon\Carbon::parse($df["dt_fin_miss"])->format('d/m/Y')}} --}}
      </td>
      <td style="padding: 1rem;">
        {{-- Prix unitaire (bdg_demandeé/jour_homme_validé) --}}
        {{ ($df["bdg_demande"] / $df["jr_hm_demande"]) }} <br />
      </td>
      <td style="padding: 1rem;">{{ $df["jr_hm_demande"] }}</td>
      <td style="padding: 1rem;">
        {{$df["bdg_demande"]}}
      </td>
    </tr>

    <tr>
      {{-- Prix total x 20% --}}
      <th colspan="3" style="padding: 1rem;">TVA 20%</th>
      <th>{{ ($df["bdg_demande"] * .2) }} DH</th>
    </tr>
    <tr>
      {{-- Prix total + TVA Prix total --}}
      <th colspan="3" style="padding: 1rem;">TOTAL TTC</th>
      <th>
        {{ $df['bdg_demande'] + ($df['bdg_demande'] * .2) }} DH
      </th>
    </tr>
    @php
    if($df['type_contrat'] != "normal")
    {
    echo '
    <tr>
      
      <th colspan="3" style="padding: 1rem;">QUOTE PART GIAC TIERS PAYANT H.T.</th>
      <th>';

        if ($df['prc_cote_part_demande'] == "30%")
        echo $df["bdg_demande"] * .7 .' DH';
        else if ($df['prc_cote_part_demande'] == "20%")
        echo $df["bdg_demande"] * .8 .' DH';
        echo '
      </th>
    </tr>
';
    
      echo '
      <tr >
      <th colspan="3" style="padding: 1rem;">
        QUOTE PART ENTREPRISE TTC
        (<span id="prcQuotePartGiac">';
          if ($df['prc_cote_part_demande'] == "30%")
            echo $df["prc_cote_part_demande"];
          else if ($df['prc_cote_part_demande'] == "20%")
            echo $df["prc_cote_part_demande"] ;
      echo ' </span> du montant Total H.T + TVA du montant global)
      </th>
      <th>';
        if ($df['prc_cote_part_demande'] == "30%")
          echo ($df["bdg_demande"] * .2) + ($df["bdg_demande"] * .3) .' DH';
        else if ($df['prc_cote_part_demande'] == "20%")
        echo ($df["bdg_demande"] * .2) + ($df["bdg_demande"] * .2) .' DH';
        echo '  </th>
    </tr>';

    }
    @endphp


      
    
  </table>

  <div style="width:100%; height:30px;"><!--space--></div>


  <div class="container">
    <span class="text-bold">Arrêtée la présente facture à la somme de : </span>
    <input type="text" id="montantText" class="" style="display: inline !important; width:50%" readonly>
  </div>


  {{-- <div class="container">
    <span class="text-bold">Mode et référence de paiement : </span>
    <input type="text" id="montant_text" class="highlighted" placeholder="........" style="display: inline !important; width:50%" value="{{ucfirst($df['moyen_fin']).' '.$df['ref_fin']}}">
  </div> --}}

  <div style="width:100%; height:25px;"><!--space--></div>

  <div id="footer" class="container" style="display:flex;flex-direction:column;justify-content:center;position:fixed !important; bottom:0; width:100%; padding-bottom:150px;background-color:red !important">
    <p style="margin: 20px; margin-left: 60%;text-align:center">RAID SOUFIANE, ADIL BELMOKADEM</p>
    <p style="margin: 5px; margin-left: 60%;text-align:center">CO-GÉRANTS</p>
  </div>

</div>

@php $bdgTTCLetter = ($df['bdg_demande'] + ($df['bdg_demande'] * .2)); @endphp

{{-- script to print page --}}
<script type="text/javascript">
    $(document).ready(function () {
      setTimeout(() => {
        let bdgLetterInput = $('#montantText');
        bdgLetterInput.val(NumberToLetter(@php echo $bdgTTCLetter; @endphp).toUpperCase() + " DIRHAMS");
      }, 1000);


      $('#saveBtn').on('click', function() {
        var ndf = $('#ndf').val();
        var nFacture = $('#nFacture').val();
        var dtFacture = $('#dtFacture').val();
        console.log("nFacture : "+nFacture+", ndf : "+ndf, 'dtFacture :'+dtFacture);
        $.ajax({
          type: 'POST',
          url: '{!! URL::to('/save-nfacture-df') !!}',
          data: {
            "_token": "{{ csrf_token() }}",
            'nFacture': nFacture, 'ndf': ndf, 'dtFacture': dtFacture
          },
          contentType: "application/x-www-form-urlencoded",
          success: function(data) {
            $('#saveBtn').html("...");
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
          },
          error: (err) => { console.log(err); }
        });
      });

    });
</script>
{{-- ******************** --}}


</body>

</html>
