<form method="POST" action="/ajouter">
    @csrf
    <div class="row mb-3" style="margin-top: 3%;">
        <label for="matricule" class="col-md-4 col-form-label text-md-end">{{ __('Matricule') }}</label>
        <div class="col-md-6">
            <input id="matricule" type="text" class="form-control @error('matricule') is-invalid @enderror" name="matricule" required autocomplete>
            @error('matricule')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>
        <div class="col-md-6">
            <input id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" required autocomplete>
            @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
        <div class="col-md-6">
            <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Envoyer') }}
            </button>
        </div>
    </div>
</form>
@include('layouts.app')
