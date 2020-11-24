@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Ajout</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/theme">Thème</a></li>
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
            <h3 class="card-title">Ajout Thème</h3>
        </div>
        <!-- /.card-header -->
        <form role="form" action="/add-theme" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row">
                {{ csrf_field() }}
                {{-- <div class="form-group col-3"><label>ID</label><input class="form-control {{ $errors->has('id_theme') ? ' is-invalid' : '' }}" type="text" name="id_theme" min="0" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="auto incrémenté.. " disabled>
                    @if ($errors->has('id_theme'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('id_theme') }}</strong>
                        </span>
                    @endif
                </div> --}}

                <div class="form-group col-12"><label>Intitulé thème</label>
                    <input class="form-control {{ $errors->has('nom_theme') ? ' is-invalid' : '' }}" value="{{old('nom_theme')}}" type="text" name="nom_theme" maxlength="300" placeholder="thème" >
                    @if ($errors->has('nom_theme'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nom_theme') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-12">
                    <label for="id_dom">Domaine<span>&nbsp;<i class="fas fa-tag"></i></span></label>
                    @if (count($domain)==0)
                        <a class="btn bu5 bu-sm btn-sm" href="/add-domain"><i class="fa fa-plus"></i></a>
                    @endif
                    <select class="form-control {{ $errors->has('id_dom') ? ' is-invalid' : '' }}" name="id_dom" value="{{old('id_dom')}}">
                        <option selected disabled>{{----}}</option>
                        @foreach ($domain as $dom)
                            <option value="{{$dom->id_domain}}">{{$dom->nom_domain}} > {{$dom->ville}}</option>
                        @endforeach
                    </select>
                    @if (count($domain)==0)
                        <div class="text-danger txt-sm">Veuillez d'abord ajouter un domaine</div>
                    @endif
                    @if ($errors->has('id_dom'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('id_dom') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-lg-6 col-sm-12">
                    <label>Objectifs</label>
                    <textarea class="form-control {{ $errors->has('objectif') ? ' is-invalid' : '' }}" type="text" rows="3" name="objectif" maxlength="2000" placeholder="objectifs ..">{{old('objectif')}}</textarea>
                    @if ($errors->has('objectif'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('objectif') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-lg-6 col-sm-12"><label>Contenu</label>
                    <textarea class="form-control {{ $errors->has('contenu') ? ' is-invalid' : '' }}" type="text" rows="3" name="contenu" maxlength="2000" placeholder="contenu ..">{{old('contenu')}}</textarea>
                    @if ($errors->has('contenu'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('contenu') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-12"><label>Commentaire</label>
                    <textarea class="form-control" type="text" rows="3" name="commentaire" maxlength="2000" placeholder="Commentaire ..">{{old('commentaire')}}</textarea>
                </div>


        </div><!--./row-->
        </div><!--./card-body-->



        <div class="card-footer text-center">
            @if (count($domain)!=0)
                <button class="btn buaj2" type="submit" id="add"><i class="fas fa-plus-circle"></i>&nbsp;Ajouter</button>
            @endif
            <a class="btn bua2" href="/theme"><i class="fas fa-window-close"></i>Annuler</a>
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
