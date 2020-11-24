@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Ajout</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/personnel">Personnel</a></li>
            <li class="breadcrumb-item active">Ajout</li>
        </ol>
    </div><!-- /.col -->
@endsection

{{-- jquery scripts --}}
<script src={{ asset('js/jquery.js') }}></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
{{-- jquery scripts --}}

<!-- CARD -->
<div class="card card-dark">
        <!-- card-header -->
        <div class="card-header">
            <h3 class="card-title">Ajout Personnel</h3>
        </div>
        <!-- /.card-header -->
        <form role="form" action="/add-pers" method="POST">
        <div class="card-body">
            <div class="row">
                {{ csrf_field() }}

                <div class="form-group col-12">
                    <label for="nrc_e">Entreprise</label>
                    <select class="form-control {{ $errors->has('nrc_e') ? 'is-invalid' : '' }}"  value="{{old('nrc_e') }}" name="nrc_e">
                        <option selected disabled>-entreprise</option>
                        @foreach ($client as $cl)
                            <option value="{{$cl->nrc_entrp}}">{{$cl->raisoci}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('nrc_e'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('nrc_e') }}
                    </span>
                    @endif
                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Matricule</label>
                    <input class="form-control {{ $errors->has('matricule') ? 'is-invalid' : '' }}" value="{{old('matricule')}}" type="text" name="matricule" min="0" maxlength="10" placeholder="matricule">
                    @if ($errors->has('matricule'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('matricule') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>CIN</label>
                    <input class="form-control {{ $errors->has('cin') ? 'is-invalid' : '' }}" value="{{old('cin')}}" type="text" name="cin" min="0" maxlength="10" placeholder="cin">
                    @if ($errors->has('cin'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('cin') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Nom</label>
                    <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" value="{{old('nom')}}" type="text" name="nom" maxlength="50" placeholder="nom" >
                    @if ($errors->has('nom'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nom') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Prénom</label>
                    <input class="form-control {{ $errors->has('prenom') ? 'is-invalid' : '' }}" value="{{old('prenom')}}" type="text" name="prenom" maxlength="50" placeholder="prénom" >
                    @if ($errors->has('prenom'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('prenom') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>CNSS</label>
                    <input class="form-control {{ $errors->has('cnss') ? 'is-invalid' : '' }}" value="{{old('cnss')}}" type="text" name="cnss" min="0" maxlength="12" onkeypress="return isNumberKey(event)" placeholder="numero" >
                    @if ($errors->has('cnss'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('cnss') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Date naissance</label>
                    <input class="form-control {{ $errors->has('dt_naiss') ? 'is-invalid' : '' }}" value="{{old('dt_naiss')}}" type="text" name="dt_naiss" onmouseover="(this.type='date')" id="dt_naiss" placeholder="date">
                    @if ($errors->has('dt_naiss'))
                        <span class="invalid-feedback" role="alert">
                        {{ $errors->first('dt_naiss') }}
                        </span>
                    @endif
                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Date d'embauche</label>
                    <input class="form-control {{ $errors->has('dt_embch') ? 'is-invalid' : '' }}" value="{{old('dt_embch')}}" type="text" name="dt_embch" onmouseover="(this.type='date')" id="dt_embch" placeholder="date">
                    @if ($errors->has('dt_embch'))
                        <span class="invalid-feedback" role="alert">
                        {{ $errors->first('dt_embch') }}
                        </span>
                    @endif
                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Date démission</label>
                    <input class="form-control {{ $errors->has('dt_demiss') ? 'is-invalid' : '' }}" value="{{old('dt_demiss')}}" type="text" name="dt_demiss" onmouseover="(this.type='date')" id="dt_demiss" placeholder="facultatif">
                    @if ($errors->has('dt_demiss'))
                        <span class="invalid-feedback" role="alert">
                        {{ $errors->first('dt_demiss') }}
                        </span>
                    @endif
                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Fonction</label>
                    <input class="form-control {{ $errors->has('fonction') ? 'is-invalid' : '' }}" value="{{old('fonction')}}" type="text" name="fonction" maxlength="50" placeholder="fonction" >
                    @if ($errors->has('fonction'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('fonction') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>CSP</label>
                    @php $csp = ['E', 'O', 'C']; @endphp
                    <select class="form-control {{ $errors->has('csp') ? 'is-invalid' : '' }}" name="csp" id="csp">
                        <option selected disabled>*</option>
                        @foreach ($csp as $cs)
                            <option value="{{$cs}}">{{$cs}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('csp'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('csp') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>ÉTAT</label>
                    @php $etat = ['disponible', 'non disponible']; @endphp
                    <select class="form-control {{ $errors->has('dt_embch') ? 'is-invalid' : '' }}" name="etat" id="etat">
                        <option selected disabled>*</option>
                        @foreach ($etat as $et)
                            <option value="{{ucfirst($et)}}">{{ucfirst($et)}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('etat'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('etat') }}</strong>
                        </span>
                    @endif
                </div>


            </div><!--./row-->
        </div><!--./card-body-->

        <div class="card-footer text-center">
            <button class="btn buaj2" type="submit" id="add" ><i class="fas fa-plus-circle"></i>&nbsp;Ajouter</button>
            <a class="btn bua2" href="/personnel"><i class="fas fa-window-close"></i>&nbsp;Annuler</a>
        </div>

        </form>
    </div><!-- ./CARD -->



    {{-- TOASTR NOTIFICATIONS --}}
    @if (Session::has('added'))
    <script>
        $(document).ready(function() {
            toastr.options.preventDuplicates = true;
            toastr.options.closeButton = true;
            toastr.options.showEasing = 'swing';
            toastr.options.hideEasing = 'linear';
            toastr.options.closeEasing = 'linear';
            toastr.success("{{ Session::get("added") }}");
        });
    </script>
    @endif
    @if (Session::has('updated'))
    <script>
        $(document).ready(function() {
            toastr.options.preventDuplicates = true;
            toastr.options.closeButton = true;
            toastr.options.showEasing = 'swing';
            toastr.options.hideEasing = 'linear';
            toastr.options.closeEasing = 'linear';
            toastr.success("{{ Session::get("updated") }}");
        });
    </script>
    @endif
    @if (Session::has('deleted'))
    <script>
        $(document).ready(function() {
            toastr.options.preventDuplicates = true;
            toastr.options.closeButton = true;
            toastr.options.showEasing = 'swing';
            toastr.options.hideEasing = 'linear';
            toastr.options.closeEasing = 'linear';
            toastr.success("{{ Session::get("deleted") }}");
        });
    </script>
    @endif
    @if (Session::has('success'))
    <script>
        $(document).ready(function() {
            toastr.options.preventDuplicates = true;
            toastr.options.closeButton = true;
            toastr.options.showEasing = 'swing';
            toastr.options.hideEasing = 'linear';
            toastr.options.closeEasing = 'linear';
            toastr.success("{{ Session::get("success") }}");
        });
    </script>
    @endif
    @if (Session::has('warning'))
    <script>
        $(document).ready(function() {
            toastr.options.preventDuplicates = true;
            toastr.options.closeButton = true;
            toastr.options.showEasing = 'swing';
            toastr.options.hideEasing = 'linear';
            toastr.options.closeEasing = 'linear';
            toastr.warning("{{ Session::get("warning") }}");
        });
    </script>
    @endif
    @if (Session::has('info'))
    <script>
        $(document).ready(function() {
            toastr.options.preventDuplicates = true;
            toastr.options.closeButton = true;
            toastr.options.showEasing = 'swing';
            toastr.options.hideEasing = 'linear';
            toastr.options.closeEasing = 'linear';
            toastr.info("{{ Session::get("info") }}");
        });
    </script>
    @endif
    @if (Session::has('error'))
    <script>
        $(document).ready(function() {
            toastr.options.preventDuplicates = true;
            toastr.options.closeButton = true;
            toastr.options.showEasing = 'swing';
            toastr.options.hideEasing = 'linear';
            toastr.options.closeEasing = 'linear';
            toastr.error("{{ Session::get("error") }}");
        });
    </script>
    @endif
    {{-- TOASTR NOTIFICATIONS --}}



@endsection
