@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Benvenuto nuovo utente! Registrati qui compilando i campi, oppure se sei già registrato, accedi.') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row mb-4">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome *') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Cognome *') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="specialty" class="col-md-4 col-form-label text-md-right">{{ __('Specializzazione *') }}</label>

                            <div class="col-md-6">                                
                                @php ($specialties = App\Specialty::specialties())

                                <select name="specialty" id="specialty" class="form-control @error('specialty') is-invalid @enderror" required>
                                    <option value="" selected></option>
                                    @foreach ($specialties as $specialty) 
                                        <option value="{{ $specialty->id }}" {{ old('specialty') == $specialty->id ? 'selected' : '' }}>{{ $specialty->specialty_name }}</option>
                                    @endforeach
                                </select>
                                @error('specialty')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo *') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail *') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password *') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password *') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <div id="password-alert" class="d-none">CIAO SONO L'ALERT DELLE PASSWORD</div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="btn" type="submit" class="btn btn-primary text-light">
                                    {{ __('Registrati') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script >

let pwdInput = document.getElementById('password');
let confirmPwdInput = document.getElementById('password-confirm');
let pwdAlert = document.getElementById('password-alert')
pwdInput.addEventListener('keyup', checkpwd);
confirmPwdInput.addEventListener('keyup', checkpwd);
let btn = document.getElementById('btn');

 
function checkpwd(pwd1, pwd2) {
    let pass1 = document.getElementById('password').value;
    let pass2 = document.getElementById('password-confirm').value;
    if(pass1.length < 8){
        pwdAlert.classList.remove("d-none");
        pwdAlert.classList.remove("text-success");
        pwdAlert.classList.add("text-danger");
        pwdAlert.textContent = 'Inserire una password di minimo 8 caratteri';
    }
    else if (pass1 !== pass2) {
        pwdAlert.classList.remove("d-none");
        pwdAlert.classList.remove("text-success");
        pwdAlert.classList.add("text-danger");
        pwdAlert.textContent = 'Le password devono corrispondere';

    }
    else {
        pwdAlert.classList.remove("text-danger");
        pwdAlert.classList.add("text-success");
        pwdAlert.textContent = 'Password valida';
    }

     
    if (pwdAlert.textContent === 'Password valida') {
        btn.disabled = false;
    } else {
        btn.disabled = true;
    }
    
}
</script>
@endsection
