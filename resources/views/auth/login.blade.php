<x-guest-layout>
    <div class="auth-card">
        <div class="auth-header">
            <h2>Connexion</h2>
        </div>

        <div class="auth-body">
            <!-- Session Status -->
            <div class="mb-4 text-sm text-gray-600">
                {{ session('status') }}
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-3 form-check">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    <label class="form-check-label" for="remember_me">Se souvenir de moi</label>
                </div>

                <div class="mb-0 d-flex justify-content-between align-items-center">
                    @if (Route::has('password.request'))
                    <a class="text-decoration-none" href="{{ route('password.request') }}">
                        Mot de passe oublié?
                    </a>
                    @endif

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt me-2"></i> Se connecter
                    </button>
                </div>
                
                <div class="mt-3 text-center">
                    <p>Pas encore de compte? <a href="{{ route('register') }}" class="text-decoration-none">S'inscrire</a></p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
