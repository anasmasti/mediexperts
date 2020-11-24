@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Ajout</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/giac">GIAC</a></li>
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
            <h3 class="card-title">Ajout GIAC</h3>
        </div>
        <!-- /.card-header -->
        <form role="form" action="/add-gc" method="POST">
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

                {{-- <div class="form-group col-lg-3 col-sm-12"><label>Code GIAC</label><input class="form-control {{ $errors->has('code_giac') ? ' is-invalid' : '' }}" value="{{old('code_giac')}}" type="text" name="code_giac"  min="0" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="auto incrémenté.." readonly>
                @if ($errors->has('code_giac'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('code_giac') }}</strong>
                </span>
                @endif
                </div> --}}


                <div class="form-group col-lg-6 col-sm-12"><label>Libellé</label><input class="form-control {{ $errors->has('libelle') ? ' is-invalid' : '' }}" value="{{old('libelle')}}" type="text" name="libelle" maxlength="50" placeholder="Libellé" >
                @if ($errors->has('libelle'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('libelle') }}</strong>
                </span>
                @endif
                </div>

                <div class="form-group col-lg-6 col-sm-12"><label>Spécificité</label><input class="form-control {{ $errors->has('specif') ? ' is-invalid' : '' }}" value="{{old('specif')}}" type="text" name="specif" maxlength="50" placeholder="Spécificité" >

                @if ($errors->has('specif'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('specif') }}</strong>
                </span>
                @endif
                </div>

                <div class="form-group col-12"><!--space 12--></div>

                <div class="form-group col-lg-6 col-sm-12"><label>Adresse local 1</label><input class="form-control {{ $errors->has('adlocal_1') ? ' is-invalid' : '' }}" value="{{old('adlocal_1')}}" type="text" name="adlocal_1" maxlength="100" placeholder="Local 1" >

                @if ($errors->has('adlocal_1'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('adlocal_1') }}</strong>
                </span>
                @endif
                </div>

                <div class="form-group col-lg-6 col-sm-12"><label>Adresse local 2</label><input class="form-control {{ $errors->has('adlocal_2') ? ' is-invalid' : '' }}" value="{{old('adlocal_2')}}" type="text" name="adlocal_2" maxlength="100" placeholder="Local 2" >

                @if ($errors->has('adlocal_2'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('adlocal_2') }}</strong>
                </span>
                @endif
                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Téléphone</label><input class="form-control {{ $errors->has('tele') ? ' is-invalid' : '' }}" value="{{old('tele')}}" type="text" name="tele" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="Tél." >

                @if ($errors->has('tele'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('tele') }}</strong>
                </span>
                @endif
                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Fax</label><input class="form-control {{ $errors->has('fax') ? ' is-invalid' : '' }}" value="{{old('fax')}}" type="text" name="fax" min="0" maxlength="13" onkeypress="return isNumberKey(event)" placeholder="Fax" >

                @if ($errors->has('fax'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('fax') }}</strong>
                </span>
                @endif
                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>E-mail</label><input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{old('email')}}" type="email" name="email" maxlength="50" placeholder="E-Mail" >
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Site-Web</label><input class="form-control {{ $errors->has('website') ? ' is-invalid' : '' }}" value="{{old('website')}}" type="url" name="website" maxlength="50" placeholder="URL" >
                @if ($errors->has('website'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('website') }}</strong>
                </span>
                @endif
                </div>

                <div class="form-group col-12"><!--space 12--></div>

                <div class="form-group col-lg-3 col-sm-12"><label>Nom DG</label><input class="form-control {{ $errors->has('nom_dg') ? ' is-invalid' : '' }}" value="{{old('nom_dg')}}" type="text" name="nom_dg" maxlength="50" placeholder="Nom" >

                @if ($errors->has('nom_dg'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nom_dg') }}</strong>
                </span>
                @endif

                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Tél. DG</label><input class="form-control {{ $errors->has('tel_dg') ? ' is-invalid' : '' }}" value="{{old('tel_dg')}}" type="text" name="tel_dg" min="0" maxlength="50" onkeypress="return isNumberKey(event)" placeholder="Tél." >
                @if ($errors->has('tel_dg'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('tel_dg') }}</strong>
                </span>
                @endif

                </div>
                <div class="form-group col-lg-3 col-sm-12"><label>E-mail DG</label><input class="form-control {{ $errors->has('email_dg') ? ' is-invalid' : '' }}" value="{{old('email_dg')}}" type="email" name="email_dg" maxlength="50" placeholder="email@email.com" >

                @if ($errors->has('email_dg'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email_dg') }}</strong>
                </span>
                @endif

                </div>

                <div class="form-group col-lg-3 col-sm-12"><!--space 3--></div>

                <div class="form-group col-lg-3 col-sm-12"><label>Nom responsable</label><input class="form-control {{ $errors->has('nom_resp') ? ' is-invalid' : '' }}" value="{{old('nom_resp')}}" type="text" name="nom_resp" maxlength="50" placeholder="Nom responsable" >
                @if ($errors->has('nom_resp'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nom_resp') }}</strong>
                </span>
                @endif

                </div>


                <div class="form-group col-lg-3 col-sm-12"><label>Tél. responsable</label><input class="form-control {{ $errors->has('tel_resp') ? ' is-invalid' : '' }}" value="{{old('tel_resp')}}" type="text" name="tel_resp" min="0" maxlength="50" onkeypress="return isNumberKey(event)" placeholder="Tél. responsable" >

                    @if ($errors->has('tel_resp'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tel_resp') }}</strong>
                    </span>
                @endif

                </div>
                <div class="form-group col-lg-3 col-sm-12"><label>E-mail responsable</label><input class="form-control {{ $errors->has('email_resp') ? ' is-invalid' : '' }}" value="{{old('email_resp')}}" type="email" name="email_resp" maxlength="50" placeholder="email@email.com" >
                @if ($errors->has('email_resp'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email_resp') }}</strong>
                    </span>
                @endif
                </div>

                <div class="form-group col-12"><label>Commentaire</label><textarea class="form-control" type="text" rows="4" name="commentaire" maxlength="900" placeholder="Commentaire ..">{{old('commentaire')}}</textarea></div>

            </div><!--./row-->
        </div><!--./card-body-->

        <div class="card-footer text-center">
            <button class="btn buaj2" type="submit" id="add" ><i class="fas fa-plus-circle"></i>&nbsp;Ajouter</button>
            <a class="btn bua2" href="/giac"><i class="fas fa-window-close"></i>&nbsp;Annuler</a>
            {{-- <a class="btn" onclick="toastr.info('Hi! I am info message.');">TOASTR</a> --}}
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
