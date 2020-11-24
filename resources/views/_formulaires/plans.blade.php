<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src={{ asset('js/jquery.js') }}></script>
  <script src={{ asset('js/myjs.js') }}></script>
  <title>Plans de formation</title>
</head>

<body>

<style>
  .paper {
    padding:20px; height:27.9cm; width:21cm; padding-left:.25px;
  }
  input { width:100%; padding: .2rem; border: none !important; outline: none !important; }
  .select { width:100%; padding: .2rem; margin: .1rem; border-color: #fff !important; outline-color: #fff !important;
    -moz-appearance:none;
    -webkit-appearance:none;
    appearance:none;
    cursor: pointer;
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
  .td { background-color: #c2c2c2 !important; text-align: center; align-self: center; }
  .text-orient { writing-mode: vertical-rl; text-orientation: upright; }
  .flex-column {
    display: flex; flex-flow: column wrap; width:100%;
  }
  .flex-row {
    display: flex; flex-flow: row wrap; width:100%;
  }
  .container { width:100%; padding: .4rem; }
  .bordered { border: 1px solid #000; }
  .text-bold { font-weight: 600; }
  .text-center { text-align: center !important; }
  .center { justify-content: center !important; align-items: center; text-align: center; }
  .d-block { display: block; }
  span { padding: .1rem; }
  .bu-print {
    padding:0; margin:0 0 50px 0;
    display: inline-block; width:47%; height:50px;
    color:#393939; border-radius:5px; text-align:center; line-height:1.75;
    font-size:25px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; text-decoration:none;
    border: 2px solid #393939;
    transition: .2s all ease-in;
  }
  .bu-print:hover {
    color: #fff;
    background-color: #393939;
    border-radius: 10px;
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
<div class="" style="padding:.5rem; font-family: Calibri, 'Segoe UI', Geneva, Verdana, sans-serif; background-color: #fff; font-size: 13px;">
  
  <div class="hide-from-print" style="width:100%; height:10px;"><!--space--></div>

  <table>
    <thead>
      <tr>
        <td style="width: 3%;" class="td">N° Action</td>
        <td style="width: 10%;" class="td">Domaine</td>
        <td style="width: 10%;" class="td">Thème</td>
        <td style="width: 5%;" class="td">Dates de réalisation</td>
        <td style="width: 5%;" class="td">Organisme de formation</td>
        <td style="width: 5%;" class="td">N° CNSS de l'organisme</td>
        <td style="width: 3%;" class="td">Effectif</td>
        <td style="width: 3%;" class="td">Cadres</td>
        <td style="width: 3%;" class="td">Employés</td>
        <td style="width: 3%;" class="td">Ouvriers</td>
        <td style="width: 3%;" class="td">Durée par groupe</td>
        <td style="width: 10%;" class="td">Lieu de formation</td>
        <td style="width: 3%;" class="td">Nbre de groupe</td>
        <td style="width: 4%;" class="td">Coût unitaire (DH)</td>
        <td style="width: 4%;" class="td">Coût estimatif (DH)</td>
      </tr>
    </thead>

    <tbody id="tablePlans">
      {{-- auto filled --}}
    </tbody>

  </table>
</div>
{{-- END PAPER --}}





<script type="text/javascript">
  var count_td = 0;
  DatesPlan = (data) => {
      setTimeout(() => {
        var fillDates = "";
        let lastIndex = 0;
        for (let k = 0; k < data.length; k++) {
          if (Object.keys(data[k]).length != 0) {
            for (let x = 0; x < Object.keys(data[k]).length; x++) {
              let index = "date"+(x+1)+"";
              console.log((k+1)+"- "+index+" : "+data[k][index]);
              if (data[k][index] != null) {
                fillDates += '<span style="padding:.2rem;">'+DateFormat(data[k][index])+'</span><br>';
              } //endif
            } //endfor
          }
          else {
            fillDates = `<span style="padding:.3rem;">(vide) vérifiez que vous avez saisi les dates ou la formation</span>`;
          } //endif
        } //endfor
        count_td++;
        $(`#td`+(count_td)).append(fillDates);
        console.log("fillDates ajax2 : " + fillDates);
      }, 500);
  } //fun

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
          var totalCoutEstim = null;
          for (let i = 0; i < data.length; i++) {
            totalCoutEstim += data[i].bdg_total;
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
              `<tr><td>${data[i].n_action}</td>`+
              `<td>`+data[i]['nom_domain']+`</td>`+
              `<td>`+data[i]['nom_theme']+`</td>`+
              `<td style="font-size:12.5px;" id="`+'td'+(i+1)+`">`+
                fillDates +
              `</td>`+
              `<td>`+data[i]['raisoci_cab']+`</td>`+
              `<td>`+data[i]['ncnss_cab']+`</td>`+
              `<td>`+data[i]['nb_partcp_total']+`</td>`+
              `<td>`+data[i]['nb_cadre']+`</td>`+
              `<td>`+data[i]['nb_employe']+`</td>`+
              `<td>`+data[i]['nb_ouvrier']+`</td>`+
              `<td>`+data[i]['nb_jour']+`</td>`+
              `<td>`+data[i]['lieu']+`</td>`+
              `<td>`+data[i]['nb_grp']+`</td>`+
              `<td>`+data[i]['bdg_jour']+`</td>`+
              `<td>`+(data[i]['bdg_total'] * data[i]['nb_grp'])+`</td></tr>`;
            console.log("fill dates finally : " + fillDates);
          } //endfor
          // ajouter la somme des montants après la boucle du tableau
          fillFormations +=  
            `<tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><strong>Total ${totalCoutEstim}</strong></td>
            </tr>`;
          $('#tablePlans').html("");
          $('#tablePlans').append(fillFormations);
        },
        error: function(error) { console.log("error getting plan formations !!", error); }
      }); //ajax
      count_td = 0;
    }); //onChange "plans"

  }); //ready
</script>




</body>
</html>
