@extends('layouts.admin')

@section('content')

        @foreach($cabinet as $cab)
            @if ($cab->nrc_cab==$interv->nrc_c)
                <?php $nrc = $cab->nrc_cab ?>
                <?php $name = $cab->raisoci ?>
            @endif
        @endforeach

@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Modification</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/intervenant">Intervenant</a></li>
            <li class="breadcrumb-item active">{{ $interv->nom }} {{ $interv->prenom }}</li>
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
            <h3 class="card-title">Modifier {{ $interv->nom }} {{ $interv->prenom }}</h3>
        </div>
        <!-- /.card-header -->
        <form role="form" action="/edit-inv/{{ $interv->id_interv }}" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row">
                {{ csrf_field() }}
                {{-- <div class="form-group col-lg-3 col-sm-12"><label>ID Intervenant</label><input class="form-control {{ $errors->has('id_interv') ? ' is-invalid' : '' }}" type="text" name="id_interv" min="0" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="ID Intervenant" value="{{ $interv->id_interv }}" ></div> --}}
                <div class="form-group col-lg-6 col-sm-12">
                    <label for="nrc_c">Cabinet&nbsp;&nbsp;<i class="fas fa-tag"></i></label>
                    <select class="form-control" name="nrc_c">
                        @foreach ($cabinet as $cab)
                            @if ($cab->nrc_cab==$interv->nrc_c)
                                <option value="{{$cab->nrc_cab}}" selected>{{$cab->raisoci}}</option>
                            @else
                                <option value="{{$cab->nrc_cab}}">{{$cab->nrc_cab}} | {{$cab->raisoci}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
        <div class="form-group col-lg-3 col-sm-12"><label>Nom</label><input class="form-control {{ $errors->has('nom') ? ' is-invalid' : '' }}" type="text" name="nom" maxlength="30" placeholder="Nom" value="{{ $interv->nom }}" >
            @if ($errors->has('nom'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nom') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Prénom</label><input class="form-control {{ $errors->has('prenom') ? ' is-invalid' : '' }}" type="text" name="prenom" maxlength="30" placeholder="Prénom" value="{{ $interv->prenom }}" >
            @if ($errors->has('prenom'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('prenom') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-6 col-sm-12"><label>Spécificité</label>
            <textarea class="form-control {{ $errors->has('specif') ? ' is-invalid' : '' }}"  name="specif" min="10" maxlength="1000" placeholder="Spécificité">{{$interv->specif}}</textarea>
            @if ($errors->has('specif'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('specif') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-6 col-sm-12"><label>Domaines d'intervention</label>
            <textarea class="form-control {{ $errors->has('dom_interv') ? ' is-invalid' : '' }}" name="dom_interv" min="10" maxlength="1000" placeholder="domaine" >{{$interv->dom_interv}}</textarea>
            @if ($errors->has('dom_interv'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('dom_interv') }}</strong>
                </span>
            @endif
        </div>


        <div class="form-group col-lg-3 col-sm-12"><label>Langues parlées</label><input class="form-control {{ $errors->has('langs') ? ' is-invalid' : '' }}" type="text" name="langs" min="0" maxlength="100" placeholder="Langues" value="{{ $interv->langs }}" >

            @if ($errors->has('langs'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('langs') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-12"><label>Modules de formation</label>
            <textarea class="form-control {{ $errors->has('module') ? ' is-invalid' : '' }}" type="text" rows="2" name="module" maxlength="400"  placeholder="Modules" readonly>{{ $interv->module }}</textarea>
            @if ($errors->has('module'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('module') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>Téléphone</label><input class="form-control {{ $errors->has('tele') ? ' is-invalid' : '' }}" type="text" name="tele" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="Tél." value="{{ $interv->tele }}" >
            @if ($errors->has('tele'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('tele') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-lg-3 col-sm-12"><label>E-mail</label><input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" maxlength="50" placeholder="E-Mail" value="{{ $interv->email }}" >
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>


        <div class="form-group col-lg-3 col-sm-12"><label>C.V.</label><input class="form-control {{ $errors->has('cv') ? ' is-invalid' : '' }}" type="file" name="cv" min="0" maxlength="100" placeholder="Langues" value="{{ $interv->cv }}" >

            @if ($errors->has('cv'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('cv') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group col-12"><label>Commentaire</label><textarea class="form-control" type="text" rows="4" name="commentaire" maxlength="900" placeholder="Commentaire ..">{{ $interv->commentaire }}</textarea></div>


        </div><!--./row-->
        </div><!--./card-body-->

        <div class="card-footer text-center">
            <button class="btn bu-add" type="submit" id="edit" ><i class="fas fa-pen-square"></i>&nbsp;Modifier</button>
            <a class="btn bu-danger" href="/intervenant"><i class="fas fa-window-close"></i>&nbsp;Annuler</a>
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
