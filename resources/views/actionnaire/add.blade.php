@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Ajout</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/actionnaire">Actionnaire</a></li>
            <li class="breadcrumb-item active">Ajout</li>
        </ol>
    </div><!-- /.col -->
@endsection

{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('sweet::alert') --}}

<!-- CARD -->
<div class="card card-dark">
        <!-- card-header -->
        <div class="card-header">
            <h3 class="card-title">Ajout Actionnaire</h3>
        </div>
        <!-- /.card-header -->
        <form role="form" action="/add-act" method="POST">
        <div class="card-body">
            <div class="row">
                {{ csrf_field() }}
                {{-- <div class="form-group col-3"><label for="id_act">ID actionnaire</label><input class="form-control {{ $errors->has('id_act') ? ' is-invalid' : 'id_act' }}"  value="{{old('id_act') }}" type="text" name="id_act" min="0" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="auto incrémenté.." readonly>
                    @if ($errors->has('id_act'))
                    <span class="invalid-feedback" role="alert">
                       {{ $errors->first('id_act') }}
                    </span>
                    @endif
                </div> --}}

                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible col-12">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i>Erreurs</h5>
                        <span>Veuillez vérifier les champs</span>
                        {{-- <span>{{$errors}}</span> --}}
                    </div>
                @endif

                <div class="form-group col-6">
                    <label for="nrc_e">Entreprise</label>
                    <select class="form-control {{ $errors->has('nrc_e') ? ' is-invalid' : 'nrc_e' }}"  value="{{old('nrc_e') }}" name="nrc_e">
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

                <div class="form-group col-3"><label for="nom">Nom</label><input class="form-control {{ $errors->has('nom') ? ' is-invalid' : 'nom' }}"  value="{{old('nom') }}" type="text" name="nom" maxlength="30" placeholder="Nom" >
                    @if ($errors->has('nom'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('nom') }}
                    </span>
                    @endif
                </div>
                <div class="form-group col-3"><label for="prenom">Prénom</label><input class="form-control {{ $errors->has('prenom') ? ' is-invalid' : 'prenom' }}"  value="{{old('prenom') }}" type="text" name="prenom" maxlength="30" placeholder="Prénom" >
                    @if ($errors->has('prenom'))
                    <span class="invalid-feedback" role="alert">
                       {{ $errors->first('prenom') }}
                    </span>
                    @endif
                </div>
                <div class="form-group col-3"><label for="nb_acts">Nb. actions</label><input class="form-control {{ $errors->has('nb_acts') ? ' is-invalid' : 'nb_acts' }}"  value="{{old('nb_acts') }}" type="text" name="nb_acts" min="0" maxlength="4" onkeypress="return isNumberKey(event)" placeholder="Nb. actions" >
                    @if ($errors->has('nb_acts'))
                    <span class="invalid-feedback" role="alert">
                       {{ $errors->first('nb_acts') }}
                    </span>
                    @endif
                </div>

                <div class="form-group col-3">
                <label for="percent">Pourcentage</label>
                    <div class="input-group">
                        <input class="form-control {{ $errors->has('percent') ? ' is-invalid' : 'percent' }}"  value="{{old('percent') }}" type="text" name="percent" min="0" maxlength="3" onkeypress="return isNumberKey(event)" placeholder="Pourcentage" >
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-percent"></i></span>
                            </div>
                            @if ($errors->has('percent'))
                            <span class="invalid-feedback" role="alert">
                            {{ $errors->first('percent') }}
                            </span>
                            @endif
                    </div>
                </div>

                <div class="form-group col-12"><label for="commentaire">Commentaire</label><textarea class="form-control" type="text" rows="4" name="commentaire" maxlength="900" placeholder="Commentaire .."></textarea></div>

            </div><!--./row-->
        </div><!--./card-body-->

        <div class="card-footer text-center">
            @if (count($client)!=0)
                <button class="btn bu-add" type="submit" id="add"><i class="fas fa-plus-circle"></i>&nbsp;Ajouter</button>
            @else
                <a class="btn bu-add" href="/add-cl"><i class="fas fa-plus-circle"></i>&nbsp;Ajouter Entreprise</a>
            @endif
            <a class="btn bu-danger" href="/actionnaire"><i class="fas fa-window-close"></i>&nbsp;Annuler</a>
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
