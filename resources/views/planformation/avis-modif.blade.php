@extends('layouts.admin')

@section('content')

@section('content-wrapper')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Avis de modification</h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/planformation">Imprimer</a></li>
      <li class="breadcrumb-item active">Ajout</li>
    </ol>
  </div><!-- /.col -->


@endsection

{{-- jquery scripts --}}
<script src={{ asset('js/jquery.js') }}></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


{{-- jquery scripts --}}

<div class="card card-dark">
  <!-- card-header -->
  <div class="card-header">
    <h3 class="card-title">Annuler ou modifier l'état d'avis</h3>
  </div><br>
  <!-- /.card-header -->
  <form role="form" action="/add-pf" method="POST">
    {{ csrf_field() }}
    <div class="card-body">
      <div class="row">


    <div class="form-group col-lg-6 col-sm-12">
      <label>État d'avis</label>
      <select class="form-control">
        <option selected disabled>---selectionner l'état---</option>
          <option>Annulation</option>
          <option>Modification</option>
      </select>
    </div>


    <table class="table table-striped col-12 col-lg-6 border" style="margin: 16px">
      <thead>
        <tr>
          <th style="width: 10%" rowspan="6">Avis</th>
          <th style="width: 10%">Anulation</th>
          <th style="width: 10%" colspan="2"> <input type="checkbox"> </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th rowspan="5">Modification</th>
        </tr>
        <tr>
          <th style="width: 5%">De la date de Réalisation</th>
          <th> <input type="checkbox"> </th>
        </tr>
        <tr>
          <th style="width: 5%">De l’organisme de formation</th>
          <th> <input type="checkbox"> </th>
        </tr>
        <tr>
          <th style="width: 5%">De lieu de formation</th>
          <th> <input type="checkbox"> </th>
        </tr>
        <tr>
          <th style="width: 5%">Organisation horaire</th>
          <th> <input type="checkbox"> </th>
        </tr>
      </tbody>
    </table>



    <div class="form-group col-lg-6 col-sm-12">
      <label>Thème de l’action</label>
      <select class="form-control">
        <option selected disabled>---selectionner le thème---</option>
          <option>---</option>
          <option>---</option>
      </select>
    </div>
<div class="form-group col-lg-6 col-sm-12">
<label>Nature de l'action</label>
  <div class="form-group">
  <div class="custom-control custom-checkbox">
      <input type="checkbox" name="planifie" id="planifie" class="custom-control-input" checked>
      <label for="planifie" class="custom-control-label">Planifié</label>
  </div>
  <div class="custom-control custom-checkbox">
    <input type="checkbox" name="nonplanifie" id="nonplanifie" class="custom-control-input">
    <label for="nonplanifie" class="custom-control-label">Non planifié</label>
</div>
<div class="custom-control custom-checkbox">
  <input type="checkbox" name="alpha" id="alpha" class="custom-control-input">
  <label for="alpha" class="custom-control-label">Alpha</label>
</div>
  </div>
</div>


    <div class="form-group col-lg-6 col-sm-12">
          <label>Organisme de formation initial</label>
          <input type="text" name="" id="" class="form-control">
    </div>
    <div class="form-group col-lg-6 col-sm-12">
      <label>Nouvel Organisme de formation</label>
      <select class="form-control">
        <option selected disabled>---selectionner l'organisme---</option>
          <option>-----</option>
          <option>------</option>
      </select>
    </div>


      </div>
    </div>
  </form>

</div><!-- ./CARD -->







@endsection


