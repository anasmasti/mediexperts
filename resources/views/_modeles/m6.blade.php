<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src={{ asset('js/jquery.js') }}></script>
  <script src={{ asset('js/myjs.js') }}></script>
  <title id="docTitle">Modèle 6</title>
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
    html, body {
    width: 210mm;
    height: 297mm;       
  }
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
    <a class="bu-print" id="backBtn" href="/">Retour</a>
    <a class="bu-print" id="buPrintM6" href="#" onclick="window.print()">Imprimer le formulaire</a>
  </div>

  <div style="width:100%;">
    <label for="client">Entreprise :</label>
    <select name="client" id="client" style="width:100%; padding: .5rem; border: 1px solid #000;">
      <option selected disabled>--sélectionner l'Entreprise ..</option>
      @foreach ($client as $cl)
        <option value="{{$cl->nrc_entrp}}">{{$cl->raisoci}}</option>
      @endforeach
    </select>
  </div>

  <div style="width:100%;">
    <label for="plans">Réference plan de formation :</label>
    <select name="plans" id="plans" style="width:100%; padding: .5rem; border: 1px solid #000;">
      {{-- auto filled --}}
    </select>
  </div>

</div>

<div style="width:100%; height:50px;"><!--space--></div>


{{-- PAPER --}}
<div class="" style="padding:.5rem; font-family:Calibri, 'Segoe UI', Geneva, Verdana, sans-serif; background-color: #fff;">
  <div class="container flex-row bordered center">
    <span style="width:100%; font-size: 20px; font-weight:600;">Modèle 6</span>
    <span style="width:100%;">Attestation certifiant la réalisation des actions</span>
  </div>

  <div style="width:100%; height:100px;"><!--space--></div>

  <div class="container flex-row center">
    <span style="width:100%; font-size: 18px; font-weight:600;">Modèle 6</span>
    <span style="width:100%; font-size: 17px; font-weight:600; padding: 10px;">Attestation certifiant la réalisation des actions</span>
  </div>

  <div style="width:100%; height:50px;"><!--space--></div>

  <div class="container">
    <p style="font-size:18px;">
      Je soussigne 
      <select class="select" name="genre" style="width:auto !important; padding:0; margin:0; font-size:16px;" id="genre">
        <option value="Mr">Mr</option>
        <option value="Mme">Mme</option>
      </select>
      <select class="select" id="dirigeant" style="width:auto !important; padding:0; margin:0; font-size:16px;">
        <option>.......</option>
      </select>
      Qualité
      <select class="select" id="qualite" style="width:auto !important; padding:0; margin:0; font-size:16px;">
        <option value="">.......</option>
      </select>
      certifie par la
      présente que l’entreprise
      <strong><span id="entrp">...........</span></strong>
           a réalisée, au titre de l’exercice
           <strong>
      <span id="annee"></span>

           </strong>
      , les actions de formation citées ci après dans le cadre des Contrats
      Spéciaux de Formation et a procèdé à la liquidation des dépenses relatives des dites
      actions :
    </p>
  </div>

  <div class="container">
    <div id="themes" style="font-size:18px; padding-left:4rem;">
      {{-- auto filled --}}
    </div>
  </div>

  <div id="footer" class="container flex-row mt-5" style="position:fixed !important; bottom:0; width:100%; padding-bottom:190px;">

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
      var nrcEntrp = $('#client').val();
      $.ajax({
        type: 'GET',
        url: '{!! URL::to('/fill-reference-plan') !!}',
        data: {'nrcEntrp': nrcEntrp},
        success: function(data) {
          console.log("success ref pdf !!", data);
          fillReference = '<option selected disabled>--sélectionner le réference</option>';
          if (data) {
            for (let i = 0; i < data.length; i++) {
              fillReference += `<option value="${data[i].id_plan}">${data[i].refpdf}</option>`;
            }
          } else {
            fillReference = '<option selected disabled>(vide) aucun plan pour l\'entreprise sélectionné</option>';
          }
          $('#entrp').html(data[0]['raisoci'].toUpperCase());
          $('#plans').html("");
          $('#plans').append(fillReference);
        },
        error: function(error) { console.log("error getting reference plans !!", error); }
      }); //ajax
    }); //onChange "client"

    $('#plans').on('change', function() {
      let idPlan = $('#plans').val();
      let fillThemes = "";
      $.ajax({
        type: 'GET',
        url: '/fill-plan-theme',
        data: {'idPlan': idPlan},
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
            $('#docTitle').html(`Modèle 6 - ${data[0]['raisoci']} - ${data[0]['annee']}`);
          } //if data
          else {
            fillThemes = `<span class="container" style="padding:5px !important;">aucune formation à afficher</span><br>`;
          } //endif
        },
        error: function(err) { console.log("error getting themes !!", err); }
      }); //ajax
    }); //onChange 'plans'

  }); //ready
</script>



</body>
</html>
