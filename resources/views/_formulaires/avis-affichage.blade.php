<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Modèle 1</title>
  <script src={{ asset('js/jquery.js') }}></script>
  <script src={{ asset('js/myjs.js') }}></script>
</head>

<body>

  <style>
    * {
      box-sizing: border-box;
    }
    .paper {
      padding:20px; height:27.9cm; width:21cm; padding-left:.25px;
    }
    input, textarea { width:98%; padding: .2rem; margin: .1rem; border: none !important; outline: none !important; }
    textarea { resize: none; width: 99%; padding: .2rem; }
    .select { width:99%; padding: .2rem; border-color: #fff !important; outline-color: #fff !important;
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

  <div style="width:100%; height:50px;"><!--space--></div>
</div>


{{-- PAPER --}}
<div class="paper" style="padding:.5rem; font-family:Calibri, 'Segoe UI', Geneva, Verdana, sans-serif; background-color: #fff;">

  <div class="container center">
    <h1 style="padding: 5px !important; margin:0; font-size: 24px;">
      « Société
      <strong id="entrp">(Entreprise)</strong>
      »
    </h1>
  </div>

  <div class="container text-center">
    <h3 class="text-bold" style="text-transform: uppercase; margin-bottom: 10px !important;">
      Plan de formation
      <span name="year" id="year">(année)</span>
    </h3>

  </div>

  <div style="width:100%; height:15px;"><!--space--></div>

  <div class="container text-center" style="padding: 0px 50px 20px 50px;">
    <span>Nous informons l’ensemble du personnel que le plan de formation relatif à l’année <span id="year2">(année)</span> se présente comme suit :</span>
  </div>

  {{-- FORMATIONS --}}
  <table>
    <thead style="font-size:14px;">
      <tr>
        <th style="width:70%; padding: 1rem; font-size: 16px">Thème de l'action</th>
        <th style="width:30%; padding: 1rem; font-size: 16px">Dates de réalisation</th>
      </tr>
    </thead>

    <tbody id="tableFormation" class="center">
      {{-- auto filled --}}
    </tbody>
  </table>


</div>
{{-- END PAPER --}}



<script type="text/javascript">
  var count_td = 0;
  DatesPlan = (data) => {
    // return new Promise(resolve => {
      setTimeout(() => {
        var fillDates = "";
        let lastIndex = 0;
        for (let k = 0; k < data.length; k++) {
          if (Object.keys(data[k]).length != 0) {
            for (let x = 0; x < Object.keys(data[k]).length; x++) {
              let index = "date"+(x+1)+"";
              console.log((k+1)+"- "+index+" : "+data[k][index]);
              if (data[k][index] != null) {
                fillDates += '<span style="padding:.3rem;">'+DateFormat(data[k][index])+'</span><br>';
              } //endif
            } //endfor
            // $('#year').val((data[0]['date1']).getFullYear());
          }
          else {
            fillDates = `<span style="padding:.3rem;">(vide) vérifiez que vous avez saisi les dates ou la formation</span>`;
          } //endif
        } //endfor
        count_td++;
        $(`#td`+(count_td)).append(fillDates);
        console.log("fillDates ajax2 : " + fillDates);
      }, 500);
    // }); //promise
  } //fun

  // async function DatesPlanAsync(data) {
  //   return fillDates = await DatesPlan(data);
  // }

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

      var idPlan = $('#plans').val();
      $.ajax({
        type: 'GET',
        url: '{!! URL::to('/fill-plans-by-reference') !!}',
        data: {'idPlan': idPlan},
        success: function(data) {
          console.log("success plan formations !!", data);
          var fillFormations = "";
          var fillDates = "";
          for (let i = 0; i < data.length; i++) {
            let nForm = data[i].n_form;
            $.ajax({
              type: 'GET',
              url: '{!! URL::to('/fill-dates-plan') !!}',
              data: {'nForm': nForm},
              success: function(data) {
                DatesPlan(data);
              },
              error: function(err) { console.log("error getting dates !!", err); },
            }); //endajax
            fillFormations +=
            `<tr>`+
              `<td style="padding:.3rem;">`+data[i]['nom_theme']+`</td>`+
              `<td id="`+'td'+(i+1)+`">`+
                fillDates +
              `</td>`+
            `</tr>`;
            console.log("fill dates finally : " + fillDates);
          } //endfor
          console.log()
          $('#year').html(data[0]['annee']);
          $('#year2').html(data[0]['annee']);
          $('#tableFormation').html("");
          $('#tableFormation').append(fillFormations);
        },
        error: function(error) { console.log("error getting plan formations !!", error); }
      }); //ajax
      count_td = 0;
    }); //onChange "client"

  }); //ready
</script>






</body>
</html>
