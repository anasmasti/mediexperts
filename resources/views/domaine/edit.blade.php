@extends('layouts.admin')

@section('content')


@section('content-wrapper')
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Modifier</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/domain">Domaine</a></li>
            <li class="breadcrumb-item active d-inline-block text-truncate">{{$domain->nom_domain}}</li>
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
        <h3 class="card-title">Modifier domaine {{$domain->nom_domain}}</h3>
    </div>
    <!-- /.card-header -->
    <form role="form" action="/edit-domain/{{$domain->id_domain}}" method="POST">
    <div class="card-body">
        <div class="row">
            {{ csrf_field() }}

            {{-- <div class="form-group col-12 col-md-6 col-sm-6 col-lg-3"><label>ID Domaine</label><input class="form-control {{ $errors->has('id_domain') ? ' is-invalid' : '' }}" value="{{$domain->id_domain}}" type="text" name="id_domain" min="0" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="auto incrémenté.." disabled >
                @if ($errors->has('id_domain'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('id_domain') }}</strong>
                    </span>
                @endif
            </div> --}}

            <div class="form-group col-12 col-md-6 col-sm-6 col-lg-12"><label>Nom domaine</label><input class="form-control {{ $errors->has('nom_domain') ? ' is-invalid' : '' }}" value="{{$domain->nom_domain}}" type="text" name="nom_domain" maxlength="300" placeholder="nom domaine" >
                @if ($errors->has('nom_domain'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nom_domain') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-12 col-md-6 col-sm-6 col-lg-4"><label>Coût domaine</label><input class="form-control {{ $errors->has('cout') ? ' is-invalid' : '' }}" value="{{$domain->cout}}" type="text" name="cout" id="cout" min="0" maxlength="5" onkeypress="return isNumberKey(event)" placeholder="... DH.">
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
                <select class="form-control {{ $errors->has('region') ? ' is-invalid' : '' }}" id="region" name="region">
                    <option selected disabled>{{--vide--}}</option>
                    @foreach ($regions as $reg)
                        @if (mb_strtolower($domain->region) == $reg)
                            <option selected value="{{$reg}}">{{$reg}}</option>
                        @else
                            <option value="{{$reg}}">{{$reg}}</option>
                        @endif
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
                <select class="form-control {{ $errors->has('ville') ? ' is-invalid' : '' }}" id="ville" name="ville" value="{{$domain->ville}}">
                    <option selected disabled>{{--vide--}}</option>
                    @foreach ($villes as $vl)
                        @if ($domain->ville == $vl)
                            <option selected value="{{$vl}}">{{$vl}}</option>
                        @else
                            <option value="{{$vl}}">{{$vl}}</option>
                        @endif
                    @endforeach
                </select>
                    @if ($errors->has('ville'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('ville') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group col-12"><label>Commentaire</label><textarea class="form-control" type="text" rows="3" name="commentaire" maxlength="900" placeholder="Commentaire ..">{{$domain->commentaire}}</textarea></div>

        </div><!--./row-->
    </div>



    <div class="card-footer text-center">
        <button class="btn buaj2" type="submit" id="edit"><i class="fas fa-edit"></i>&nbsp;Modifier</button>
        <a class="btn bua2" href="/domain"><i class="fas fa-window-close"></i>&nbsp;Annuler</a>
    </div>
</div><!--./card-body-->

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
