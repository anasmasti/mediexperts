<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src={{ asset('js/jquery.js') }}></script>
  <script src={{ asset('js/myjs.js') }}></script>
  <title>Modèle 5 (liste de présence)</title>
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
  .container { width:100%; padding: .4rem; }
  .bordered { border: 1px solid #000; }
  .highlighted { background-color: #ffff99 !important; }
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
  #footer {
      display: none;
  }
  @media print {
    .hide-from-print { display: none; }
    .highlighted { background-color: #fff !important; }
    #footer {
        display: flex;
    }
  }
  #selectedCSP {
    font-weight: 700; text-align: center;
  }
</style>

{{-- PRINT - CANCEL --}}
<div class="hide-from-print">
  <div style="display:flex; justify-content:space-between;">
    <a class="bu-print" id="" href="/">Retour</a>
    <a class="bu-print" id="buPrintF4" href="#" onclick="window.print()">Imprimer le formulaire</a>
  </div>

  <div style="width:100%;">
    <label for="client">Sélectionner la société :</label>
    <select name="client" id="client" style="width:100%; padding: .5rem; border: 1px solid #000;">
      <option selected disabled>--sélectionner la société</option>
      @foreach ($client as $clt)
        <option value="{{$clt->nrc_entrp}}" > {{$clt->raisoci}} </option>
      @endforeach
    </select>
  </div>

  <div style="width:100%;">
    <label for="plans">Sélectionner le plan de formation :</label>
    <select name="plans" id="plans" style="width:100%; padding: .5rem; border: 1px solid #000;">
      <option selected disabled>--sélectionner le plan de formation</option>

    </select>
  </div>

  <div style="width:100%;">
    <label for="action">Sélectionner l'action de formation :</label>
    <select name="action" id="action" style="width:100%; padding: .5rem; border: 1px solid #000;">
        {{-- auto filled --}}
    </select>
  </div>

  <div style="width:100%; height:50px;"><!--space--></div>
</div>



<div class="" style="font-size:14px; padding:.5rem; font-family:Calibri, 'Segoe UI', Geneva, Verdana, sans-serif; background-color: #fff;">
  <div class="container flex-row bordered center">
    <span style="width:100%; font-size: 20px; font-weight:600;">Modèle 5</span>
    <span style="width:100%;">Liste de présence des bénéficiaires d’une formation</span>
  </div>

  <div style="width:100%; height:20px;"><!--space--></div>

  <div class="container flex-row center">
    <span style="width:100%; font-size: 18px; font-weight:600;">Modèle 5</span>
    <span style="width:100%; font-size: 17px; font-weight:600; padding: 10px;">LISTE DE PRESENCE PAR ACTION ET PAR GROUPE</span>
  </div>

  <div class="container">
  {{-- CLIENT --}}
    <div style="width:100%;" class="flex-row">
      <div style="width:25%;">
        <span class="text-bold">Entreprise &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</span>
      </div>
      <div style="width:75%;">
        <input type="text" id="raisoci" name="raisoci" readonly>
      </div>
    </div>
    <div style="width:100%; height:5px;"><!--space--></div>
    {{-- FORMATION --}}
    <div class="flex-row" style="width:100%;">
      <div style="width:25%;">
        <span class="text-bold">Thème de l'action &nbsp;&nbsp; :</span>
      </div>
      <div style="width:75%;">
        <select name="formation" id="formation" class="select highlighted">
          {{-- auto filled --}}
        </select>
      </div>
    </div>
    {{-- JOURS FORMATION --}}
    <div class="flex-row" style="width:100%;">
      <div style="width:25%;">
        <span class="text-bold">Jours de réalisation :</span>
      </div>
      <div style="width:75%;">
        <select name="dates" id="dates" class="select highlighted">
          {{-- auto filled --}}
        </select>
      </div>
    </div>
    {{-- GROUPE --}}
    <div class="flex-row" style="width:100%;">
      <div style="width:25%;">
        <span class="text-bold">
            Groupe
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :
        </span>
      </div>
      <div style="width:75%;">
        <input type="text" name="groupe" id="groupe" readonly>
      </div>
    </div>
  </div>

  <div style="width:100%; height:7px;"><!--space--></div>

  <table>
    <thead>
      <tr>
        <th rowspan="2" style="width:15%;">Nom</th>
        <th rowspan="2" style="width:15%;">Prénom</th>
        <th rowspan="2" style="width:15%;">N° CIN</th>
        <th rowspan="2" style="width:15%;">N° CNSS</th>
        <th colspan="3" style="width:20%">C.S.P</th>
        <th rowspan="2" style="width:20%;">Emargement</th>
        <tr>
          <th style="width:6%;">C</th>
          <th style="width:6%;">E</th>
          <th style="width:6%;">O</th>
        </tr>
      </tr>
    </thead>
    <tbody id="listPersonnel">
      {{-- auto filled --}}
    </tbody>
  </table>

  <div style="width:100%; height:3px;"><!--space--></div>
  <p class="text-bold">(*) C.S.P : Catégorie socioprofessionnelle</p>
  <p class="text-bold">C: Cadre —  E: Employé —  O: Ouvrier</p>

  <div id="footer" class="container flex-row" style="position:fixed !important; bottom:0; width:100%; padding-bottom:170px;">
    <div style="width:35%;" class="text-center">
      <p class="text-bold text-center" style="padding-top: 10px;">Cachet de l’organisme de formation <br>Et identité du signataire</p>
      <strong class="text-center">Soufiane RAID, Gérant</strong>
    </div>

    <div style="width:25%;"><!--space--></div>

    <div style="width:35%;">
      <p class="text-bold text-center" style="padding-top: 10px">Cachet et signature du responsable <br>de formation de l’entreprise</p>
    </div>
  </div>

