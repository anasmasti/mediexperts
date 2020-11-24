@extends('layouts.admin')

@section('content')


@section('content-wrapper')
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Ajout</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/domain">Domaine</a></li>
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
        <h3 class="card-title">Ajout Domaine</h3>
    </div>
    <!-- /.card-header -->
    <form role="form" action="/add-domain" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <div class="row">
            {{ csrf_field() }}

            @if (session()->has('warning'))
                <div class="alert alert-warning alert-dismissible col-12">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i>Succès</h5>
                    <span>Associer des thèmes !<br>
                        <a class="text-info" href="/add-theme">&nbsp;<span><i class="fas fa-plus-circle"></i>&nbsp;Ajouter des thèmes</span></a>
                    </span>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible col-12">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Erreurs</h5>
                    <span>Veuillez vérifier les champs</span>
                    {{-- <span>{{$errors}}</span> --}}
                </div>
            @endif

            <div class="form-group col-12"><label>Nom domaine</label><input class="form-control {{ $errors->has('nom_domain') ? ' is-invalid' : '' }}" value="{{old('nom_domain')}}" type="text" name="nom_domain" maxlength="300" placeholder="nom domaine" >
                @if ($errors->has('nom_domain'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nom_domain') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-12 col-md-6 col-sm-6 col-lg-4"><label>Coût domaine</label><input class="form-control {{ $errors->has('cout') ? ' is-invalid' : '' }}" value="{{old('cout')}}" type="text" name="cout" id="cout" min="0" maxlength="5" onkeypress="return isNumberKey(event)" placeholder="en DH">
                @if ($errors->has('cout'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('cout') }}
                    </span>
                @endif
            </div>

            <div class="form-group col-12 col-md-6 col-sm-6 col-lg-4">
                <label for="region">Région</label>
                <?php $regions =
                    [
                        "Oued Ed-Dahab - Lagouira", "Laâyoune - Boujdour - Sakia El Hamra", "Guelmim - Es-Semara", "Souss - Massa - Drâa",
                        "Gharb - Chrarda - Béni Hssen", "Chaouia - Ouardigha", "Marrakech - Tensift - Al Haouz", "Oriental",
                         "Grand Casablanca", "Rabat - Salé - Zemmour - Zaër", "Doukkala - Abda", "Tadla - Azilal",
                          "Meknès - Tafilalet", "Fès - Boulemane", "Taza - Al Hoceïma - Taounate", "Tanger - Tétouan"
                    ];
                ?>
                <select class="form-control {{ $errors->has('region') ? ' is-invalid' : '' }}" id="region" name="region" value="{{old('region')}}">
                    <option selected disabled>{{--vide--}}</option>
                    @foreach ($regions as $reg)
                        <option value="{{$reg}}">{{$reg}}</option>
                    @endforeach
                </select>
                    @if ($errors->has('region'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('region') }}</strong>
                        </span>
                    @endif
            </div>


            <div class="form-group col-12 col-md-6 col-sm-6 col-lg-4">
                <label for="ville">Ville</label>
                <?php $villes =
                    [
                        'Casablanca', 'Settat', 'Salé', 'Fès', 'Tanger', 'Marrakech', 'Meknès', 'Rabat', 'Oujda', 'Kénitra', 'Agadir', 'Tétouan',
                        'Témara', 'Safi', 'Mohammédia', 'El Jadida', 'Béni Mellal', 'Taza', 'Khémisset', 'Taourirt'
                    ];
                ?>
                <select class="form-control {{ $errors->has('ville') ? ' is-invalid' : '' }}" id="ville" name="ville" value="{{old('ville')}}">
                    <option selected disabled>{{--vide--}}</option>
                    @foreach ($villes as $vl)
                        <option value="{{$vl}}">{{$vl}}</option>
                    @endforeach
                </select>
                    @if ($errors->has('ville'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('ville') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group col-12"><label>Commentaire</label><textarea class="form-control" type="text" rows="3" name="commentaire" maxlength="900" placeholder="Commentaire ..">{{old('commentaire')}}</textarea></div>




            {{-- <div class="form-group col-12 col-md-6 col-sm-6 col-lg-3">
                <label for="region">Région</label>
                <select class="form-control {{ $errors->has('region') ? ' is-invalid' : '' }}" name="region" value="{{old('region')}}">
                    <option selected disabled>-région</option>
                    <option selected value="Oued Ed-Dahab - Lagouira">Oued Ed-Dahab - Lagouira</option>
                    <option selected value="Laâyoune - Boujdour - Sakia El Hamra">Laâyoune - Boujdour - Sakia El Hamra</option>
                    <option selected value="Guelmim - Es-Semara">Guelmim - Es-Semara</option>
                    <option selected value="Souss - Massa - Drâa">Souss - Massa - Drâa</option>
                    <option selected value="Gharb - Chrarda - Béni Hssen">Gharb - Chrarda - Béni Hssen</option>
                    <option selected value="Chaouia - Ouardigha">Chaouia - Ouardigha</option>
                    <option selected value="Marrakech - Tensift - Al Haouz">Marrakech - Tensift - Al Haouz</option>
                    <option selected value="Oriental">Oriental</option>
                    <option selected value="Grand Casablanca">Grand Casablanca</option>
                    <option selected value="Rabat - Salé - Zemmour - Zaër ">Rabat - Salé - Zemmour - Zaër </option>
                    <option selected value="Doukkala - Abda">Doukkala - Abda</option>
                    <option selected value="Tadla - Azilal">Tadla - Azilal</option>
                    <option selected value="Meknès - Tafilalet">Meknès - Tafilalet</option>
                    <option selected value="Fès - Boulemane">Fès - Boulemane</option>
                    <option selected value="Taza - Al Hoceïma - Taounate">Taza - Al Hoceïma - Taounate</option>
                    <option selected value="Tanger - Tétouan">Tanger - Tétouan</option>
                </select>
                    @if ($errors->has('region'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('region') }}</strong>
                        </span>
                    @endif
            </div> --}}



        </div><!--./row-->
    </div><!--./card-body-->



    <div class="card-footer text-center">
        <button class="btn buaj2" type="submit" id="add"><i class="fas fa-plus-circle"></i>&nbsp;Ajouter</button>
        <a class="btn bua2" href="/intervenant"><i class="fas fa-window-close"></i>&nbsp;Annuler</a>
    </div>
</div><!--./card-body-->

</form>
</div>
<!-- ./CARD -->



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
