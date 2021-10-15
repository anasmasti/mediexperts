@extends('layouts.admin')

@section('content')

@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Clients</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/client">Client</a></li>
            <li class="breadcrumb-item active">Liste</li>
        </ol>
    </div><!-- /.col -->
@endsection

{{-- jquery scripts --}}
<script src={{ asset('js/jquery.js') }}></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

{{-- <script>
$(document).on('ready' , function() {
      setTimeout(() => {
      $('tbody').each(function(){
      var list = $(this).children('tr');
      $(this).html(list.get().reverse())
  });
    }, 0);
})
</script> --}}
{{-- jquery scripts --}}

<!-- CARD -->
<div class="card card-dark">
    <!-- card-header -->
    <div class="card-header">
        <a class="btn bu-icon bu-sm btn-sm" href="/add-cl"><i class="fa fa-plus"></i></a>
        <a class="btn bu-icon bu-sm btn-sm" href="/import-client"><i class="fa fa-upload"></i></a>
        <div class="d-flex h-100"><h3 class="card-title">Clients</h3>
        <div class="container h-100">
            <form action="/searchclient" method="GET">
              <div class="searchbar bu-sm">
                <input class="search_input" type="text" name="searchclient" placeholder="par N° RC / raison social">
                <button type="submit" class="search_icon btn"><i class="fas fa-search"></i></button>
              </div>
            </form>
        </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-striped p-0">
        <table class="table table-md" id="table" >
            <thead class="thead" onload="reverseTable()">
                {{-- HEAD OF TABLE --}}
                <tr>
                    <th>N° RC entreprise</th>
                    <th>Raison social</th>
                    <th>Forme juridique</th>
                    <th>Commentaire</th>
                    <th class="action">Action</th>
                </tr>
                {{-- ./HEAD OF TABLE --}}
            </thead>

            <tbody>
                {{-- DISPLAY DATA --}}
                @foreach ($client as $cl)
                <tr>
                    <td>{{ $cl->nrc_entrp }}</td>
                    <td>{{ $cl->raisoci }}</td>
                    <td>{{ $cl->formjury }}</td>
                    <td class="th-last d-inline-block text-truncate">{{ $cl->commentaire }}</td>

                    <?php $hasAction = false; $hasDf = false; $hasDrb = false; $hasPf = false; ?>
                    @foreach($action as $act)
                        @if($cl->nrc_entrp==$act->nrc_e)
                            <?php $hasAction= true; ?>
                        @endif
                    @endforeach
                    @foreach($df as $d)
                        @if($cl->nrc_entrp==$d->nrc_e)
                            <?php $hasDf= true; ?>
                        @endif
                    @endforeach
                    @foreach($drb as $dr)
                        @if($cl->nrc_entrp==$dr->nrc_e)
                            <?php $hasDrb = true; ?>
                        @endif
                    @endforeach
                    @foreach($plan as $pf)
                        @if($cl->nrc_entrp==$pf->nrc_e)
                            <?php $hasPf = true; ?>
                        @endif
                    @endforeach

                    <td class="action py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="/detail-cl/{{ $cl->nrc_entrp }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                        <a href="/edit-cl/{{ $cl->nrc_entrp }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        @if (Auth::user()->type_user == "user" || Auth::user()->type_user == "admin")
                        <a href="#" class="btn btn-danger" onclick="confirmDelete({{$cl->nrc_entrp}}, 'cl/')"><i class="fas fa-trash-alt"></i></a>
                        @endif
                        <a href="/print-f1/{{ $cl->nrc_entrp }}" class="btn btn-info"><i class="fa fa-print"></i></a>
                      </div>
                    </td>

                    {{-- <td class="action">
                        <a class="btn btn-sm bu-icon" href="/detail-cl/{{ $cl->nrc_entrp }}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-sm bu-icon" href="/edit-cl/{{ $cl->nrc_entrp }}"><i class="fa fa-edit"></i></a>
                        @if (Auth::user()->type_user == "user" || Auth::user()->type_user == "admin")
                            @if ($hasAction==true | $hasDf==true | $hasDrb==true | $hasPf==true)
                                <a class="btn btn-sm bu-icon" onclick="IsChild()"><i class="fa fa-trash-alt"></i></a>
                            @elseif ($hasAction==false && $hasDf==false && $hasDrb==false && $hasPf==false)
                                <a class="btn btn-sm bu-icon" onclick="confirmDelete({{$cl->nrc_entrp}}, 'cl/')"><i class="fa fa-trash-alt"></i></a>
                            @endif
                        @endif
                        <a class="btn btn-sm bu-icon info" href="/print-f1/{{ $cl->nrc_entrp }}"><i class="fa fa-print"></i></a>
                    </td> --}}

                </tr>
                @endforeach
                {{-- ./DISPLAY DATA --}}
            </tbody>
        </table>
    </div><!--/.card-body-->

    <div class="card-footer">
    </div>
</div>
<!--/.CARD-->



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



