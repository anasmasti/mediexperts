@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">GIAC</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/giac">GIAC</a></li>
            <li class="breadcrumb-item active">{{ $giac->libelle }}</li>
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
            <h3 class="card-title">Modifier GIAC</h3>
        </div>
        <!-- /.card-header -->
    <form role="form" action="/edit-gc/{{ $giac->code_giac }}" method="POST">
        <div class="card-body">
            <div class="row">
            {{ csrf_field() }}
                <div class="form-group col-lg-3 col-sm-12"><label>Code GIAC</label><input class="form-control" onkeypress="return isNumberKey(event)" placeholder="Code GIAC" value="{{$giac->code_giac}}" disabled></div>


                <div class="form-group col-lg-3 col-sm-12"><label>Libellé</label><input class="form-control {{ $errors->has('libelle') ? ' is-invalid' : '' }}" type="text" name="libelle" maxlength="50" value="{{ $giac->libelle }}" placeholder="Libellé" >

                    @if ($errors->has('libelle'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('libelle') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Spécificité</label><input class="form-control {{ $errors->has('specif') ? ' is-invalid' : '' }}" type="text" name="specif" maxlength="50" value="{{ $giac->specif }}" placeholder="Spécif." >

                    @if ($errors->has('specif'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('specif') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Adresse local 1</label><input class="form-control {{ $errors->has('adlocal_1') ? ' is-invalid' : '' }}" type="text" name="adlocal_1" maxlength="99" value="{{ $giac->adlocal_1 }}" placeholder="adresse" >

                    @if ($errors->has('adlocal_1'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('adlocal_1') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Adresse local 2</label><input class="form-control {{ $errors->has('adlocal_2') ? ' is-invalid' : '' }}" type="text" name="adlocal_2" maxlength="99" value="{{ $giac->adlocal_2 }}" placeholder="adresse" >

                    @if ($errors->has('adlocal_2'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('adlocal_2') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Téléphone</label><input class="form-control {{ $errors->has('tele') ? ' is-invalid' : '' }}" type="text" name="tele" min="0" maxlength="13" value="{{ $giac->tele }}" onkeypress="return isNumberKey(event)" placeholder="Tél." >

                    @if ($errors->has('tele'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tele') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Fax</label><input class="form-control {{ $errors->has('fax') ? ' is-invalid' : '' }}" type="text" name="fax" min="0" maxlength="13" value="{{ $giac->fax }}" onkeypress="return isNumberKey(event)" placeholder="Fax" >


                    @if ($errors->has('fax'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('fax') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>E-mail</label><input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" maxlength="50" value="{{ $giac->email }}" placeholder="email@email.com" >

                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="form-group col-6"><label>Site-Web</label><input class="form-control {{ $errors->has('website') ? ' is-invalid' : '' }}" type="url" name="website" maxlength="50" value="{{ $giac->website }}" placeholder="URL" >

                    @if ($errors->has('website'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('website') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Nom DG</label><input class="form-control {{ $errors->has('nom_dg') ? ' is-invalid' : '' }}" type="text" name="nom_dg" maxlength="50" value="{{ $giac->nom_dg }}" placeholder="Nom DG">

                    @if ($errors->has('nom_dg'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nom_dg') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Tél. DG</label><input class="form-control {{ $errors->has('tel_dg') ? ' is-invalid' : '' }}" type="text" name="tel_dg" min="0" maxlength="50" value="{{ $giac->tel_dg }}" onkeypress="return isNumberKey(event)" placeholder="Tél." >

                    @if ($errors->has('tel_dg'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tel_dg') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>E-mail DG</label><input class="form-control {{ $errors->has('email_dg') ? ' is-invalid' : '' }}" type="email" name="email_dg" maxlength="50" value="{{ $giac->email_dg }}" placeholder="email@email.com" >

                    @if ($errors->has('email_dg'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email_dg') }}</strong>
                    </span>
                    @endif


                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Nom responsable</label><input class="form-control {{ $errors->has('nom_resp') ? ' is-invalid' : '' }}" type="text" name="nom_resp" maxlength="50" value="{{ $giac->nom_resp }}" placeholder="Nom responsable" >

                    @if ($errors->has('nom_resp'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nom_resp') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>Tél. responsable</label><input class="form-control {{ $errors->has('tel_resp') ? ' is-invalid' : '' }}" type="text" name="tel_resp" min="0" maxlength="50" value="{{ $giac->tel_resp }}" onkeypress="return isNumberKey(event)" placeholder="Tél." >

                @if ($errors->has('tel_resp'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('tel_resp') }}</strong>
                </span>
                @endif

                </div>

                <div class="form-group col-lg-3 col-sm-12"><label>E-mail responsable</label><input class="form-control {{ $errors->has('email_resp') ? ' is-invalid' : '' }}" type="email" name="email_resp" maxlength="50" value="{{ $giac->email_resp }}" placeholder="email@email.com" >
                    @if ($errors->has('email_resp'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email_resp') }}</strong>
                        </span>
                    @endif

                </div>

                <div class="form-group col-12"><label>Commentaire</label><textarea class="form-control" type="text" rows="3" name="commentaire" maxlength="900" placeholder="Commentaire ..">{{ $giac->commentaire }}</textarea></div>

            </div><!--./row-->
        </div><!--./card-body-->

        <div class="card-footer text-center">
            <button class="btn buaj2" type="submit" id="edit" ><i class="fas fa-pen-square"></i>&nbsp;Modifier</button>
            <a class="btn bua2" href="/detail-gc/{{ $giac->code_giac }}"><i class="fas fa-window-close"></i>&nbsp;Annuler</a>
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
