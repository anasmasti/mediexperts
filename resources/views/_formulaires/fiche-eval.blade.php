<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Fiche d'évaluation</title>
  <script src={{ asset('js/jquery.js') }}></script>
  <script src={{ asset('js/myjs.js') }}></script>
</head>

<body>

  <style>
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
    input[type="readonly"] { background-color: #fff;  }
    table { border: 1px solid #000; border-collapse: collapse; width:100%; }
    td, tr, th {
      border: 1px solid #000;
      padding: .2rem; border-collapse: collapse;
    }
    .flex-column { display: flex; flex-flow: column wrap; width:100%; }
    .flex-row { display: flex; flex-flow: row wrap; width:100%; }
    .flex-nowrap { display: flex; flex-wrap: nowrap; width:100%; }
    .align-items-center { align-items: center; }
    .container { width:100%; padding: .2rem; }
    .bordered { border: 1px solid #000; }
    .highlighted { background-color: #ffff99 !important; }
    .text-bold { font-weight: 600; }
    .text-center { text-align: center !important; }
    .center { justify-content: center !important; align-items: center; text-align: center; font-size: 12px; }
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
      .highlighted { background-color: #fff !important; }
    }
  </style>

{{-- PRINT - CANCEL --}}
<div class="hide-from-print">
  <div style="display:flex; justify-content:space-between;">
    <a class="bu-print" id="back" href="/">Retour</a>
    <a class="bu-print" id="buPrintF2" href="#" onclick="window.print()">Imprimer le formulaire</a>
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

  {{-- <div style="width:100%;">
    <label for="plans">Sélectionner le Réf :</label>
    <select name="plans" id="plans" style="width:100%; padding: .5rem; border: 1px solid #000;">
      <option selected disabled>--sélectionner le Réf--</option>
      @foreach ($plans as $pdf)
        <option value="{{$pdf->id_plan}}">{{$pdf->refpdf}}</option>
      @endforeach
    </select>
  </div> --}}

  <div style="width:100%;">
    <label for="action">Sélectionner l'action de formation :</label>
    <select name="action" id="action" style="width:100%; padding: .5rem; border: 1px solid #000;">
      {{-- auto filled --}}
    </select>
  </div>

  <div style="width:100%; height:50px;"><!--space--></div>
</div>


{{-- PAPER --}}
<div class="" style="padding:.5rem; font-size:13px; font-family:Calibri, 'Segoe UI', Geneva, Verdana, sans-serif; background-color: #fff;">

  <div style="width:100%; display:flex; flex-wrap:nowrap;">
    <div class="container bordered" style="text-align: center; padding: 10px;">
      <h3>Fiche d’évaluation synthétique par groupe</h3>
    </div>
  </div>

  <div style="width:100%; height:20px;"><!--space--></div>

  {{-- ENTREPRISE --}}
  <div style="width:100%; display:flex; flex-wrap:nowrap;">
    <div style="width:30%; margin-bottom: 5px;">
      <span>Nom de l’entreprise &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</span>
    </div>
    <div class="" style="width:70%;">
      <span type="text" id="entrp">

      </span>
    </div>
  </div>

  {{-- ORGANISME --}}
  <div style="width:100%; display:flex; flex-wrap:nowrap; padding-bottom: 10px;">
    <div style="width:30%;">
      <span>Nom de l’organisme de formation :</span>
    </div>
    <div class="" style="width:70%">
      <input type="text" id="organisme" placeholder="organisme" style="font-size: 12px" />
        {{-- auto-filled --}}
    </div>
  </div>

  {{-- INFOS --}}
  <div class="bordered" style="width:100%; display:flex; flex-wrap:wrap; align-items:center; padding:5px;">
    <div class="flex-nowrap align-items-center">
      <div style="width:7%">
          <span>Thème :</span>
      </div>
      <div style="min-width: 40%; max-width:50%">
          <select id="formation" class="select highlighted" style="font-size: 12px;">
            {{-- auto filled --}}
          </select>
      </div>

      <div style="width:1%"><!--space--></div>

      <div style="min-width: 10%; max-width:17%">
          <span style="font-size: 12px;">Nombre de participants :</span>
      </div>
      <div style="width:3%">
          <input type="text" id="nbParticip" value="..." readonly>
      </div>

      <div style="width:5%"><!--space--></div>

      <div style="width:10%">
          <span>N° du Groupe :</span>
      </div>
      <div style="width:3%">
          <input type="text" id="groupe" value="..." style="font-size: 12px;" readonly>
      </div>
    </div>

    {{-- DATES --}}
    <div style="width:7%">
      <span>Dates :</span>
    </div>
    <div style="width:93%">
      <input type="text" id="dates" value="..." style="font-size: 12px;" readonly>
    </div>

    {{-- LIEU --}}
    <div style="width:7%">
      <span>Lieu :</span>
    </div>
    <div style="min-width: 20%; max-width:37%">
      <span id="lieu">
      </span>
    </div>

    <div style="width:2%"><!--space--></div>

    {{-- VILLE --}}
    <div style="width:5%">
      <span>Ville :</span>
    </div>
    <div style="width:18%">
      <input type="text" id="ville" value="..." style="font-size: 12px;" readonly>
    </div>

    <div style="width:2%"><!--space--></div>

    {{-- ANIMATEUR --}}
    <div style="width:10%">
      <span>Animateur :</span>
    </div>
    <div style="width:20%">
      <input type="text" id="animateur" value="..." style="font-size: 11px;" readonly>
    </div>

  </div>
  {{-- END INFOS --}}

  <div class="flex-nowrap">
    <p><strong>EVALUATION CRITERE (Synthèse)</strong></p>
  </div>

  <table>
    <tr>
      <th style="width: 40%;">Conditions de réalisation</th>
      <th style="width: 13%;">Pas du tout</th>
      <th style="width: 13%;">Peu</th>
      <th style="width: 13%;">Moyen</th>
      <th style="width: 20%;">Tout à fait</th>
    </tr>
    <tr>
      <td class="">La durée et le rythme de la formation étaient conformes</td>
      <td class="center">%</td>
      <td class="center">%</td>
      <td class="center">%</td>
      <td class="center">%</td>
    </tr>
    <tr>
      <td class="">Les documents remis constituent une aide à l’assimilation des contenus</td>
      <td class="center">%</td>
      <td class="center">%</td>
      <td class="center">%</td>
      <td class="center">%</td>
    </tr>
    <tr>
      <td class="">Les conditions matérielles étaient satisfaisantes</td>
      <td class="center">%</td>
      <td class="center">%</td>
      <td class="center">%</td>
      <td class="center">%</td>
    </tr>
  </table>

  <div style="height:15px;"><!--space--></div>

  <table>
    <tr>
      <th style="width: 40%;">Compétences techniques et pédagogiques</th>
      <th style="width: 13%;">Pas du tout</th>
      <th style="width: 13%;">Peu</th>
      <th style="width: 13%;">Moyen</th>
      <th style="width: 20%;">Tout à fait</th>
    </tr>
    <tr>
      <td class="">Le formateur dispose des compétences techniques nécessaires</td>
      <td class="center">%</td>
      <td class="center">%</td>
      <td class="center">%</td>
      <td class="center">%</td>
    </tr>
    <tr>
      <td class="">Le formateur dispose de compétences pédagogiques</td>
      <td class="center">%</td>
      <td class="center">%</td>
      <td class="center">%</td>
      <td class="center">%</td>
    </tr>
    <tr>
      <td class="">Les moyens pédagogiques étaient adaptés au contenu</td>
      <td class="center">%</td>
      <td class="center">%</td>
      <td class="center">%</td>
      <td class="center">%</td>
    </tr>
  </table>

  <div style="height:15px;"><!--space--></div>

  <table>
    <thead>
      <tr>
        <th style="width: 40%;">Atteinte des objectifs</th>
        <th style="width: 13%;">Pas du tout</th>
        <th style="width: 13%;">Peu</th>
        <th style="width: 13%;">Moyen</th>
        <th style="width: 20%;">Tout à fait</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="">Les objectifs de la formation correspondent aux objectifs professionnels</td>
        <td class="center">%</td>
        <td class="center">%</td>
        <td class="center">%</td>
        <td class="center">%</td>
      </tr>
      <tr>
        <td class="">Les objectifs recherchés ont été atteints</td>
        <td class="center">%</td>
        <td class="center">%</td>
        <td class="center">%</td>
        <td class="center">%</td>
      </tr>
      <tr>
        <td class="">La formation permet d’améliorer les compétences professionnelles</td>
        <td class="center">%</td>
        <td class="center">%</td>
        <td class="center">%</td>
        <td class="center">%</td>
      </tr>
    </tbody>
  </table>

  <div style="height:30px;"><!--space--></div>

  <table>
    <thead>
      <tr>
        <th style="width: 33%;">Aspects à développer</th>
        <th style="width: 33%;">Aspects à clarifier</th>
        <th style="width: 33%;">Aspects à supprimer</th>
      </tr>
    </thead>
    <tbody>
      <td style="height:100px;"></td>
      <td style="height:100px;"></td>
      <td style="height:100px;"></td>
    </tbody>
  </table>

  <div style="height:15px;"><!--space--></div>

  <div class="flex-nowrap" style="justify-content:space-between;">
    <span style="width:50%;">Emargement de l’animateur</span>
    <span style="width:50%; text-align:end;">Cachet de l’organisme de formation</span>
  </div>

</div>
{{-- END PAPER --}}


<script type="text/javascript">
  $(document).ready(function() {

    $('#client').on('change', function() {
      let nrc = $('#client').val();
      let fillDropdown = '';
      $.get('/fill-plan-by-client', {'nrc': nrc})
        .done((data) => {
          console.log("success action !!", data);
          data.forEach(elem => {
            fillDropdown += `<option value="${elem.id_plan}"> ${elem.refpdf}  </option>`;
          });
          // affecter les données dans select
          $('#plans').html("");
          if (data.length) {
            $('#plans').append('<option selected disabled>--sélectionner une action</option>');
            $('#plans').append(fillDropdown);
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
            fillDropdown += `<option value="${elem.n_form}">${elem.annee} > ${elem.nom_theme} </option>`;
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
        }) // done
        .catch(err => console.log("error getting actions !!", error));
    }); //onChange "plans"

    $('#action').on('change', function() {
      // vider les champs
      $('#formation').html("");
      $('#cabinet').val("");
      let nForm = $('#action').val();
      $.ajax({
        type: 'GET',
        url: '{!! URL::to('/fill-fiche-evaluation') !!}',
        data: {'nForm': nForm},
        success: function(data) {
          console.log("success fiche eval infos !!", data);
          let fillFormation = `<option selected disabled>--sélectionner la formation</option>`;
          if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
              fillFormation += `<option value="`+data[i]['id_form']+`">`+data[i]['nom_theme']+`</option>`;
            } //endfor
          } //endif 'data'
          else {
            fillFormation += `<option selected disabled>(vide) aucune formation dans ce plan</option>`;
          }
          $('#formation').html("");
          $('#formation').append(fillFormation);
          $('#entrp').html(data[0]['raisoci'].toUpperCase());
          $('#organisme').val(data[0]['raisoci_cab'].toUpperCase());
          $('#lieu').html(data[0]['lieu'].toUpperCase());
          $('#ville').val(data[0]['local_2'].toUpperCase());
          $('#animateur').val(data[0]['nom_interv'].toUpperCase()+" "+data[0]['prenom_interv'].toUpperCase());
        },
        error: function(error) { console.log("error getting formations !!", error) }
      }); //ajax
    }); //onChange "plan"


    $('#formation').on('change', function() {
      let idForm = $('#formation').val();
      $.ajax({
        type: 'GET',
        url: '{!! URL::to('/fill-dates-form') !!}',
        data: {'idForm': idForm},
        success: function(data) {
          console.log("success fiche eval infos !!", data);
          let last_nonull_date = "";
          if (data) {
            for (let i = 0; i < Object.keys(data).length; i++) {
              let tmpIndex = "date"+(i+1);
                console.log("tmpIndex date : ", tmpIndex);
              //get last nonull date
              if (data[tmpIndex] != null && data[(tmpIndex+1)] == null) {
                last_nonull_date = data[tmpIndex];
                console.log("last non null date", last_nonull_date);
              }
            } //endfor
          } //endif 'data
          $('#nbParticip').val(data['nb_benif']);
          $('#groupe').val(data['groupe']);
          let fillDate = "De "+DateFormat(data['date1'])+" à "+DateFormat(last_nonull_date);
          $('#dates').val(fillDate);
        },
        error: function(error) { console.log("error getting formations !!", error) }
      }); //ajax
    }); //onChange "formation"

  }); //ready
</script>






</body>
</html>
