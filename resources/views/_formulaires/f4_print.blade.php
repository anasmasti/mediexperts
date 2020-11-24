{{-- 
@extends('_formulaires.f4')

<style>
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
</style>

<div class="hide-from-print">
  <div style="display:flex; justify-content:space-between;">
    <a class="bu-print" id="" href="/">Retour</a>
    <a class="bu-print" id="buPrintF4" href="#" onclick="window.print()">Imprimer le formulaire</a>
  </div>

  <div style="width: 100%;">
    <label for="plan">Sélectionner le plan pour passer à choisir les formations :</label>
    <select name="plan" id="plan" style="width: 60%;padding: .5rem; border: 1px solid #000;">
      <option selected disabled>--sélectionner le plan</option>
      @foreach ($plan as $pf)
        <option value="{{$pf->n_form}}">N° Plan {{$pf->n_form}} {{">"}} {{$pf->nom_theme}} {{">"}} {{$pf->raisoci}}</option>
      @endforeach
    </select>
  </div>
</div> --}}


