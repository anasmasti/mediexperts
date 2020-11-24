@extends('layouts.admin')

@section('content')

        @foreach($client as $cl)
            @if($cl->nrc_entrp==$action->nrc_e)
                <?php $nrc = $cl->nrc_entrp ?>
                <?php $name = $cl->raisoci ?>
            @endif
        @endforeach

@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Actionnaire</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/actionnaire">Actionnaire</a></li>
            <li class="breadcrumb-item active">Modifier {{ $action->nom }} {{ $action->prenom }}</li>
        </ol>
    </div><!-- /.col -->
@endsection


{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('sweet::alert') --}}

<!-- CARD -->
<div class="card card-dark">
        <!-- card-header -->
        <div class="card-header">
            <h3 class="card-title">Modifier {{ $action->nom }} {{ $action->prenom }}</h3>
        </div>
        <!-- /.card-header -->
        <form role="form" action="/edit-act/{{ $action->id_act }}/{{$nrc}}" method="POST">
        <div class="card-body">
            <div class="row">
                {{ csrf_field() }}
                {{-- <div class="form-group col-3"><label>ID actionnaire</label><input class="form-control  {{ $errors->has('id_act') ? ' is-invalid' : 'id_act' }}" type="text" value="{{ $action->id_act }}" name="id_act" min="0" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="ID">

                    @if ($errors->has('id_act'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('id_act') }}
                    </span>
                    @endif
                </div> --}}

                <div class="form-group col-6">
                    <label for="nrc_e">Entreprise</label>
                    <select class="form-control  {{ $errors->has('nrc_e') ? ' is-invalid' : 'nrc_e' }}" name="nrc_e">
                        @foreach ($client as $cl)
                            @if ($cl->nrc_entrp==$action->nrc_e)
                            <option value="{{$cl->nrc_entrp}}" selected>{{$cl->raisoci}} ({{$cl->nrc_entrp}})</option>
                            @else
                            <option value="{{$cl->nrc_entrp}}">{{$cl->raisoci}}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('nrc_e'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('nrc_e') }}
                    </span>
                    @endif
                </div>

                <div class="form-group col-3"><label>Nom</label><input class="form-control  {{ $errors->has('nom') ? ' is-invalid' : 'nom' }}" type="text" value="{{ $action->nom  }}" name="nom" maxlength="30" placeholder="nom">

                @if ($errors->has('nom'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('nom') }}
                    </span>
                    @endif
                </div>
                <div class="form-group col-3"><label>Prénom</label><input class="form-control  {{ $errors->has('prenom') ? ' is-invalid' : 'prenom' }}" type="text" value="{{ $action->prenom  }}" name="prenom" maxlength="30" placeholder="prénom">

                @if ($errors->has('prenom'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('prenom') }}
                    </span>
                    @endif
                </div>
                <div class="form-group col-3"><label>Nb. actions</label><input class="form-control  {{ $errors->has('nb_acts') ? ' is-invalid' : 'nb_acts' }}" type="text" value="{{ $action->nb_acts  }}" name="nb_acts" min="0" maxlength="4" onkeypress="return isNumberKey(event)" placeholder="nombre">

                @if ($errors->has('nb_acts'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('nb_acts') }}
                    </span>
                    @endif
                </div>

                <div class="form-group col-3">
                <label for="percent">Pourcentage</label>
                    <div class="input-group">
                        <input class="form-control  {{ $errors->has('percent') ? ' is-invalid' : 'percent' }}" type="text" value="{{ $action->percent  }}" name="percent" min="0" maxlength="3" onkeypress="return isNumberKey(event)" placeholder="..%">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-percent"></i></span>
                            </div>
                    </div>

                    @if ($errors->has('percent'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('percent') }}
                    </span>
                    @endif

                </div>

                {{-- <div class="form-group col-3"><label>TAG</label><input class="form-control  {{ $errors->has('tag1') ? ' is-invalid' : 'tag1' }}" type="text" value="{{ $action->tag1  }}" name="tag1" min="0" maxlength="2" onkeypress="return isNumberKey(event)" placeholder="Tag 1">

                @if ($errors->has('tag1'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('tag1') }}
                    </span>
                    @endif
                </div> --}}

                <div class="form-group col-12"><label>Commentaire</label><textarea class="form-control" type="text" rows="4" name="commentaire" maxlength="900" placeholder="commentaire ..">{{ $action->commentaire }}</textarea></div>
            </div><!--./row-->
        </div><!--./card-body-->

        <div class="card-footer text-center">
            <button class="btn buaj2" type="submit" id="edit"><i class="fas fa-pen-square"></i>&nbsp;Modifier</button>
            <a class="btn bua2" href="/actionnaire"><i class="fas fa-window-close"></i>&nbsp;Annuler</a>
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
