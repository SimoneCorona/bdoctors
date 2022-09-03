<x-header  /> 
@extends('layouts.dashboard')


@section('content')

    
    EDIT PROFILO UTENTE
    <h1>Modifica Profilo</h1>

    

    @if ($errors->any())
        <div>
            <ul class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update') }}" method="POST" id="user-edit-form" novalidate
        enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group" id="name-formgroup">
            <label for="name">Nome *</label>
            <input class="form-control" type="text" id="name" name="name" required
                value="{{ old('name') ? old('name') : $user->name }}">
            <div class="invalid-feedback">
                Please choose a name.
            </div>
        </div>
        <div class="form-group" id="surname-formgroup">
            <label for="surname">Cognome *</label>
            <input class="form-control" type="text" id="surname" name="surname" required
                value="{{ old('surname') ? old('surname') : $user->surname }}">
            <div class="invalid-feedback">
                Please choose a surname.
            </div>
        </div>
        <div class="form-group mb-2">
            <label for="phone_number">Numero di telefono</label>
            <input class="form-control" type="phone" id="phone_number" name="phone_number"
                value="{{ old('phone_number') ? old('phone_number') : $user->phone_number }}">
        </div>
        <div class="form-group mb-2" id="address-formgroup">
            <label for="address">Indirizzo *</label>
            <input class="form-control" type="text" id="address" name="address" required
                value="{{ old('address') ? old('address') : $user->address }}">
            <div class="invalid-feedback">
                Please insert an address.
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="photo">Foto</label>
            <input class="form-control" type="file" name="photo" id="photo">
        </div>

        <div class="form-group mb-2" id="specialties-formgroup">
            <h3>Specializzazione *</h3>
            <div class="invalid-feedback">
                Please check at least one specialty.
            </div>
            <div class="form-check mb-2 container-fluid overflow-auto border border-gray-400 rounded" id="specialties" style="height:10rem;">
                <div class="row row-cols-2">
                    @foreach ($specialties as $specialty)
                        <div class="form-check col">
                            <input class="form-check-input specialty-checkbox ml-4" type="checkbox" name="specialties[]"
                                value="{{ $specialty->id }}" id="specialty-{{ $specialty->id }}"
                                {{ $user->specialties->contains($specialty) || in_array($user->id, old('specialties', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="specialty-{{ $specialty->id }}">
                                {{ $specialty->specialty_name }}
                            </label>
                        </div>
                    @endforeach
                </div> 
            </div>

            <div class="form-group mb-2">
                <label for="services">Prestazioni</label>
                <textarea class="form-control" type="text" id="services" name="services"
                    value="{{ old('services') ? old('services') : $user->services }}" rows="5" placeholder="Prestazioni">{{ $user->services }}</textarea>
            </div>

            <div class="form-group mb-2">
                <label for="cv">CV</label>
                <textarea class="form-control" type="text" id="cv" name="cv"
                    value="{{ old('cv') ? old('cv') : $user->cv }}" rows="5" placeholder="Inserisci il tuo CV">{{ $user->cv }}</textarea>
            </div>
            
    </form>
    <div class="btns d-flex mt-4 justify-content-end">
        <button class="btn btn-primary me-3 text-light" type="submit">Salva</button>
        <form class="mb-0" action="{{ route('admin.users.destroy') }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger text-light">Elimina</button>
        </form>
    </div>

    <script>
        let form = document.getElementById('user-edit-form');
        let name = document.getElementById('name-formgroup');
        let surname = document.getElementById('surname-formgroup');
        let address = document.getElementById('address-formgroup');
        let specialties = document.getElementById('specialties-formgroup');

        function showError(input) {
            invalidMsg = input.querySelector('.invalid-feedback');
            invalidMsg.classList.add('d-block');
            input.scrollIntoView();
        }

        function removeError(input) {
            invalidMsg = input.querySelector('.invalid-feedback');
            invalidMsg.classList.remove('d-block');
        }

        function checkEmptyInputInFormGroup(formGroup) {
            innerInput = formGroup.querySelector('input');
            return innerInput.value === '';
        }

        function checkboxValidator(formGroup) {
            let checkboxArray = formGroup.querySelectorAll('.specialty-checkbox');
            let checkedSpecialties = [];
            checkboxArray.forEach(element => {
                if (element.checked) {
                    checkedSpecialties.push(element);
                }
            });
            // console.log(checkedSpecialties);
            let atLeastOneSpecialty = checkedSpecialties.length > 0;
            return atLeastOneSpecialty;
        }

        form.addEventListener("submit", function(e) {
            e
                .preventDefault(); //when we click on submit, it just submits, but we don't want that, we want to hold for a while
            if (checkEmptyInputInFormGroup(name)) {
                showError(name);
            } else {
                removeError(name);
            }

            if (checkEmptyInputInFormGroup(surname)) {
                showError(surname);
            } else {
                removeError(surname);
            }
            if (checkEmptyInputInFormGroup(address)) {
                showError(address);
            } else {
                removeError(address);
            }
            if (!checkboxValidator(specialties)) {
                showError(specialties);
            } else {
                removeError(specialties);
            }

            if (!checkEmptyInputInFormGroup(name) &&
                !checkEmptyInputInFormGroup(surname) &&
                !checkEmptyInputInFormGroup(address) &&
                checkboxValidator(specialties)) {
                form.submit();
            }
        });
    </script>
@endsection

<style>
</style>