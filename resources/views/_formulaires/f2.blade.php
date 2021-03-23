<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title id="docTitle">Formulaire 2</title>
  <script src={{ asset('js/jquery.js') }}></script>
  <script src={{ asset('js/myjs.js') }}></script>
</head>
<body>
  <style>
    * { box-sizing: border-box; }
    .paper {
      padding:20px; height:27.9cm; width:21cm; padding-left:.25px;
    }
    input, textarea { width:97%; padding: .2rem; margin: .1rem; border: none !important; outline: none !important; }
    .select { width:97%; padding: .2rem; border-color: #fff !important; outline-color: #fff !important;
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
    .container { width:100%; padding: .2rem; }
    .bordered { border: 1px solid #000; }
    .highlighted { background-color: #ffff00 !important; }
    .text-bold { font-weight: 600; }
    .text-center { text-align: center !important; }
    .center { justify-content: center !important; align-items: center; text-align: center; }
    .d-block { display: block; }
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
    .display-in-print { display: none; }
    @media print {
      .hide-from-print { display: none; }
      .display-in-print { display: block; }
      .highlighted { background-color: #fff !important; }
      textarea { resize: none; width: 99%; padding: .2rem; }
    }
    #selectedCSP {
      font-weight: 700; text-align: center;
    }
    .date-f2:not(:last-child)::after {
      content: " ;"
    }
  </style>
{{-- PRINT - CANCEL --}}
<div class="hide-from-print">
  <div style="display:flex; justify-content:space-between;">
    <a class="bu-print" id="back" href="/">Retour</a>
    <a class="bu-print" id="buPrintF2" href="#" onclick="window.print()">Imprimer le formulaire</a>
  </div>

  <div style="width:100%;">
    <label for="plans">Sélectionner le plan de formation :</label>
    <select name="plans" id="plans" style="width:100%; padding: .5rem; border: 1px solid #000;">
      <option selected disabled>--sélectionner le plan</option>
      @foreach ($plans as $pdf)
        <option value="{{$pdf->id_plan}}">Réf. {{$pdf->refpdf}} {{">"}} {{$pdf->raisoci}}</option>
    <label for="client">Sélectionner la societe :</label>
    <select name="client" id="client" style="width:100%; padding: .5rem; border: 1px solid #000;">
      <option selected disabled>--sélectionner la societe</option>
      @foreach ($clients as $clt)
        <option value="{{$clt->nrc_entrp}}" > {{$clt->raisoci}} </option>
      @endforeach
    </select>
  </div>

  <div style="width:100%;">
    <label for="plan">Sélectionner l'action de formation :</label>
    <label for="plan">Sélectionner Annee :</label>
    <select name="plan" id="plan" style="width:100%; padding: .5rem; border: 1px solid #000;">
      {{-- <option selected disabled>--sélectionner l'action</option>
      @foreach ($plan as $pf)
@@ -298,14 +298,14 @@
<script type="text/javascript">
  $(document).ready(function() {
    $('#plans').on('change', function() {
      let idPlan = $('#plans').val();
    $('#client').on('change', function() {
      let nrc = $('#client').val();
      let fillDropdown = '';
      $.get('/fill-action-form', {'idPlan': idPlan})
      $.get('/fill-plan-by-client', {'nrc': nrc})
        .done((data) => {
          console.log("success action !!", data);
          data.forEach(elem => {
            fillDropdown += `<option value="${elem.n_form}">${elem.n_action} > ${elem.nom_theme} </option>`;
            fillDropdown += `<option value="${elem.id_plan}">${elem.refpdf}</option>`;
          });
          // affecter les données dans select
          $('#plan').html("");
          if (data.length) {
            $('#plan').append('<option selected disabled>--sélectionner une action</option>');
            $('#plan').append(fillDropdown);
          }
          else {
            $('#plan').append('<option selected disabled>(vide) aucune action</option>');
          }
        }) //done
        .catch(err => console.log("error getting actions !!", error));
    }); //onChange "plans"
    $('#plan').on('change', function() {
      // vider les champs
      $('#formation').html(""); $('#domaine').val("");
      $('#objectif').val(""); $('#contenu').val("");
      $('#coutForm').val(""); $('#tableEffectif').empty(); $('#tableFormation').empty();
      $('#cabinet').val(""); $('#cnss').val("");
      $('#inter').prop("checked", false);
      $('#intra').prop("checked", false);
      let nForm = $('#plan').val();
      $.ajax({
        type: 'GET',
        url: '{!! URL::to('/fill-form-f2') !!}',
        data: {'nForm': nForm},
        success: function(data) {
          console.log("success formations !!", data);
          let fillEffectif = "";
          let fillForm = "";
          let fillDates = "";
          if (data.length > 0) {
            let theme = "";
            for (let i = 0; i < data.length; i++) {
              //une boucle pour récupérer les (date1, date2, date3 ...) d'enregistrement data[i]
              for (let k = 1; k <= 30; k++) {
                let currDate = "date"+k;
                // console.log(currDate + " : " + data[i][currDate]);
                if (data[i][currDate] != null) {
                  fillDates += `<span class="date-f2">`+DateFormat(data[i][currDate])+`</span>`;
                }
              } //endfor 'k'
              // console.log(fillDates);
              fillForm =
              `<tr>`+
                `<td>`+data[i]['groupe']+`</td>`+
                `<td>`+data[i]['nb_benif']+`</td>`+
                `<td style="max-width: 200px;">` +
                  fillDates +
                `</td>`+
                `<td>`+data[i]['hr_debut']+`</td>`+
                `<td>`+data[i]['hr_fin']+`</td>`+
                `<td>`+data[i]['lieu']+`</td>`+
              `</tr>`;
              $('#tableFormation').append(fillForm);
              fillDates = ""; //avoid duplicated date from the first record ex: data[0].date..
            } //endfor
            //remplir les autres données dehors la boucle
            theme += `<option value=`+data[0]['id_form']+` selected disabled>${data[0]['nom_theme']}</option>`;
            $('#formation').append(theme);
            $('#domaine').val(data[0]['nom_domain']);
            $('#objectif').val(data[0]['objectif']);
            $('#contenu').val(data[0]['contenu']);
            $('#coutForm').val((data[0]['bdg_total'] * data[0]['nb_grp']) + " DH");
            $('#cabinet').val(data[0]['raisoci_cab']);
            $('#cnss').val(data[0]['ncnss']);
            $('#nAction').html(data[0]['n_action']);
            $('#docTitle').html(`${data[0]['refpdf']} - ${data[0]['n_action']} - ${data[0]['nom_theme']}`);
            // affecter la pause a partir du 1er groupe
            if (data[0].pse_debut != "00:00" && data[0].pse_fin != "00:00") {
                $('#pseDebut').html(data[0].pse_debut);
                $('#pseFin').html(data[0].pse_fin);
                $('#pause').show(300);
            } else {
                // clear
                $('#pseDebut').html("");
                $('#pseFin').html("");
                $('#pause').hide(300); // hide si ya pas de pause
            }
            if (data[0].type_form.toLowerCase() == "intra-entreprise") {
              $('#intra').prop("checked", true); $('#inter').prop("checked", false); }
            else { $('#inter').prop("checked", true); $('#intra').prop("checked", false); }
            fillEffectif =
            `<tr>`+
              `<td>`+data[0]['nb_cadre']+`</td>`+
              `<td>`+data[0]['nb_employe']+`</td>`+
              `<td>`+data[0]['nb_ouvrier']+`</td>`+
              `<td>`+data[0]['nb_partcp_total']+`</td>`+
            `</tr>`;
            $('#tableEffectif').append(fillEffectif);
          }
          else {
            $('#formation').append('<option selected disabled>(vide) aucune formation</option>');
          }
        },
        error: function(error) { console.log("error getting formations !!", error) }
      }); //ajax
    }); //onChange "plan"
    // $('#formation').on('change', function() {
    //   // vider les champs
    //   $('#domaine').val(); $('#objectif').val(""); $('#contenu').val("");
    //   $('#coutForm').val(""); $('#tableEffectif').empty(); $('#tableFormation').empty();
    //   $('#cabinet').val(""); $('#cnss').val("");
    //   $('#inter').prop("checked", false);
    //   $('#intra').prop("checked", false);
    //   let idForm = $('#formation').val();
    //   $.ajax({
    //     type: 'GET',
    //     url: '{!! URL::to('/fill-form-info') !!}',
    //     data: {'idForm': idForm},
    //     success: function(data) {
    //       console.log("success formations !!", data);
    //       // if (data) {
    //       //   let fillEffectif =
    //       //   `<tr>`+
    //       //     `<td>`+data.nb_cadre+`</td>`+
    //       //     `<td>`+data.nb_permanent+`</td>`+
    //       //     `<td>`+data.nb_ouvrier+`</td>`+
    //       //     `<td>`+data.effectif+`</td>`+
    //       //   `</tr>`;
    //       //   let fillForm =
    //       //   `<tr>`+
    //       //     `<td>`+data.groupe+`</td>`+
    //       //     `<td>`+data.effectif+`</td>`+
    //       //     `<td>` +
    //       //       `<span style="padding:.3rem;">`+data.date1+`</span>`+`<br>` +
    //       //       `<span style="padding:.3rem;">`+data.date2 +`</span>`+`<br>` +
    //       //       `<span style="padding:.3rem;">`+data.date3 +`</span>`+`<br>` +
    //       //       `<span style="padding:.3rem;">`+data.date4 +`</span>`+`<br>` +
    //       //       `<span style="padding:.3rem;">`+data.date5 +`</span>`+`<br>` +
    //       //       `<span style="padding:.3rem;">`+data.date6 +`</span>`+
    //       //     `</td>`+
    //       //     `<td>`+data.hr_debut+`</td>`+
    //       //     `<td>`+data.hr_fin+`</td>`+
    //       //     `<td>`+data.lieu+`</td>`+
    //       //   `</tr>`;
    //       //   $('#domaine').val(data['nom_domain']);
    //       //   $('#objectif').val(data['objectif']);
    //       //   $('#contenu').val(data['contenu']);
    //       //   $('#coutForm').val(data['bdg_total'] + " DH");
    //       //   $('#tableEffectif').append(fillEffectif);
    //       //   $('#tableFormation').append(fillForm);
    //       //   $('#cabinet').val(data['raisoci_cab']);
    //       //   $('#cnss').val(data['ncnss']);
    //       //   if (data.type_form.toLowerCase() == "intra-entreprise") {
    //       //     $('#intra').prop("checked", true);
    //       //     $('#inter').prop("checked", false);
    //       //   }
    //       //   else {
    //       //     $('#inter').prop("checked", true);
    //       //     $('#intra').prop("checked", false);
    //       //   }
    //       // } // if data
    //     },
    //     error: function(error) { console.log("error getting formations !!", error) }
    //   }); //ajax
    // }); //onChange "formation"
  }); //ready
</script>
</body>
</html>
