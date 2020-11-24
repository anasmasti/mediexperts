@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Utilisateurs</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/users">Utilisateurs</a></li>
            <li class="breadcrumb-item active">Liste</li>
        </ol>
    </div><!-- /.col -->
@endsection

{{-- jquery scripts --}}
<script src={{ asset('js/jquery.js') }}></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
{{-- jquery scripts --}}

<!-- CARD -->
<div class="card card-">
    <!-- card-header -->
    <div class="card-header bg-warning">
        <h3 class="card-title">Utilisateurs</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-striped p-0">
        <table class="table table-md">
            <thead class="thead">
                <tr>
                    {{-- <th>ID</th> --}}
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>E-mail</th>
                    <th class="action">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    {{-- <td>{{ $user->id }}</td> --}}
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->firstname }}</td>
                    <td>{{ $user->email }}</td>

                    <td class="action">
                        {{-- if the admin is connected --}}
                        @if (Auth::user()->type_user == "admin" && $user->type_user=="admin")
                            <span class="badge badge-danger">Administrateur</span>

                        {{-- if the user is connected AND the record is for admin --}}
                        @elseif (Auth::user()->type_user == "user" && $user->type_user=="admin")
                            <span class="badge badge-danger">Administrateur</span>

                        {{-- if the same user is connected --}}
                        @elseif (Auth::user()->id == $user->id && Auth::user()->type_user == "user")
                            <a class="btn btn-sm bu5 sweet-tooltip" id="tooltip" title="Vous êtes l'utilisateur connecté !"><i class="fa fa-user"></i></a>

                        {{-- if the admin is connected AND the record is for the user --}}
                        @elseif (Auth::user()->type_user == "admin" && Auth::user()->id != $user->id)
                            <a class="btn btn-sm bu5" onclick="confirmDelete({{$user->id}}, 'user/')"><i class="fa fa-trash-alt del"></i></a>
                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div><!-- ./card-body -->


    <div class="card-footer">
    </div>
</div><!-- ./CARD -->



{{-- TOASTR NOTIFICATIONS --}}
@if (Session::has('success'))
<script>
    $(document).ready(function() {
        toastr.success("{{ Session::get("success") }}");
    });
</script>
@endif
@if (Session::has('warning'))
<script>
    $(document).ready(function() {
        toastr.success("{{ Session::get("warning") }}");
    });
</script>
@endif
@if (Session::has('info'))
<script>
    $(document).ready(function() {
        toastr.success("{{ Session::get("info") }}");
    });
</script>
@endif
@if (Session::has('error'))
<script>
    $(document).ready(function() {
        toastr.success("{{ Session::get("error") }}");
    });
</script>
@endif
{{-- TOASTR NOTIFICATIONS --}}



@endsection