</div>
{{-- END PAPER --}}








<script type="text/javascript">
  $(document).ready(function () {

    $('#client').on('change', function() {
      let nrc = $('#client').val();
      let fillDropdown = '';
      $.get('/fill-plan-by-client', {'nrc': nrc})
        .done((data) => {
          console.log("success action !!", data);
          console.log("---", data[0].raisoci);
          data.forEach(elem => {
            fillDropdown += `<option value="${elem.id_plan}"> ${elem.refpdf}  </option>`;
          });
          // affecter les données dans select
          $('#plans').html("");
          if (data.length) {
            $('#plans').append('<option selected disabled>--sélectionner une action</option>');
            $('#plans').append(fillDropdown);
            $('#raisoci').val(data[0].raisoci);
          }
          else {
            $('#plans').append('<option selected disabled>(vide) aucune action</option>');
          }
        }) //done
        .catch(err => console.log("error getting actions !!", error));
    });

    $('#plans').on('change', function() {
      let idPlan = $('#plans').val();
      let fillDropdown = '';
      $.get('/fill-action-form', {'idPlan': idPlan})
        .done((data) => {
          console.log("success action !!", data);
          data.forEach(elem => {
            fillDropdown += `<option value="${elem.n_form}">${elem.n_action} > ${elem.nom_theme} </option>`;
          });
          // affecter les données dans select
          $('#action').html("");
          if (data.length) {
            $('#action').append('<option selected disabled>--sélectionner une action</option>');
            $('#action').append(fillDropdown);
          }
          else {
            $('#action').append('<option selected disabled>(vide) aucune action</option>');
          }
        }) //done
        .catch(err => console.log("error getting actions !!", error));
    }); //onChange "plans"


    $('#action').on('change', function() {
      $('#listPersonnel').html("") //vider la liste à chaque sélection
      $('#dates').html(""); //vider la liste à chaque sélection
      let nForm = $('#action').val();
      $.ajax({
        type: 'GET',
        url : '{!! URL::to('/fill-form-f4') !!}', //on peut utiliser l'url du formulaire 4, ça donne le même resultat
        data: {'nForm': nForm},
        success: function(data) {
          let fillFormation = '<option selected disabled>--veuillez sélectionner la formation</option>';
          console.log('success formations !!', data);
          if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
              fillFormation += `<option value="`+data[i].id_form+`">`+data[i].nom_theme+`</option>`;
            }
            $('#formation').html("");
            $('#formation').append(fillFormation);
          }
          else {
            $('#formation').html("");
            $('#formation').append('<option selected disabled>(vide) aucune formation</option>');
          }
        },
        error: function(err) { console.log("error getting formations !!", err); }
      }); //ajax
    }); //plan OnChange

    // Trouver les personnels
    $('#formation').on('change', function() {
      let idForm = $(this).val();
      $.ajax({
        type: 'GET',
        url : '{!! URL::to('/fill-personnel-f4') !!}',
        data: {'idForm': idForm},
        success: function(data) {
          console.log('success personnel & dates !!', data);
          let groupe = ""
          let fillPersonnel = "";
          let targetCSP = "";
          let fillDates = '<option selected disabled>--veuillez sélectionner la date</option>';
          if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
              if (data[i].csp.toLowerCase() == "c") {
              targetCSP = `<td id="selectedCSP">X</td>`+
              `<td></td>`+
              `<td></td>`;
              }
              else if (data[i].csp.toLowerCase() == "e") {
                targetCSP = `<td></td>`+
                `<td id="selectedCSP">X</td>`+
                `<td></td>`;
              }
              else if (data[i].csp.toLowerCase() == "o") {
                targetCSP = `<td></td>`+
                `<td></td>`+
                `<td id="selectedCSP">X</td>`;
              }
              groupe = data[i]['groupe'];
              fillPersonnel +=
              `<tr style="height:30px;">`+
                `<td>`+data[i].nom+`</td>`+
                `<td>`+data[i].prenom+`</td>`+
                `<td>`+data[i].cin+`</td>`+
                `<td>`+data[i].cnss+`</td>`+
                targetCSP +
                `<td></td>`+
              `</tr>`;
            }
            $('#groupe').val(groupe);
            $('#listPersonnel').html("");
            $('#listPersonnel').append(fillPersonnel);
            //les dates
            for (let i = 0; i <= data.length; i++) {
              let date = (`date`+(i+1)+``);
              if (data[0][date] != null) {
                var customDate = DateFormat(data[0][date]);
                fillDates += `<option value="`+customDate+`">`+customDate+`</option>`;
              }
            } //endfor
            $('#dates').html("");
            ((fillDates != null) && $('#dates').append(fillDates))
            || $('#dates').append('<option selected disabled>--veuillez sélectionner la date</option>');
          } //endif
          else {
            fillPersonnel = '<tr><td rowspan="12">(vide) créer une formation ou affecter des personnels</td></tr>';
            $('#listPersonnel').append(fillPersonnel);
          }
        },
        error: function() {
          console.log("error getting personnels !!");
        }
      }); //ajax
    }); //onChange

  }); //ready
</script>




</body>
</html>
