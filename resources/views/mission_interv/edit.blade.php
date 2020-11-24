@extends('layouts.admin')

@section('content')

        @foreach($df as $d)
        @if ($d->n_df==$misinv->n_df)
            <?php $ndf = $d->n_df ?>
        @endif
        @endforeach

        @foreach($interv as $inv)
        @if ($inv->id_interv==$misinv->id_interv)
            <?php $id = $inv->id_interv ?>
            <?php $nom = $inv->nom ?>
        @endif
        @endforeach

@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Mission intervenant</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/mis-inv">Mission intervenant</a></li>
            <li class="breadcrumb-item active">N° {{ $misinv->id }}</li>
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
        <h3 class="card-title">Modifier mission N° {{$misinv->id}}</h3>
    </div>
    <!-- /.card-header -->
    <form role="form" action="/edit-mis-inv/{{ $misinv->id }}/{{$id}}/{{$ndf}}" method="POST">
    <div class="card-body">
        <div class="row">
            {{ csrf_field() }}

            <div class="form-group col-3"><label for="id">ID</label><input class="form-control {{ $errors->has('id') ? ' is-invalid' : 'id' }}" value="{{$misinv->id}}" type="number" name="id" min="0" onkeypress="return isNumberKey(event)" placeholder="ID">
                @if ($errors->has('id'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('id') }}
                    </span>
                @endif
            </div>

            <div class="form-group col-3">
                <label for="id_interv">Intervenant</label>
                <select class="form-control {{ $errors->has('id_interv') ? ' is-invalid' : 'id_interv' }}" name="id_interv" value="{{old('id_interv')}}">
                    <option selected disabled>-intervenant</option>
                    @foreach ($interv as $inv)
                        @if ($inv->id_interv == $misinv->id_interv)
                            <option value="{{$inv->id_interv}}" selected>{{$inv->nom}} | {{$inv->id_interv}}</option>
                        @else
                            <option value="{{$inv->id_interv}}">{{$inv->nom}} | {{$inv->id_interv}}</option>
                        @endif
                    @endforeach
                </select>

                @if ($errors->has('id_interv'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('id_interv') }}
                </span>
                @endif
            </div>

            <div class="form-group col-3">
                <label for="n_df">Demande financement N°&nbsp;<i class="fas fa-tag"></i></label>
                <select class="form-control {{ $errors->has('n_df') ? ' is-invalid' : 'n_df' }}" name="n_df">
                    @foreach ($df as $d)
                        @if($misinv->n_df==$d->n_df)
                            <option value="{{$misinv->n_df}}" selected>{{$misinv->n_df}}</option>
                        @else
                            <option value="{{$d->n_df}}">{{$d->n_df}}</option>
                        @endif
                    @endforeach
                </select>

                    @if ($errors->has('n_df'))
                        <span class="invalid-feedback" role="alert">
                        {{ $errors->first('n_df') }}
                        </span>
                    @endif
            </div>

        </div><!--./row-->
    </div><!--./card-body-->


    <div class="card-footer text-center">
        <button class="btn buaj2" type="submit" id="edit"><i class="fa fa-edit"></i>&nbsp;Modifier</button>
        <a class="btn bua2" href="/mis-inv"><i class="fas fa-window-close"></i>&nbsp;Annuler</a>
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

