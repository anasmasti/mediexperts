<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src={{ asset('js/jquery.js') }}></script>
  <title>Formulaire 1</title>
</head>

<body>

<style>
  * {
    box-sizing: border-box
  }
  .paper {
    padding:20px; height:27.9cm; width:21cm; padding-left:.25px;
  }
  .select { width:100%; border-color: #fff !important; outline-color: #fff !important;
    -moz-appearance:none; /* Firefox */
    -webkit-appearance:none; /* Safari and Chrome */
    appearance:none;
    cursor: pointer;
  }
  .select:hover {
    box-shadow: 0px 0px 1px 1px #00000059;
  }
  input[type="readonly"] { background-color: #fff; }
  input[type="radio"] { display: inline !important; margin: 0; padding: 0; }
  table {
  border: 1px solid #000; border-collapse: collapse; width:100%;
  }
  td, tr, th {
  border: 1px solid #000;
  padding: .2rem; border-collapse: collapse;
  }
  .bordered { border: 1px solid #000 !important; padding: .2rem; }
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
  .hide-from-print { display: none; }
  }
</style>

<div class="hide-from-print">
  <div style="display:flex; justify-content:space-between;">
    <a class="bu-print" id="" href="/client">Retour</a>
    <a class="bu-print" id="buPrintF1" href="#" onclick="window.print()">Imprimer le formulaire</a>
  </div>
</div>


<div class="paper" style="padding: 0 50px; font-family:Calibri, 'Segoe UI', Geneva, Verdana, sans-serif; background-color: #fff;">

  <div style="width: 100%;">
    <p style="padding:0; margin:0; font-weight:600; font-size:20px;">Contrats Spéciaux de Formation</p>
  </div>
  <div style="width: 100%;">
    <div style="height: 35px;">
      <h4 class="text-center" style="padding:0px; margin:5px; font-weight:900; font-size:30px; text-align:center;">Formulaire 1</h4>
    </div>
    <div style="width:100%; height:7px; background-color:#000;"><!--line--></div>
    <div>
      <p style="padding:0 0 10px 0; margin:0; text-align:center; font-size:23px;">Fiche d'identification de l'entreprise</p>
    </div>
  </div>
  {{-- fields --}}
  <div style="width:100%;">
    {{-- Raison social --}}
    <div style="width:100%">
      <span class="p-0">Raison sociale :</span>
      <div class="bordered">
        {{ $client->raisoci }}
      </div>
    </div>
    {{-- Activité --}}
    <div style="width:100%">
      <span class="p-0">Activité :</span>
      <div class="bordered">
        {{ $client->obj_soci }}
      </div>
    </div>
    {{-- Secteur d'activité --}}
    <div style="width:100%">
      <span class="p-0">Secteur d'activité :</span>
      <div class="bordered">
        {{ $client->sect_activ }}
      </div>
    </div>
    {{-- Adresse --}}
    <div style="width:100%">
      <span class="p-0">Adresse :</span>
      <div class="bordered" style="height:50px;">
        {{ $client->sg_soci }}
      </div>
    </div>

    <div style="width:100%; height:10px;"><!-- *** line space ***--></div>

    {{-- Telephone & fax --}}
    <div style="width:100%; display:flex; flex-wrap:nowrap;">
      <div style="width:15%">
        <span class="p-0">Téléphone :</span>
      </div>
      <div style="width:33%">
        <div class="bordered text-center">
          {{ $client->fix_1 }}
        </div>
      </div>
      <div style="width:4%">
        <div style=""><!--space--></div>
      </div>
      <div style="width:15%">
        <span class="p-0">Fax :</span>
      </div>
      <div style="width:33%">
        <div class="bordered text-center">
          {{ $client->fax_1 }}
        </div>
      </div>
    </div>

    <div style="width:100%; height:5px;"><!-- *** line space ***--></div>

    {{-- Email --}}
    <div style="width:100%; display:flex; flex-wrap:nowrap;">
      <div style="width:15%">
        <span class="p-0">Email :</span>
      </div>
      <div style="width:85%">
        <div class="bordered">
          {{ $client->email_resp }}
        </div>
      </div>
    </div>

    <div style="width:100%; height:20px;"><!-- *** line space ***--></div>

    {{-- Date création --}}
    <div style="width:100%; display:flex; flex-wrap:nowrap;">
      <div style="width:15%">
        <span class="p-r" style="font-size:13px;">Date de création :</span>
      </div>
      <div style="width:33%">
        <div class="bordered text-center">
          {{ Carbon\Carbon::parse($client->dt_creat)->format('d/m/Y') }}
        </div>
      </div>
    </div>

    <div style="width:100%; height:5px;"><!-- *** line space ***--></div>

    {{-- PATENTE & ID FISCALE --}}
    <div style="width:100%; display:flex; flex-wrap:nowrap;">
      <div style="width:15%">
        <span class="p-0">Patente :</span>
      </div>
      <div style="width:33%">
        <div class="bordered text-center">
          {{ $client->npatente }}
        </div>
      </div>

      <div style="width:4%">
        <div style=""><!--space--></div>
      </div>

      <div style="width:15%">
        <span class="p-r" style="font-size:13px;">Identifiant fiscal :</span>
      </div>
      <div style="width:33%">
        <div class="bordered text-center">
          {{ $client->id_fiscal }}
        </div>
      </div>

    </div>

    <div style="width:100%; height:5px;"><!-- *** line space ***--></div>

    {{-- RC & CNSS --}}
    <div style="width:100%; display:flex; flex-wrap:nowrap;">

      {{-- N° RC --}}
      <div style="width:15%">
        <span class="p-0">N° RC</span>
      </div>
      <div style="width:33%">
        <div class="bordered text-center">
          {{ $client->nrc_entrp }}
        </div>
      </div>

      <div style="width:4%">
        <div style=""><!--space--></div>
      </div>

      {{-- CNSS --}}
      <div style="width:15%">
        <span class="p-0">N° CNSS :</span>
      </div>
      <div style="width:33%">
        <div class="bordered text-center">
          {{ $client->ncnss }}
        </div>
      </div>
    </div>


    <div style="width:100%; height:5px;"><!-- *** line space ***--></div>

    <div style="width:100%; height:5px;"><!-- *** line space ***--></div>

    {{-- Responsables --}}
    <div style="width:100%">
      <span class="p-0">Nom et prénom du responsable de la formation :</span>
      <div class="bordered">
        {{ $client->nom_resp }}
      </div>
    </div>
    <div style="width:100%; height:5px;"><!-- *** line space ***--></div>
    <div style="width:100%">
      <span class="p-0">Nom et prénom de la personne habilitée à représenter légalement l'entreprise :</span>
      <div class="bordered">
        {{ $client->nom_dg1 }}
      </div>
    </div>

    <div style="width:100%; height:20px;"><!-- *** line space ***--></div>

    {{-- Effectif de l'entreprise --}}
    <div style="width:100%">
      <span class="p-0">Effectif de l'entreprise :</span>
      <style>
        table, th, tr, td
        { border-collapse:collapse; border: 1px solid #000; text-align:center; }
        th { width: 25%; }
      </style>
      <table style="width:100%;">
        <thead>
          <tr>
            <th>Cadres</th>
            <th>Employés</th>
            <th>Ouvriers</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $client->nb_cadre }}</td>
            <td>{{ $client->nb_employe }}</td>
            <td>{{ $client->nb_ouvrier }}</td>
            <td>{{ $client->effectif }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div style="width:100%; height:5px;"><!-- *** line space ***--></div>

    {{-- CSF DEJA --}}
    <div style="width:100%;">
      <span style="font-size:16px">L'entreprise a-t-elle déjà bénéficié des CSF lors des trois dernières années ?</span>
      {{-- radio button : oui / non --}}
      <div style="display:flex; flex-wrap:nowrap;">
        <div style="width:25%;"><!--space left--></div>
        <div style="width:25%; text-align:center;">
            <label for="csf_deja1">Oui</label>
            @if ($client->annee_deja1 != "" || $client->annee_deja2 != "" || $client->annee_deja3 != "")
              <input type="radio" name="csf-deja" id="csf_deja1" checked>
            @else
              <input type="radio" name="csf-deja" id="csf_deja1">
            @endif
        </div>
        <div style="width:25%; text-align:center;">
            <label for="csf_deja2">Non</label>
            @if ($client->annee_deja1 == "" && $client->annee_deja2 == "" && $client->annee_deja3 == "")
              <input type="radio" name="csf-deja" id="csf_deja2" checked>
            @else
              <input type="radio" name="csf-deja" id="csf_deja2">
            @endif
        </div>
        <div style="width:auto;"><!--space right--></div>
      </div>
    </div>

    <div style="width:100%; height:5px;"><!-- *** line space ***--></div>

    {{-- Signature Cachet --}}
    <div style="width:100%; display:flex; flex-wrap:nowrap;">
      <div style="width:45%">
        <span class="p-r" style="font-size:16px;">Fait à :</span>
        <div class="bordered">
          {{-- {{ $client->ville }} --}}
          @php $villes =
          ['Casablanca', 'Settat', 'Had Soualem', 'Salé', 'Fès', 'Tanger', 'Marrakech', 'Meknès', 'Rabat', 'Oujda', 'Kénitra', 'Agadir', 'Tétouan',
            'Témara', 'Safi', 'Mohammédia', 'El Jadida', 'Béni Mellal', 'Taza', 'Khémisset', 'Taourirt']; @endphp
          <select name="ville_cab" class="select" id="ville_cab" style="width:100%;">
            @foreach ($villes as $ville)
              @if (mb_strtolower($ville) == mb_strtolower($client->local_2) | mb_strtolower($ville) == mb_strtolower($client->ville))
                <option value="{{$ville}}" selected>{{$ville}}</option>
              @else
                <option value="{{$ville}}">{{$ville}}</option>
              @endif
            @endforeach
          </select>
        </div>
        <span class="p-r" style="font-size:16px;">Nom et prénom :</span>
        <div class="bordered">
          {{ $client->nom_dg1 }}
        </div>
        <span class="p-r" style="font-size:16px;">Qualité :</span>
        <div class="bordered">
          {{ $client->fonct_dg1 }}
        </div>
      </div>
      <div style="width:10%">
        <div style=""><!--space--></div>
      </div>
      <div style="width:45%;">
        <span style="font-size:16px;">Le :</span>
        <div class="bordered">
          {{-- date document --}}
          <input type="date" style="width:100%; height:100%; border: none !important; outline: none !important;" id="date_today" name="date_today" value="{{date("Y-m-d")}}">
        </div>
        <span style="font-size:16px;">Signature et cachet de l'Organisme :</span>
        <div style="height:130px; border:1px solid black;">
          {{-- signature et cacheter --}}
        </div>
      </div>
    </div>



  </div>
  {{-- /fields --}}


  <div style="width:100%; height:10px;"><!--space--></div>


  {{-- Footer --}}
  <div style="position:relative; bottom:0; font-size:13px; position:fixed;">
    <p>Ce formulaire est disponible sur le Portail des CSF à l'adresse: <span><a href="http://csf.ofppt.org.ma">http://csf.ofppt.org.ma.</a></span>
      <br />Il peut être rempli sur l'écran en tant que
      formulaire PDF avant d'être imprimé.</p>
  </div>
</div>


{{-- script to print page --}}
<script type="text/javascript">
  $(document).ready(function () {
  });
</script>
{{-- ******************** --}}



</body>

</html>
