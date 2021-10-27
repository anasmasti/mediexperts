<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src={{ asset('js/jquery.js') }}></script>
    <script src={{ asset('js/myjs.js') }}></script>
</head>

<body>

  <style>
    .paper {
      height:27.9cm; width:21cm;
    }
    input { width: 97%; padding: .2rem; border: none !important; outline: none !important; }
    .select { width: 100%; padding: .2rem; border-color: #fff !important; outline-color: #fff !important;
      -moz-appearance:none; /* Firefox */
      -webkit-appearance:none; /* Safari and Chrome */
      appearance:none;
      cursor: pointer;
    }
    input { word-wrap: break-all; }
    input[type=radio] { outline: 1px solid #000; }
    input[type="readonly"] { background-color: #fff; }
    table {
      border: 1px solid #000; border-collapse: collapse; width: 100%;
    }
    td, tr, th {
      border: 1px solid #000;
      padding: .2rem; border-collapse: collapse;
    }
    .flex-column {
      display: flex; flex-flow: column wrap; width: 100%;
    }
    .flex-row {
      display: flex; flex-flow: row wrap; width: 100%;
    }
    /* ul.select2-selection__rendered {
      padding-right: 12px !important; 
} */
    .container { width: 100%; }
    .bordered { border: 1px solid #000; }
    .highlighted { background-color: #ffff99 !important; }
    .text-bold { font-weight: 600; }
    .text-center { text-align: center; }
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
    .hide-from-print { display: none !important; }
    .highlighted { background-color: #fff !important; }
    .select {
      max-width: 100%;
      overflow: hidden;
      white-space: normal;
    }
  }
</style>

<div class="hide-from-print">
  <div style="display:flex; justify-content:space-between;">
    <a class="bu-print" id="" href="/">Retour</a>
    <a class="bu-print" id="buPrintF4" href="#" onclick="window.print()">Imprimer le formulaire</a>
  </div>

  <div style="width:100%;">
    <label for="client">Sélectionner la societe :</label>
    <select name="client" id="client" style="width:100%; padding: .5rem; border: 1px solid #000;">
      <option selected disabled>--sélectionner la société</option>
      @foreach ($clients as $clt)
        <option value="{{$clt->nrc_entrp}}"> {{$clt->raisoci}} </option>
      @endforeach
    </select>
  </div>

  <div style="width:100%;">
    <label for="plan">Sélectionner plan de formation :</label>
    <select name="plan" id="plan" style="width:100%; padding: .5rem; border: 1px solid #000;">
      {{-- auto filled --}}
    </select>
  </div>

</div>

<div class="hide-from-print" style="width:100%;">
  <label for="action">Sélectionner l'action de formation :</label>
  <select name="action" id="action" style="width:100%; padding: .5rem; border: 1px solid #000;">
    {{-- auto filled --}}
  </select>
</div>

</div>



<div class="paper" style="font-family:Calibri, 'Segoe UI', Geneva, Verdana, sans-serif; background-color: #fff;">

  <div class=".hide-from-print" style="width:100%; height:20px;"><!--space--></div>

  <div style="width:100%;">
    <h3 style="padding:0; margin:0;">Contrats Spéciaux de Formation</h3>
  </div>

  <div style="width: 100%;">
    <h4 class="text-center" style="padding:0px; margin:5px; font-weight:900; font-size:30px; text-align:center;">Formulaire F4</h4>
    <div style="width:100%; height:7px; background-color:#000;"><!--line--></div>
    <div>
      <p style="padding:0 0 10px 0; margin:0; text-align:center; font-size:23px;">Fiche d’évaluation de l’Action de Formation </p>
    </div>
  </div>

  <div style="width:100%">
    <p style="width:80%; font-size: 14px;">
      Cette fiche est remise par le formateur au bénéficiaire au terme de la dernière journée de formation. <br>
      Ce dernier est prié de la remettre, dûment renseignée et signée, au formateur. <br>
      NB: Les informations recueillies à travers cette fiche seront utilisées pour des fins statistiques <br>
      uniquement et nullement pour porter un jugement quel qu’il soit sur la performance des parties
      prenantes.
    </p>
  </div>


  <div style="width:100%; display:flex; flex-wrap:nowrap;">
    {{-- THEME --}}
    <div style="width:47%">
      <span>Entreprise :</span><br>
      <div class="bordered">
        <input type="text" name="entrp" id="entrp" readonly>
      </div>
    </div>
    <div style="width:6%"><!--space--></div>
    {{-- DATES --}}
    <div style="width:47%">
      <span>Groupe :</span>
      <div class="bordered">
        <input type="text" id="groupe" readonly />
      </div>
    </div>
  </div>
  <div style="width:100%; height:5px;"><!--space--></div>


  <div style="width:100%; display:flex; flex-wrap:nowrap;">
    {{-- THEME --}}
    <div style="width:47%">
      <span>Thème de l'Action de Formation Par Groupe  :</span><br>
      <div class="bordered">
        <select name="formation" id="formation" class="select highlighted">
          {{-- auto filled --}}
        </select>
      </div>
    </div>
    <div style="width:6%"><!--space--></div>
    {{-- DATES --}}
    <div style="width:47%">
      <span>Dates de la formation :</span>
      <div class="bordered">
        <input type="text" id="dates" readonly />
      </div>
    </div>
  </div>

  <div style="width:100%; display:flex; flex-wrap:nowrap;">
    {{-- NOM BENIF --}}
    <div style="width:47%">
      <span>Nom du bénéficiaire :</span><br>
      <div class="bordered">
        <input type="text" id="nom" readonly />
      </div>
    </div>
    <div style="width:6%"><!--space--></div>
    {{-- PRENOM BENIF --}}
    <div style="width:47%">
      <span>Prénom du bénéficiaire: </span>
      <div class="bordered">
        <input type="text" id="prenom" readonly />
      </div>
    </div>
  </div>

  <div style="width:100%; display:flex; flex-wrap:nowrap;">
    {{-- N° CIN --}}
    <div style="width:47%">
      <span>N° CIN :</span><br>
      <div class="bordered">
        <select name="cin" id="cin" class="select highlighted">
          {{-- auto filled --}}
        </select>
      </div>
    </div>
    <div style="width:6%"><!--space--></div>
    {{-- N° CNSS --}}
    <div style="width:47%">
      <span>N° CNSS :</span>
      <div class="bordered">
        <input type="text" id="nCnss" readonly />
      </div>
    </div>
  </div>

  <div style="width:100%; height:15px;"><!--space--></div>

  {{-- TABLE --}}
  <table>
    <thead>
      <tr>
        <th style="width:60%;">Conditions de réalisation</th>
        <th style="width:10%;">pas du tout</th>
        <th style="width:10%;">peu</th>
        <th style="width:10%;">moyen</th>
        <th style="width:10%;">tout à fait</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>L'information concernant la formation a été complète.</td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
      </tr>
      <tr>
        <td>La durée et le rythme de la formation étaient conformes à ce qui a été annoncé</td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
      </tr>
      <tr>
        <td>Les documents annoncés ont été remis aux participants.</td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
      </tr>
      <tr>
        <td>Les documents remis constituent une aide à l'assimilation des contenus.</td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
      </tr>
      <tr>
        <td>Les contenus de la formation étaient adaptés à mon niveau initial</td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
      </tr>
      <tr>
        <td>Les conditions matérielles (locaux, restauration, facilité d'accès,etc.) étaient satisfaisantes.</td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
      </tr>
    </tbody>
  </table>
  {{-- END TABLE --}}
  <div style="width:100%; height:10px;"><!--space--></div>

  {{-- TABLE --}}
  <table>
    <thead>
      <tr>
        <th style="width:60%;">Compétences techniques et pédagogiques </th>
        <th style="width:10%;">pas du tout</th>
        <th style="width:10%;">peu</th>
        <th style="width:10%;">moyen</th>
        <th style="width:10%;">tout à fait</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Le formateur dispose des compétences techniques nécessaires.</td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
      </tr>
      <tr>
        <td>Le formateur dispose des compétences pédagogiques.</td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
      </tr>
      <tr>
        <td>Le formateur a su créer ou entretenir une ambiance agréable dans le groupe en formation</td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
      </tr>
      <tr>
        <td>Les moyens pédagogiques étaient adaptés au contenu de la formation</td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
      </tr>
    </tbody>
  </table>
  {{-- END TABLE --}}

  <div style="width:100%; height:10px;"><!--space--></div>

  {{-- TABLE --}}
  <table>
    <thead>
      <tr>
        <th style="width:60%;">Atteinte des objectifs</th>
        <th style="width:10%;">pas du tout</th>
        <th style="width:10%;">peu</th>
        <th style="width:10%;">moyen</th>
        <th style="width:10%;">tout à fait</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Les objectifs de la formation correspondent à mes besoins professionnels</td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
      </tr>
      <tr>
        <td>Les objectifs recherchés à travers cette formation ont été atteint</td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
      </tr>
      <tr>
        <td>D’une manière générale, cette formation me permettra d’améliorer mes compétences professionnelles </td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
        <td><input type="radio" disabled></td>
      </tr>
    </tbody>
  </table>
  {{-- END TABLE --}}

  <div style="width:100%; height:20px;"><!--space--></div>

  <div style="width:100%; display:flex; flex-wrap:nowrap;">
    {{-- FAIT A --}}
    <div style="width:45%">
      <span>Fait à :</span><br>
      <div class="bordered">
        <input type="text" id="ville" />
      </div>
      {{-- LE --}}
      <span>Le :</span>
      <div class="bordered">
        <input type="date" id="dateF4" />
      </div>
    </div>

    <div style="width:10%"><!--space--></div>
    <div style="width:45%">
      <span style="font-size:16px;">Signature du bénéficiaire :</span>
      <div style="height:72px; border:1px solid black;">
        {{-- signature et cacheter --}}
      </div>
    </div>
  </div>

</div>
{{-- END PAPER --}}



{{-- JS --}}
<script type="text/javascript">
  $(document).ready(function () {
    // $('#buPrintF4').printPage();
    // PLAN
    // $('#client').on('change', function() {
    //   let nrc = $(this).val();
    //   let plan = $('#plan'); let cin = $('#cin'); let nom = $('#nom'); let prenom = $('#prenom'); let nCnss = $('#nCnss');
    //   $.ajax({
    //     type: 'GET',
    //     url : '{!! URL::to('/fill-pf-f4') !!}',
    //     data: {'nrc': nrc},
    //     success: function(data) {
    //       let fillPlanFormation = '<option selected disabled>--veuillez sélectionner la formation</option>';
    //       console.log('success plan !!', data);
    //       for (let i = 0; i < data.length; i++) {
    //         fillPlanFormation += `<option value="`+data[i].n_form+`">`+data[i].nom_theme+`</option>`;
    //       }
    //       cin.val("");
    //       nom.val("");
    //       prenom.val("");
    //       nCnss.val("");
    //       plan.html("");
    //       plan.append(fillPlanFormation);
    //     },
    //     error: function() {
    //       console.log("error getting plans !!");
    //     }
    //   }); //ajax
    // }); //onChange

    $('#client').on('change', function() {
      // initialize
      $('#cin').html(""); $('#nom').val(""); $('#prenom').val(""); $('#groupe').val("");
      $('#nCnss').val("");  $('#plan').html(""); $('#dates').val(""); $('#formation').html("");

      let nrc = $('#client').val();
      let fillDropdown = '';
      $.get('/fill-plan-by-client', {'nrc': nrc})
        .done((data) => {
          console.log("success action !!", data);
          data.forEach(elem => {
            fillDropdown += `<option value="${elem.id_plan}">${elem.refpdf}  </option>`;
          });

          // affecter les données dans select
          $('#plan').html("");
          if (data.length) {
            $('#plan').append('<option selected disabled>--sélectionner plan de formation</option>');
            $('#plan').append(fillDropdown);
            $('#entrp').val(data[0].raisoci);
          }
          else {
            $('#plan').append('<option selected disabled>(vide) aucune plan de formation</option>');
          }
        }) // done
        .catch(err => console.log("error getting actions !!", error));
    }); //onChange "plans"

    // FORMATION
    $('#action').on('change', function() {
      let nForm = $(this).val();
      let formation = $('#formation');
      let cin = $('#cin'); let nom = $('#nom'); let prenom = $('#prenom'); let nCnss = $('#nCnss');
      let fillDate = "";
      let last_nonull_date = "";
      $.ajax({
        type: 'GET',
        url : '{!! URL::to('/fill-form-f4') !!}',
        data: {'nForm': nForm},
        success: function(data) {
          // the position 0 of table data represents the 'Formation' Data 
          // the position 1 represents 'Avis de modification' data if it does exist
          let fitchedData;
          let groupe;
          // database date syntaxe
          let dateSyntaxe;

          if(data[1].length > 0){
            //  fetch ' avi modification ' data
             fitchedData = data[1],
             dateSyntaxe = 'new_date'
             groupe = data[1][0].new_groupe
             console.log('Test' , data[1][0].new_groupe);
          }
          else{
            //  fetch ' Formation ' data
            fitchedData = data[0]
            dateSyntaxe = 'date'
            groupe = data[0][0].groupe
          }

          let fillFormation = '<option selected disabled>--veuillez sélectionner le thème </option>';
          console.log('success formations test !!', fitchedData);
          if (fitchedData.length > 0) {
            for (let i = 0; i < fitchedData.length; i++) {
              fillFormation += `<optgroup label=" groupe: ${groupe}"><option value="`+fitchedData[i].id_form+`"> ${fitchedData[i].nom_theme}  </option></optgroup>`;
              
              for (let j=0; j<30;j++){
              let tmpIndex = dateSyntaxe+(j+1);
              //get last nonull date (dernière date de formation)
              if (fitchedData[0][tmpIndex] != null && fitchedData[0][(tmpIndex+1)] == null) {
                last_nonull_date = fitchedData[0][tmpIndex];
                }
              }
            
            fillDate = "De "+DateFormat(fitchedData[0][dateSyntaxe + '1'])+" à "+DateFormat(last_nonull_date);
            formation.html("");
            formation.append(fillFormation);
            $('#dates').html("");
            $('#dates').val(fillDate);
            $('#dateF4').val((last_nonull_date));
            $('#ville').val(fitchedData[0].local_2)
            }
          }
          else {
            fillFormation = '<option selected disabled>(vide) aucun formation</option>';
            formation.html("");
            formation.append(fillFormation);
            cin.html(""); nom.val(""); prenom.val(""); nCnss.val("");
          }
        },
        error: function() {
          console.log("error getting formations !!");
        }
      }); //ajax
    }); //onChange
    $('#plan').on('change',function() {
      let idPlan = $(this).val();
      $.ajax({
        type:'GET',
        url : '{!! URL::to('/fill-action-form') !!}',
        data: {'idPlan': idPlan},
        success: function(data){
          console.log('success Action', data);
          let fillAction = '<option selected disabled>--veuillez sélectionner une action</option>';
          for ( let i =0; i<data.length;i++){
          if(data.length >0){
            fillAction += `<option value="`+data[i].n_form+`">`+data[i].n_action+` {{'>'}}`+data[i].nom_theme+`</option>`
          }
         }
         $('#action').html('');
         $('#action').append(fillAction);
        }
      })

    })
    // Trouver les personnels
    $('#formation').on('change', function() {
      let idForm = $(this).val();
      let cin = $('#cin');
      $.ajax({
        type: 'GET',
        url : '{!! URL::to('/fill-personnel-f4') !!}',
        data: {'idForm': idForm},
        success: function(data) {
          console.log('success personnel !!', data);
          console.log('Test' , data[0]['groupe']);
          let fillPersonnel = '<option selected disabled>--veuillez sélectionner le personnel</option>';
          let last_nonull_date = "";
          let fillDate = "";
          if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
              fillPersonnel += `<option value="`+data[i].cin+`">`+data[i].cin+`</option>`;
              // let tmpIndex = "date"+(i+1);
              // //get last nonull date (dernière date de formation)
              // if (data[0][tmpIndex] != null && data[0][(tmpIndex+1)] == null) {
              //   last_nonull_date = data[0][tmpIndex];
              //   console.log('--***--', last_nonull_date);
              }
            
            // fillDate = "De "+DateFormat(data[0]['date1'])+" à "+DateFormat(last_nonull_date);
            $('#dates').html("");
            // $('#dates').val(fillDate);
            // $('#dateF4').val((last_nonull_date));
            $('#groupe').val(data[0]['groupe']);
            cin.html("");
            cin.append(fillPersonnel);
            }
          else {
            fillPersonnel = '<option selected disabled>(vide) créer une formation ou ajouter des personnels</option>';
            cin.html("");
            cin.append(fillPersonnel);
          }
        },
        error: function() {
          console.log("error getting personnels !!");
        }
      }); //ajax
    }); //onChange

    // Trouver les informations du personnel choisi
    $('#cin').on('change', function() {
      let cin = $(this).val();
      let nom = $('#nom');
      let prenom = $('#prenom');
      let nCnss = $('#nCnss');
      $.ajax({
        type: 'GET',
        url : '{!! URL::to('/fill-person-info-f4') !!}',
        data: {'cin': cin},
        success: function(data) {
          console.log('success personnel info !!', data);
          $('#nom').val(data.nom);
          $('#prenom').val(data.prenom);
          $('#nCnss').val(data.cnss);
        },
        error: function(error) {
          console.log("error getting personnels info !!", error);
        }
      }); //ajax
    }); //onChange

  }); //ready
</script>
{{-- ******************** --}}



</body>


</html>
