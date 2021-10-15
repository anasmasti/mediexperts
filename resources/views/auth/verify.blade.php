@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:280px;" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-light p-3" style="background-color:#e2b424;">
                <div class="card-header">
                    <h4 style="font-weight: bold;">{{ __("Demande en train de se traiter..") }}</h4>
                </div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __("Vous devez attendre la validation du l'administrateur.") }}
                        </div>
                    @endif
                
                    {{ __("Si vous voulez renvoyer la demande") }}, <a href="{{ route('verification.resend') }}" class="text-dark" >{{ __('cliquez ici pour renvoyer le lien') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
