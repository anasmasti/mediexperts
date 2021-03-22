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
        <form enctype="multipart/form-data" role="form" action="{{ url('/import/import-pers') }}" method="POST">
        <div class="card-body">
            <div class="row">
                {{ csrf_field() }}

                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible col-12">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Erreur!</h5>
                        Le fichier n'a pas été importé ou il contient des données invalides!
                        <span>{{$errors}}</span>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible col-12">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Succès!</h5>
                        {{ session()->get('success')}}
                    </div>
                @endif
                {{-- @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif --}}

                {{-- MAIN --}}
                <div class="form-group col-lg-12 col-sm-12"><label>Importer un fichier Excel</label>
                    <input class="form-control {{ $errors->has('pers_file') ? ' is-invalid' : '' }}" type="file" name="pers_file" id="pers_file">
                    @if ($errors->has('pers_file'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('pers_file') }}</strong>
                        </span>
                        @isset($err_file)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $err_file }}</strong>
                            </span>
                        @endisset
                    @endif
                </div>

                <div class="form-group col-lg-12 col-sm-12 text-center">
                    <button class="btn bu-add" type="submit" name="upload" id="upload"><i class="fas fa-upload"></i>&nbsp;Envoyer</button>
                </div>
                {{-- MAIN --}}

            </div><!--./row-->
        </div><!--./card-body-->

        {{-- <div class="card-footer text-center">
            <button class="btn bu-add" type="submit" id="add" ><i class="fas fa-plus-circle"></i>&nbsp;Ajouter</button>
            <a class="btn bu-danger" href="/personnel"><i class="fas fa-window-close"></i>&nbsp;Annuler</a>
        </div> --}}

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
