@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center auth_content">
  <div class="row">

      <div class="card">
        <div>
          <h4 style="text-align: center; font-weight: bold !important;">{{ __("S'enregistrer") }}</h4>
        </div>

        <div class="card-body">
          <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
              <label for="name" class="col-2 col-form-label text-md-right text-secondary"><i class="fas fa-user fa-2x"></i></label>

              <div class="col">
                <input id="name" placeholder="Nom" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="firstname" class="col-2 col-form-label text-md-right text-secondary"><i class="fas fa-user fa-2x"></i></label>

              <div class="col">
                <input id="firstname" placeholder="Prenom" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required autofocus>

                @if ($errors->has('firstname'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('firstname') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="type_user" class="col-2 col-form-label text-md-right text-secondary"><i class="fas fa-users-cog fa-2x"></i></label>

              <div class="col">
                <select id="type_user" placeholder="Prenom" type="text" class="form-control{{ $errors->has('type_user') ? ' is-invalid' : '' }}" name="type_user" value="{{ old('type_user') }}" required autofocus>
                  <option value="admin">Administrateur</option>
                  <option value="utilisateur">Utilisateur</option>
                  <option value="comptable">Comptable</option>
                  <option value="cc">Utilisateur Creation Clients</option>
                </select>

                @if ($errors->has('type_user'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('type_user') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-2 col-form-label text-md-right text-secondary"><i class="fas fa-envelope fa-2x"></i></label>

              <div class="col">
                <input id="email" placeholder="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-2 col-form-label text-md-right text-secondary"><i class="fas fa-lock fa-2x"></i></label>

              <div class="col">
                <input id="password" placeholder="Mot de passe" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="password-confirm" class="col-2 col-form-label text-md-right text-secondary"><i class="fas fa-lock fa-2x"></i></label>

              <div class="col">
                <input id="password-confirm" placeholder="Confirmer le mot de passe" type="password" class="form-control" name="password_confirmation" required>
              </div>
            </div>


            <div class="form-group row ">

              <label for="photo" class="col-2 col-form-label text-md-right text-secondary"><i class="fas fa-image fa-2x"></i></label>
              <div class="col">
                <input type="file" class="form-control auth_btn" name="photo" >

              </div>
            </div>

            {{-- <div class="form-group row">
              <label for="type_user" class="col-2 col-form-label text-md-right text-secondary"><i class="fas fa-user fa-2x"></i></label>

              <div class="col">
                <input id="type_user" type="hidden" class="form-control {{ $errors->has('type_user') ? ' is-invalid' : '' }}" name="type_user" value="user" required>

                @if ($errors->has('type_user'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('type_user') }}</strong>
                  </span>
                @endif
              </div>
            </div> --}}

            {{-- <div class="form-group row">

              <label for="" class="col-2 col-form-label text-md-right text-secondary"><i class="fas fa-shield-alt fa-2x"></i></label>
              <div class="col">
               {!! NoCaptcha::display() !!}
              </div>
            </div> --}}

            <div class="form-group row mb-0 justify-content-center">
              <div class="col offset-md-4">
                <button type="submit" class="btn auth_btn mt-4">
                  {{ __("S'enregistrer") }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

  </div>
</div>
{!! NoCaptcha::renderJs() !!}
@endsection
