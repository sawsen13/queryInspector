@extends('layouts.app')
<link rel="stylesheet" href="assets/css/main/app.css" />
    <link rel="stylesheet" href="assets/css/pages/auth.css" />
    <link
      rel="shortcut icon"
      href="assets/images/logo/favicon.svg"
      type="image/x-icon"
    />
    <link
      rel="shortcut icon"
      href="assets/images/logo/favicon.png"
      type="image/png"
    />
    <style>
      #auth-right {
        display: none; /* hide the right column */
      }
      
      .col-7 {
        margin: auto; /* center the left column */
      }
    </style>
<div id="auth">
  <div class="row h-100">
  <div class="col-7 mx-auto">      <div id="auth-left">
        
        <h1 class="auth-title">Se connecter.</h1>
        <p class="auth-subtitle mb-5">Connectez-vous avec vos données que vous avez saisies lors de votre inscription.</p>

        <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="form-group position-relative has-icon-left mb-4">
            <input id="email" type="email" class="form-control form-control-xl @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Adresse Email" required autocomplete="email" autofocus>
            <div class="form-control-icon">
              <i class="bi bi-envelope"></i>
            </div>
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group position-relative has-icon-left mb-4">
            <input id="password" type="password" class="form-control form-control-xl @error('password') is-invalid @enderror" name="password" placeholder="Mot De Passe" required autocomplete="current-password">
            <div class="form-control-icon">
              <i class="bi bi-shield-lock"></i>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-check form-check-lg d-flex align-items-end">
            <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label text-gray-600" for="remember">Rester connecté
</label>
          </div>

          <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
        </form>

        @if (Route::has('password.request'))
          <div class="text-center mt-5 text-lg fs-4">
            <a href="{{ route('password.request') }}" class="text-decoration-none text-gray-600">Mot de passe oublié?
</a>
          </div>
        @endif

        <div class="text-center mt-5 text-lg fs-4">
          <span>Vous n'avez pas de compte ?</span>
          <a href="{{ route('register') }}" class="text-decoration-none">Inscrivez-vous ici
</a>
        </div>
      </div>
    </div>
  </div>
</div>
