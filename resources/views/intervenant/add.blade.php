@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Ajout</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/intervenant">Intervenant</a></li>
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
        <h3 class="card-title">Ajout Intervenant</h3>
    </div>
    <!-- /.card-header -->
    <form role="form" action="/add-inv" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <div class="row">
            {{ csrf_field() }}


            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible col-12">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Erreurs</h5>
                    <span>Veuillez vérifier les champs</span>
                    <span>{{$errors}}</span>
                </div>
            @endif

            {{-- <div class="form-group col-lg-3 col-sm-12"><label>ID Intervenant</label><input class="form-control {{ $errors->has('id_interv') ? ' is-invalid' : '' }}" value="{{old('id_interv')}}" type="text" name="id_interv" min="0" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="ID Intervenant" >
                @if ($errors->has('id_interv'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('id_interv') }}</strong>
                </span>
                @endif
            </div> --}}

            <div class="form-group col-lg-6 col-sm-12">
                <label for="nrc_c">Cabinet&nbsp;<i class="fas fa-tag"></i></label>
                @if (count($cabinet)==0)
                    <a class="btn bu-icon bu-sm btn-sm" href="/add-cab"><i class="fa fa-plus"></i></a>
                @endif
                <select class="form-control {{ $errors->has('nrc_c') ? ' is-invalid' : '' }}" name="nrc_c" id="nrc_c" value="{{old('nrc_c')}}">
                    <option selected disabled>-cabinet</option>
                    @foreach ($cabinet as $cab)
                        <option value="{{$cab->nrc_cab}}">{{$cab->raisoci}}</option>
                    @endforeach
                </select>
                @if (count($cabinet)==0)
                    <div class="text-danger txt-sm">Veuillez d'abord ajouter un cabinet</div>
                @endif

                    @if ($errors->has('nom'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nom') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group col-lg-3 col-sm-12"><label>Nom</label><input class="form-control {{ $errors->has('nom') ? ' is-invalid' : '' }}" value="{{old('nom')}}" type="text" name="nom" maxlength="30" placeholder="Nom" >

            @if ($errors->has('nom'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nom') }}</strong>
                </span>
            @endif

            </div>

            <div class="form-group col-lg-3 col-sm-12"><label>Prénom</label><input class="form-control {{ $errors->has('prenom') ? ' is-invalid' : '' }}" value="{{old('prenom')}}" type="text" name="prenom" maxlength="30" placeholder="Prénom" >
            @if ($errors->has('prenom'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('prenom') }}</strong>
                </span>
            @endif
            </div>

            <div class="form-group col-lg-6 col-sm-12"><label>Spécificité</label>
                <textarea class="form-control {{ $errors->has('specif') ? ' is-invalid' : '' }}"  name="specif" min="10" maxlength="1000" placeholder="Spécificité">{{old('specif')}}</textarea>
                @if ($errors->has('specif'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('specif') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-6 col-sm-12"><label>Domaines d'intervention</label>
                <textarea class="form-control {{ $errors->has('dom_interv') ? ' is-invalid' : '' }}" name="dom_interv" min="10" maxlength="1000" placeholder="domaine" >{{old('dom_interv')}}</textarea>
            @if ($errors->has('dom_interv'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('dom_interv') }}</strong>
                </span>
            @endif
            </div>

            <div class="form-group col-lg-6 col-sm-12"><label>Langues parlées</label><input class="form-control {{ $errors->has('langs') ? ' is-invalid' : '' }}" value="{{old('langs')}}" type="text" name="langs" min="0" maxlength="100" placeholder="Langues">
                @if ($errors->has('langs'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('langs') }}</strong>
                    </span>
                @endif
            </div>

            {{-- <div class="form-group col-12"><label>Modules de formation</label>
                <textarea class="form-control {{ $errors->has('module') ? ' is-invalid' : '' }}" type="text" rows="2" name="module" maxlength="400" placeholder="Modules" readonly>{{old('module')}}</textarea>
                @if ($errors->has('module'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('module') }}</strong>
                    </span>
                @endif
            </div> --}}

            <div class="form-group col-lg-3 col-sm-12"><label>Téléphone</label><input class="form-control {{ $errors->has('tele') ? ' is-invalid' : '' }}" value="{{old('tele')}}" type="text" name="tele" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="Tél." >
            @if ($errors->has('tele'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('tele') }}</strong>
                </span>
            @endif
            </div>

            <div class="form-group col-lg-3 col-sm-12"><label>E-Mail</label><input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{old('email')}}" type="email" name="email" maxlength="50" placeholder="E-Mail" >
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            </div>


            <div class="form-group col-lg-6 col-sm-12"><label>C.V.</label><input class="form-control custom-file-upload {{ $errors->has('cv') ? ' is-invalid' : '' }}" type="file" name="cv">
                @if ($errors->has('cv'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('cv') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-12"><label>Commentaire</label>
                <textarea class="form-control" type="text" rows="3" name="commentaire" maxlength="900" placeholder="Commentaire ..">{{old('commentaire')}}</textarea>
            </div>

        {{-- <div class="form-group col-lg-6 col-sm-12">
            <div class="input-group">
                <div class="custom-file">
                <input type="file" class="custom-file-input" id="cv">
                <label class="custom-file-label" for="cv">Parcourir le fichier</label>
                </div>
                <div class="input-group-append">
                <span class="input-group-text" id="">Importer</span>
                </div>
            </div>
        </div> --}}

    </div><!--./row-->
    </div><!--./card-body-->


    <div class="card-footer text-center">
        @if (count($cabinet)!=0)
            <button class="btn bu-add" type="submit" id="add"><i class="fas fa-plus-circle"></i>&nbsp;Ajouter</button>
        @endif
        <a class="btn bu-danger" href="/intervenant"><i class="fas fa-window-close"></i>Annuler</a>
    </div>


    </form>
</div><!-- ./CARD -->



{{-- TOASTR NOTIFICATIONS --}}
@if (Session::has('added'))
<script>
    $(document).ready(function() {
        toastr.options.timeOut = 0;
        toastr.options.extendedTimeOut = 0;
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
        toastr.options.timeOut = 0;
        toastr.options.extendedTimeOut = 0;
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
        toastr.options.timeOut = 0;
        toastr.options.extendedTimeOut = 0;
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
        toastr.options.timeOut = 0;
        toastr.options.extendedTimeOut = 0;
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
        toastr.options.timeOut = 0;
        toastr.options.extendedTimeOut = 0;
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
        toastr.options.timeOut = 0;
        toastr.options.extendedTimeOut = 0;
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
        toastr.options.timeOut = 0;
        toastr.options.extendedTimeOut = 0;
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
