@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:180px;" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-" style="background-color:#e6c62b;">
                <div class="card-header">
                    <h4>{{ __('Verifier votre adresse email ') }}</h4>
                </div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
                        </div>
                    @endif

                    {{ __(' Avant de continuer, veuillez vérifier votre courrier électronique pour un lien de vérification.') }}
                    {{ __("Si vous n'avez pas reçu l'email") }}, <a href="{{ route('verification.resend') }}">{{ __('cliquez ici pour renvoyer le lien') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
