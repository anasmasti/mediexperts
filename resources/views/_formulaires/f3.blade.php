<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src={{ asset('js/jquery.js') }}></script>
  <script src={{ asset('js/jquery.printPage.js') }}></script>
  <title>Formulaire 3</title>
</head>

<body>

  <style>
    .paper {
      padding:20px; height:27.9cm; width:21cm; padding-left:.25px;
    }
    input { width:100%; border: none !important; outline: none !important; }
    .select { width:100%; border-color: #fff !important; outline-color: #fff !important;
      -moz-appearance:none; /* Firefox */
      -webkit-appearance:none; /* Safari and Chrome */
      appearance:none;
      cursor: pointer;
    }
    .select:hover {
      box-shadow: 0px 0px 1px 1px #00000059;
    }
    input[type=radio] { outline: 1px solid #000; }
    input[type="readonly"] { background-color: #fff; }
    table {
      border: 1px solid #000; border-collapse: collapse; width:100%;
    }
    td, tr, th {
      border: 1px solid #000;
      padding: .2rem; border-collapse: collapse;
    }
    .bordered { border: 1px solid #000 !important; padding: .2rem; }
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
    <a class="bu-print" id="" href="/cabinet">Retour</a>
    <a class="bu-print" id="buPrintF3" href="#" onclick="window.print()">Imprimer le formulaire</a>
  </div>
</div>

<div class="page-break-before" style="font-family:Calibri, 'Segoe UI', Geneva, Verdana, sans-serif; background-color: #fff;">
  
  <div style="width: 100%;">
    <p style="padding:0; margin:0; font-weight:600; font-size:20px;">Contrats Spéciaux de Formation</p>
  </div>
  <div style="width: 100%;">
    <div style="height: 35px;">
      <h4 class="text-center" style="padding:0px; margin:5px; font-weight:900; font-size:30px; text-align:center;">Formulaire 3</h4>
    </div>
    <div style="width:100%; height:7px; background-color:#000;"><!--line--></div>
    <div>
      <p style="padding:0 0 10px 0; margin:0; text-align:center; font-size:23px;">Fiche d’évaluation de l’Action de Formation </p>
    </div>
  </div>
  {{-- fields --}}
  <div style="width:100%;"></div>
    {{-- Raison social --}}
    <div style="width:100%">
      <span>Raison sociale :</span>
      <div class="bordered">
        {{ $cabinet->raisoci }}
      </div>
    </div>
    {{-- forme juridique & date création --}}
    <div style="width:100%; display:flex; flex-wrap:nowrap;">
      <div style="width:45%">
        <span>Forme juridique * :</span><br>
        <div class="bordered">
          {{ $cabinet->formjury }}
        </div>
      </div>
      <div style="width:10%">
        <div style=""><!--space--></div>
      </div>
      <div style="width:45%">
        <span>Date de création :</span>
        <div class="bordered">
          {{ $cabinet->dt_creat }}
        </div>
      </div>
    </div>
    {{-- Nom du gérant --}}
    <div style="width:100%">
      <span>Nom et prénom du gérant :</span>
      <div class="bordered">
        @php 
          $dg1 = $cabinet->nom_gr1." ".$cabinet->pren_gr1;
          $dg2 = $cabinet->nom_gr2." ".$cabinet->pren_gr2;
          $dirigeant = ['dg1' => $dg1, 'dg2' => $dg2];
        @endphp
        <select name="dg_cab" class="select" id="dg_cab" style="width:100%;">
          @foreach ($dirigeant as $dg)
            <option value="{{$dg}}">{{$dg}}</option>
          @endforeach
        </select>
      </div>
    </div>
    {{-- Adresse --}}
    <div style="width:100%">
      <span>Adresse :</span>
      <div class="bordered">
        {{ $cabinet->adress }}
      </div>
    </div>

    <div style="width:100%; height:10px;"><!--space--></div>

    {{-- Telephone & fax --}}
    <div style="width:100%; display:flex; flex-wrap:nowrap;">
      <div style="width:12.5%">
        <span>Téléphone :</span>
      </div>
      <div style="width:35%">
        <div class="bordered">
          {{ $cabinet->tele }}
        </div>
      </div>
      <div style="width:5%">
        <div style=""><!--space--></div>
      </div>
      <div style="width:12.5%">
        <span>Fax :</span>
      </div>
      <div style="width:35%">
        <div class="bordered">
          {{ $cabinet->fax }}
        </div>
      </div>
    </div>

    <div style="width:100%; height:5px;"><!--space--></div>
    
    {{-- Email --}}
    <div style="width:100%; display:flex; flex-wrap:nowrap;">
      <div style="width:12.5%">
        <span>Email :</span>
      </div>
      <div style="width:87.5%">
        <div class="bordered">
          {{ $cabinet->email }}
        </div>
      </div>
    </div>

    <div style="width:100%; height:5px;"><!--space--></div>
    
    {{-- IdFiscal Patente --}}
    <div style="width:100%; display:flex; flex-wrap:nowrap;">
      <div style="width:12.5%">
        <span>Patente :</span>
      </div>
      <div style="width:35%">
        <div class="bordered">
          {{ $cabinet->npatente }}
        </div>
      </div>
      <div style="width:5%;">
        <div style=""><!--space--></div>
      </div>
      <div style="width:12.5%">
        <span style="font-size:12px;">Identifiant fiscal :</span>
      </div>
      <div style="width:35%">
        <div class="bordered">
          {{ $cabinet->id_fiscal }}
        </div>
      </div>
    </div>

    <div style="width:100%; height:5px;"><!--space--></div>

    {{-- RC CNSS --}}
    <div style="width:100%; display:flex; flex-wrap:nowrap;">
      <div style="width:12.5%">
        <span>RC :</span>
      </div>
      <div style="width:35%">
        <div class="bordered">
          {{ $cabinet->nrc_cab }}
        </div>
      </div>
      <div style="width:5%">
        <div style=""><!--space--></div>
      </div>
      <div style="width:12.5%">
        <span>N° CNSS :</span>
      </div>
      <div style="width:35%">
        <div class="bordered">
          {{ $cabinet->ncnss }}
        </div>
      </div>
    </div>

    <div style="width:100%; height:15px;"><!--space--></div>

    {{-- Domaines & Moyens --}}
    <div style="width:100%; display:flex; flex-wrap:nowrap;">
      <div style="width:45%">
        <span>Domaine de compétence :</span>
        <div class="bordered">
          {{ $cabinet->dom_compet1 }}
        </div>
        <div style="width:100%; height:3px;"><!--space--></div>
        <div class="bordered">
          {{ $cabinet->dom_compet2 }}
        </div>
        <div style="width:100%; height:3px;"><!--space--></div>
        <div class="bordered">
          {{ $cabinet->dom_compet3 }}
        </div>
      </div>
      <div style="width:10%">
        <div style=""><!--space--></div>
      </div>
      <div style="width:45%">
        <span>Moyens matériels pédagogiques :</span>
        <div class="bordered">
          {{ $cabinet->materiel1 }}
        </div>
        <div style="width:100%; height:3px;"><!--space--></div>
        <div class="bordered">
          {{ $cabinet->materiel2 }}
        </div>
        <div style="width:100%; height:3px;"><!--space--></div>
        <div class="bordered">
          {{ $cabinet->materiel3 }}
        </div>
      </div>
    </div>
    
    <div style="width:100%; height:15px;"><!--space 10px--></div>

    {{-- Effectif --}}
    <div style="width:100%;"><span style="font-size:18px;">Moyens humains de l'Organisme :</span></div>
    <div style="width:100%; height:3px;"><!--space--></div>
    <div style="width:100%; display:flex; flex-wrap:nowrap;">
      <div style="width:35%">
        <span style="font-weight:700; font-size:16px;">Fonction :</span>
        <div style="padding:4px;">
          Consultants/Experts permanents 
        </div>
        <div style="width:100%; height:3px;"><!--space--></div>
        <div style=" padding:4px; font-size:16px;">
          Consultants/Experts vacataires
        </div>
        <div style="width:100%; height:3px;"><!--space--></div>
        <div style=" padding:4px; font-size:16px;">
          Animateurs/Formateurs
        </div>
        <div style="width:100%; height:3px;"><!--space--></div>
        <div style="padding:4px; font-size:16px;">
          Autres employés
        </div>
        <div style="width:100%; height:3px;"><!--space--></div>
        <div style="padding:4px; font-weight:700; font-size:16px;">
          Total
        </div>
      </div>
      <div style="width:5%">
        <div style=""><!--space--></div>
      </div>
      <div style="width:25%">
        <span style="font-weight:700; font-size:16px;">Effetif total (actuel) :</span>
        <div class="bordered">
          {{ $cabinet->nb_permanent }}
        </div>
        <div style="width:100%; height:3px;"><!--space--></div>
        <div class="bordered">
          {{ $cabinet->nb_vacataire }}
        </div>
        <div style="width:100%; height:3px;"><!--space--></div>
        <div class="bordered">
          {{ $cabinet->nb_formateur }}
        </div>
        <div style="width:100%; height:3px;"><!--space--></div>
        <div class="bordered">
          {{ $cabinet->autre_emp }}
        </div>
        <div style="width:100%; height:3px;"><!--space--></div>
        <div class="bordered">
          {{ $cabinet->effectif }}
        </div>
      </div>
      <div style="width:10%">
        <div style=""><!--space--></div>
      </div>
      <div style="width:25%">
        <span style="font-weight:700; font-size:16px;">dont étrangers :</span>
        <div class="bordered">
          {{ $cabinet->nb_permanent_etr }}
        </div>
        <div style="width:100%; height:3px;"><!--space--></div>
        <div class="bordered">
          {{ $cabinet->nb_vacataire_etr }}
        </div>
        <div style="width:100%; height:3px;"><!--space--></div>
        <div class="bordered">
          {{ $cabinet->nb_formateur_etr }}
        </div>
        <div style="width:100%; height:3px;"><!--space--></div>
        <div class="bordered">
          {{ $cabinet->autre_emp_etr }}
        </div>
        <div style="width:100%; height:3px;"><!--space--></div>
        <div class="bordered">
          {{ $cabinet->effectif_etr }}
        </div>
      </div>
    </div>
    
    <div style="width:100%; height:10px;"><!--space--></div>
    
    <div style="width:100%; display:flex; flex-wrap:nowrap;">
      <div style="width:59%">
        <span style="font-size:19px">L'organisme appartient-il à un groupe étranger ?</span>
      </div>
      <div style="width:1%">
        <div style=""><!--space--></div>
      </div>
      <div style="width:40%;">
        <span style="font-size:19px; font-weight:600">
          {{ ucfirst($cabinet->org_etranger) }}
        </span>
      </div>
    </div>
    
    {{-- Signature Cachet --}}
    <div style="width:100%; display:flex; flex-wrap:nowrap;">
      <div style="width:45%">
        <span style="font-size:16px;">Fait à :</span>
        <div class="bordered">
          {{-- {{ $cabinet->ville }} --}}
          @php $villes =
          ['Casablanca', 'Settat', 'Salé', 'Fès', 'Tanger', 'Marrakech', 'Meknès', 'Rabat', 'Oujda', 'Kénitra', 'Agadir', 'Tétouan',
            'Témara', 'Safi', 'Mohammédia', 'El Jadida', 'Béni Mellal', 'Taza', 'Khémisset', 'Taourirt']; @endphp
          <select name="ville_cab" class="select" id="ville_cab" style="width:100%;">
            @foreach ($villes as $ville)
              <option value="{{$ville}}">{{$ville}}</option>
            @endforeach
          </select>
        </div>
        <span style="font-size:16px;">Nom et prénom :</span>
        <div class="bordered">
          @php 
            $dg1 = $cabinet->nom_gr1." ".$cabinet->pren_gr1;
            $dg2 = $cabinet->nom_gr2." ".$cabinet->pren_gr2;
            $dirigeant = ['dg1' => $dg1, 'dg2' => $dg2];
          @endphp
          <select name="dg_cab" class="select" id="dg_cab" style="width:100%;">
            @foreach ($dirigeant as $dg)
              <option value="{{$dg}}">{{$dg}}</option>
            @endforeach
          </select>
        </div>
        <span style="font-size:16px;">Qualité :</span>
        <div class="bordered">
          {{ $cabinet->qualit_gr1 }}
        </div>
        <span style="font-size:12px; font-weight:600;">
          * Pour les personnes physiques, joindre une attestation d'inscription au rôle des Patentes
        </span>
      </div>
      <div style="width:10%;">
        <div style=""><!--space--></div>
      </div>
      <div style="width:45%;">
        <span style="font-size:16px;">Le :</span>
        <div class="bordered">
          {{-- date document --}}
          <input type="date" style="width:100%; border: none !important; width:99%; height: 99%" id="date_today" name="date_today" value="{{date("Y-m-d")}}">
        </div>
        <span style="font-size:16px;">Signature et cachet de l'Organisme :</span>
        <div style="height:120px; border:1px solid black;">
          {{-- signature et cacheter --}}
        </div>
      </div>
    </div>

  </div>
  {{-- /fields --}}


  <div style="width:100%; height:3px;"><!--space--></div>


  {{-- Footer --}}
  <div style="position:relative; bottom:0; font-size:13px; position:fixed;">
    <p>Ce formulaire est disponible sur le Portail des CSF à l'adresse: <span><a href="http://csf.ofppt.org.ma">http://csf.ofppt.org.ma.</a></span> Il peut être rempli sur l'écran en tant que 
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