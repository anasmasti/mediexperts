<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src={{ asset('js/jquery.js') }}></script>
  <title>Modèle 6</title>
</head>

<body>

<style>
  .paper {
    padding:20px; height:27.9cm; width:21cm; padding-left:.25px;
  }
  input { width:100%; padding: .2rem; border: none !important; outline: none !important; }
  .select { width:100%; padding: .2rem; margin: .1rem; border-color: #fff !important; outline-color: #fff !important;
    -moz-appearance:none; /* Firefox */
    -webkit-appearance:none; /* Safari and Chrome */
    appearance:none;
    cursor: pointer;
    background-color: #ffff00;
  }
  .select:hover {
    box-shadow: 0px 0px 1px 1px #00000059;
  }
  input { word-wrap: break-all; }
  input[type=radio] { outline: 1px solid #000; }
  input[type="readonly"] { background-color: #fff; }
  table {
    border: 1px solid #000; border-collapse: collapse; width:100%;
  }
  td, tr, th {
    border: 1px solid #000;
    padding: .2rem; border-collapse: collapse;
  }
  .flex-column {
    display: flex; flex-flow: column wrap; width:100%;
  }
  .flex-row {
    display: flex; flex-flow: row wrap; width:100%;
  }
  .container { width:100%; }
  .bordered { border: 1px solid #000; }
  .text-bold { font-weight: 600; }
  .text-center { text-align: center !important; }
  .center { justify-content: center !important; align-items: center; text-align: center; }
  .d-block { display: block; }
  .upper { text-transform: uppercase !important; }
  span { padding: .1rem; }
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
  @media print {
    .hide-from-print { display: none; }
    .select { background-color: #fff; }
  }
  #selectedCSP {
    font-weight: 700; text-align: center;
  }
</style>


{{-- PRINT - CANCEL --}}
<div class="hide-from-print">
  <div style="display:flex; justify-content:space-between;">
    <a class="bu-print" id="back" href="/">Retour</a>
    <a class="bu-print" id="buPrintF2" href="#" onclick="window.print()">Imprimer le formulaire</a>
  </div>

  <div style="width:100%;">
    <label for="client">Veuillez sélectionner l'entreprise :</label>
    <select name="client" id="client" style="width:100%; padding: .5rem; border: 1px solid #000;">
      <option selected disabled>--sélectionner l'entreprise</option>
      @foreach ($client as $cl)
        <option value="{{$cl->nrc_entrp}}">{{$cl->raisoci}}</option>
      @endforeach
    </select>
  </div>

  {{-- <div style="width:100%;">
    <label for="cabinet">Veuillez sélectionner le cabinet :</label>
    <select name="cabinet" id="cabinet" style="width:100%; padding: .5rem; border: 1px solid #000;">
      <option selected disabled>--sélectionner le cabinet</option>
      @foreach ($cabinet as $cab)
        <option value="{{$cab->nrc_cab}}">{{$cab->raisoci}}</option>
      @endforeach
    </select>
  </div> --}}

</div>

<div style="width:100%; height:50px;"><!--space--></div>


{{-- PAPER --}}
<div class="" style="padding:.5rem; font-family:Calibri, 'Segoe UI', Geneva, Verdana, sans-serif; background-color: #fff;">
  <div class="container flex-row bordered center">
    <span style="width:100%; font-size: 20px; font-weight:600;">Modèle 6</span>
    <span style="width:100%;">Attestation certifiant la réalisation des action</span>
  </div>

  <div style="width:100%; height:100px;"><!--space--></div>

  <div class="container flex-row center">
    <span style="width:100%; font-size: 18px; font-weight:600;">Modèle 6</span>
    <span style="width:100%; font-size: 17px; font-weight:600; padding: 10px;">Attestation certifiant la réalisation des actions</span>
  </div>

  <div style="width:100%; height:50px;"><!--space--></div>

  <div class="container">
    <p style="font-size:18px;">
      Je soussigne M
      <select class="select" id="dirigeant" style="width:auto !important; padding:0; margin:0; font-size:16px;">
        <option> …………….</option>
      </select>
      Qualité
      <select class="select" id="qualite" style="width:auto !important; padding:0; margin:0; font-size:16px;">
        <option value="">….....……….</option>
      </select>
      certifie par la
      présente   que   l’entreprise
      <span id="entrp">  ...…………………………....………</span>
           a     réalisée,   au  titre   de  l’exercice
      <span id="annee"></span>
      , les actions de formation citées ci après dans le cadre des Contrats
      Spéciaux de Formation et a procèdé à la liquidation des dépenses relatives des dites
      actions :
    </p>
  </div>

  <div class="container upper">
    <div id="themes" style="font-size:18px; padding-left:4rem;">
      {{-- auto filled --}}
    </div>
  </div>

  <div id="footer" class="container flex-row" style="position:fixed !important; bottom:0; width:100%; padding-bottom:200px;">

    <div style="margin-left: auto; padding-right: 5rem">
        <span id="dirigeant2" class="upper"></span><br>
        <span id="qualite2" class="upper"></span>
    </div>
  </div>


</div>
{{-- END PAPER --}}


<script type="text/javascript">
  $(document).ready(function() {
    $('#client').on('change', function() {
      let nrcEntrp = $('#client').val();
      let fillThemes = "";
      $.ajax({
        type: 'GET',
        url: '/fill-plan-theme',
        data: {'nrcEntrp': nrcEntrp},
        success: function(data) {
          console.log("success themes !!", data);
          if (data) {
            for (let i = 0; i < data.length; i++) {
              fillThemes += `<span class="container">- `+data[i]['nom_theme']+`</span><br>`;
            } //endfor
            let dgs = `<option>`+data[0]['nom_dg1']+`<option>`+data[0]['nom_dg2'];
            let qualite = `<option>`+data[0]['fonct_dg1']+`</option>`+`<option>`+data[0]['fonct_dg2']+`</option>`;
            $('#dirigeant').html("");
            $('#dirigeant').append(dgs);
            $('#qualite').html("");
            $('#qualite').append(qualite);
            $('#entrp').html(data[0]['raisoci']);
            $('#dirigeant2').html(data[0]['nom_dg1'] + ', ');
            $('#qualite2').html(data[0]['fonct_dg1']);
            $('#annee').html(data[0]['annee']);
            $('#themes').html(fillThemes);
          } //if data
          else {
            fillThemes = `<span class="container" style="padding:5px !important;">aucune formation à afficher</span><br>`;
          } //endif
        },
        error: function(err) { console.log("error getting themes !!", err); }
      }); //ajax
    }); //onChange 'client'

    // $('#cabinet').on('change', function() {
    //   let nrcCab = $('#cabinet').val();
    //   let fillThemes = "";
    //   $.ajax({
    //     type: 'GET',
    //     url: '{!! URL::to('/fill-cabinet') !!}',
    //     data: {'nrcCab': nrcCab},
    //     success: function(data) {
    //       console.log("success cabinet !!", data);
    //       let dgs = `<option>`+data['nom_gr1']+" "+ data['pren_gr1']+`</option>`
    //       + `<option>`+data['nom_gr2']+" "+data['pren_gr2']+`</option>`;
    //       let qualite = `<option>`+data['qualit_gr1']+`</option>`
    //       + `<option>`+data['qualit_gr2']+`</option>`;
    //       $('#dirigeant').html("");
    //       $('#dirigeant').append(dgs);
    //       $('#qualite').html("");
    //       $('#qualite').append(qualite);
    //     },
    //     error: function(err) { console.log("error getting themes !!", err); }
    //   }); //ajax
    // }); //onChange 'cabinet'

  }); //ready
</script>
