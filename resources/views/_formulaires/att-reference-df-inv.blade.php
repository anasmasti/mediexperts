<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title id="docTitle">Att. Référ. Intervenant</title>
  <script src={{ asset('js/jquery.js') }}></script>
  <script src={{ asset('js/myjs.js') }}></script>
</head>

<body>

  <style>
    * { box-sizing: border-box; }
    .paper {
      padding:20px; height:27.9cm; width:21cm; padding-left:.25px;
    }
    input, textarea { width:98%; padding: .2rem; margin: .1rem; border: none !important; outline: none !important; }
    textarea { resize: none; width: 99%; padding: .2rem; }
    .select {
      /* border-color: #fff !important; outline-color: #fff !important; */
      -moz-appearance:none; /* Firefox */
      -webkit-appearance:none; /* Safari and Chrome */
      appearance:none;
      cursor: pointer;
    }
    .select:hover { box-shadow: 0px 0px 1px 1px #00000059; }
    input { word-wrap: break-all; }
    input[type=radio] { display: inline; width: auto !important; }
    input[type="readonly"] { background-color: #fff; }
    table { border: 1px solid #000; border-collapse: collapse; width:100%; }
    td, tr, th {
      border: 1px solid #000;
      padding: .2rem; border-collapse: collapse;
    }
    .flex-column { display: flex; flex-flow: column wrap; width:100%; }
    .flex-row { display: flex; flex-flow: row wrap; width:100%; }
    .flex-nowrap { display: flex; flex-wrap: nowrap; width:100%; }
    .container { width:100%; padding: .2rem; }
    .bordered { border: 1px solid #000; }
    .text-bold { font-weight: 600; }
    .text-center { text-align: center !important; }
    .center { justify-content: center !important; align-items: center; text-align: center; }
    .d-block { display: block; }
    .d-flex { display: flex; }
    span { padding: .1rem; }
    .highlighted { background-color: #ffff99 !important; }
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
      .highlighted { background-color: #fff !important; }
      .select {
        border-color: #fff !important; outline-color: #fff !important;
        -moz-appearance:none; /* Firefox */
        -webkit-appearance:none; /* Safari and Chrome */
        appearance:none;
        cursor: pointer;
      }
    }
  </style>

{{-- PRINT - CANCEL --}}
<div class="hide-from-print">
  <div style="display:flex; justify-content:space-between;">
    <a class="bu-print" id="back" href="/">Retour</a>
    <a class="bu-print" id="buPrintAttRefDf" href="#" onclick="window.print()">Imprimer le formulaire</a>
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
  <input type="hidden" id="titleNomEntrp" value="">



  <div style="width:100%;">
    <label for="df">Demande de financement :</label>
    <select name="df" id="df" style="width:100%; padding: .5rem; border: 1px solid #000;">
      {{-- auto filled --}}
    </select>
  </div>

  <div style="width:100%; height:50px;"><!--space--></div>
</div>


{{-- PAPER --}}
<div class="" style="padding:.5rem; font-family:Calibri, 'Segoe UI', Geneva, Verdana, sans-serif; background-color: #fff; font-size: 20px">

  <div class="container pt">
    <h3 class="text-center" style="text-decoration: underline; padding: 50px 0;">ATTESTATION DE REFERENCE</h3>
    <p style="text-align: justify; text-justify: initial; line-height: 1.7rem; font-weight: 300;">
      Nous soussignés,
      « <strong class="" id="entrp">(Entreprise)</strong> » ,
      <span id="entrpFormJury">(forme juridique entrp.)</span>
      au capital de
      <span class="" id="entrpCapital">(capital entrp.)</span> Dirhams,
      dont le siège est sis à
      <span class="" id="entrpSiege">(siège entreprise)</span>
      représentée par Son
      <span class="" id="entrpDgFonction">(fonction directeur entrp.)</span>
      <select class="select highlighted" style="font-size: 18px;">
        <option value="">M.</option>
        <option value="">Mme.</option>
      </select>
      <strong class="" id="entrpDgNom">(nom directeur entrp.)</strong>,

      attestons par la présente que
      <select class="select text-bold highlighted" style="font-size: 18px;">
        <option value="">M.</option>
        <option value="">Mme.</option>
      </select>
      <select id="interv" class="select text-bold highlighted" style="font-size: 18px;">
        @foreach ($interv as $inv)
          <option value="{{$inv->id_interv}}">{{mb_strtoupper($inv->nom)}} {{mb_strtoupper($inv->prenom)}}</option>
        @endforeach
      </select>,
      consultant au cabinet
      <select id="cabinet" class="select highlighted" style="font-size: 18px;">
        @foreach ($cabinet as $cab)
          <option value="{{$cab->nrc_cab}}">{{mb_strtoupper($cab->raisoci)}}</option>
        @endforeach
      </select>,
      <span class="" id="cabinetFormJury">{{$cabinet[0]['formjury']}}</span>
      au capital de
      <span class="" id="cabinetCapital">{{$cabinet[0]['cap_soci']}}</span> Dirhams,
      inscrit au registre de commerce de Casablanca sous le numéro
      <span class="" id="cabinetRC">{{$cabinet[0]['nrc_cab']}}</span>
      et inscrit à la CNSS sous le numéro
      <span class="" id="cabinetCnss">{{$cabinet[0]['ncnss']}}</span>,
      dont le siège social est sis au
      <span class="" id="cabinetAdress">{{$cabinet[0]['adress']}}</span>

      a réalisé pour le compte de notre société au titre de l’année
      <span class="" id="anneeMiss">(année mission)</span>,
      une mission de
      « <strong class="" id="typeMiss">(type mission)</strong> »,
      Pour un montant global de
      <strong class="" id="montantMiss">(montant HT mission)</strong>
      <strong> Dirhams HT</strong>
      et une durée de
      <span class="" id="jourMiss">(nb. jour mission)</span> jours.
    </p>

    <input type="hidden" id="titleTypeMiss" value="">
    <input type="hidden" id="titleAnneeMiss" value="">

    <p style="text-align: justify; text-justify: initial; line-height: 1.7rem; font-weight: 300; padding: 40px 0px 10px 0px;">
      <select class="select text-bold highlighted" style="font-size: 18px;">
        <option value="">M.</option>
        <option value="">Mme.</option>
      </select>
      <strong id="nomPrenomInv" >{{mb_strtoupper($interv[0]['nom'])}} {{mb_strtoupper($interv[0]['prenom'])}}</strong> a répondu à nos attentes et a donné entière satisfaction.
    </p>
    <input type="hidden" id="titleNomInterv" value="{{mb_strtoupper($interv[0]['nom'])}}">
    
    <p style="text-align: justify; text-justify: initial; line-height: 1.7rem; font-weight: 300;">
      La présente attestation est établie pour servir et valoir ce que de droit.
    </p>

    <div id="footer" class="container" style="position:fixed !important; bottom:0; width:100%; padding-bottom:150px;">
      <p style="margin: 20px; margin-left: 50%">
        Fait à <span id='entrpVille'>--</span> le
        <input type="date" name="" id="lastDate" style="width: 50%; font-size: 17px;" />

        <div class="text-center" style="margin: 20px; margin-left: 50%;">
          <span>Direction</span>
          <p style="display: block;" id="entrpNom">(.......)</p>
        </div>

      </p>
    </div>

  </div>

</div>
{{-- END PAPER --}}




<script type="text/javascript">

  $(document).ready(function() {

    $('#client').on('change', function() {
      var nrcEntrp = $(this).val();

      $.get('/fill-df-list', {'nrcEntrp': nrcEntrp})
        .then(function(data) {
          console.log("success fill df list", data);

          var fillDropdownDS = '<option selected disabled>--sélectionner la mission</option>';
          if (data.length) {
            // fill dropdown demande financement
            data.forEach(elem => {
              fillDropdownDS += `<option value="${elem.n_df}">${elem.annee_exerc} ► ${(elem.type_miss).toUpperCase()}</option>`
            });
            $('#df').html("");
            $('#df').append(fillDropdownDS);
            // donnée entreprise
            $('#entrp').html(data[0].raisoci);
            $('#entrpCapital').html(data[0].capt_soci);
            $('#entrpFormJury').html(data[0].formjury);
            $('#entrpSiege').html(data[0].sg_soci);
            $('#entrpDgNom').html(data[0].nom_dg1);
            $('#entrpDgFonction').html(data[0].fonct_dg1);
            $('#entrpNom').html(data[0].raisoci);
            $('#entrpVille').html(data[0].ville);
            $('#titleNomEntrp').val(data[0].raisoci);
          } else {
            fillDropdownDS = '<option selected disabled>(vide) aucune mission</option>';
            $('#df').append(fillDropdownDS);
            // reset
            $('#entrp,#entrpFormJury,#entrpCapital,#entrpSiege,#entrpDgFonction,#entrpDgNom,#anneeMiss,#typeMiss,#montantMiss,#jourMiss').html("........");
          }
        }).then(function() {
          return console.log("data finished loading !");
        });

    }); //onChange "client"

    $('#df').on('change', function() {
      var ndf = $(this).val();

      $.get('/find-df-info', {'ndf': ndf})
        .then(function(data) {
          console.log("success findDfInfo", data);
          if (Object.keys(data).length) {
            // donnée de la mission
            $('#anneeMiss').html(data.annee_exerc);
            $('#typeMiss').html((data.type_miss).toUpperCase());
            $('#montantMiss').html(data.bdg_accord);
            $('#jourMiss').html(data.jr_hm_valid);
            $('#lastDate').val(data.dt_fin_miss);
            $('#titleTypeMiss').val(data.type_miss);
            $('#titleAnneeMiss').val(data.annee_exerc);
            $('#docTitle').html(`AR - ${$('#titleNomEntrp').val()} - ${$('#titleNomInterv').val()} - ${$('#titleTypeMiss').val()} - ${$('#titleAnneeMiss').val()}`);
             
          } else {
            // reset
            $('#anneeMiss,#typeMiss,#montantMiss,#jourMiss').html("....5....");
          }
        });

    }); //onChange "client"

    $('#cabinet').on('change', function() {
      var nrcCab = $('#cabinet').val();
      $.get('/find-cab-info', {'nrcCab': nrcCab})
        .then(function(data) {
          if (Object.keys(data).length) {
            $('#cabinet_2').html(data.raisoci);
            $('#cabinetCapital').html(data.capt_soci);
            $('#cabinetFormJury').html(data.formjury);
          } else {
            $('#cabinet,cabinetCapital,cabinetFormJury').html('.......')
          }
        });
    });

    $('#interv').on('change', function() {
      // resize dependig option text size
      var text = $(this).find('option:selected').text();
      var $aux = $('<select/>').append($('<option/>').text(text));
      $(this).after($aux);
      $(this).width($aux.width() * 1.3);
      $aux.remove();

      var idInv = $('#interv').val();
      $.get('/find-inv-info', {'idInv': idInv})
        .then(function(data) {
          console.log("success interv : ", data);
          if (Object.keys(data).length) {
            $('#nomPrenomInv').html((data.nom+" "+data.prenom).toUpperCase());
            $('#titleNomInterv').val(data.nom);
            $('#docTitle').html(`AR - ${$('#titleNomEntrp').val()} - ${$('#titleNomInterv').val()} - ${$('#titleTypeMiss').val()} - ${$('#titleAnneeMiss').val()}`);

          } else {
            $('#nomPrenomInv').html('.......');
          }
        })
    });

    $(document).on('change', () => {
      $('#docTitle').html(`AR  - ${$('#titleNomEntrp').val()} - ${$('#titleNomInterv').val()} - ${$('#titleTypeMiss').val()} - ${$('#titleAnneeMiss').val()}`);
    });

  }); //ready
</script>






</body>
</html>
