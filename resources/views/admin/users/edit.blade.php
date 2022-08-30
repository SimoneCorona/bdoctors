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

    <form action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div>
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" required value="{{ old('name') ? old('name') : $user->name }}">
        </div>
        <div>
            <label for="surname">Cognome</label>
            <input type="text" id="surname" name="surname" required value="{{ old('surname') ? old('surname') : $user->surname }}">
        </div>
        <div>
            <label for="phone">Numero di telefono</label>
            <input type="phone" id="phone" name="phone" value="{{ old('phone') ? old('phone') : $user->phone }}">
        </div>
        <div>
            <label for="address">Indirizzo</label>
            <input type="text" id="address" name="address" required value="{{ old('address') ? old('address') : $user->address }}">
        </div>

        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" class="form-control" name="photo" id="photo">
        </div>
        
        <div class="form-group">
            <h3 class="col-sm-2">Specializzazione</h3>
            <div class="col-sm-10">
              <div class="form-check">
                @foreach ($specialties as $specialty)
                <div class="form-check">
                    <input class="form-check-input specialty-checkbox" type="checkbox" name="specialties[]" value="{{$specialty->id}}" id="specialty-{{$specialty->id}}" {{ ($user->specialties->contains($specialty) || in_array($user->id, old('specialties', []))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="specialty-{{ $specialty->id }}">
                        {{ $specialty->specialty_name }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        <div>
            <label for="services">Prestazioni</label>
            <textarea type="text" id="services" name="services" value="{{ old('services') ? old('services') : $user->services }}" rows="5" placeholder="Prestazioni">{{$user->services}}</textarea>
        </div>

        <div>
            <label for="cv">CV</label>
            <textarea type="text" id="cv" name="cv" value="{{ old('cv') ? old('cv') : $user->cv }}" rows="5" placeholder="Inserisci il tuo CV">{{$user->cv}}</textarea>
        </div>
        <button type="submit">Salva</button>
    </form>
    <form action="{{ route('admin.users.destroy')}}" method="POST">
        @csrf
        @method("DELETE")
        <button class="btn btn-danger">Elimina</button>
    </form>

<!-- <script>
    function checkCheckBoxes() {
        let checkboxArray = document.querySelectorAll('.specialty-checkbox');
        let checkedSpecialties = [];
        checkboxArray.forEach(element => {
        if (element.checked) {
            checkedSpecialties.push(element);
        }
    });
    console.log(checkedSpecialties);
    return checkedSpecialties.length > 0 ? true : false;
    }


  // Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
        let checkboxArray = document.querySelectorAll('.specialty-checkbox');
        let checkedSpecialties = [];
        checkboxArray.forEach(element => {
        if (element.checked) {
            checkedSpecialties.push(element);
        }
    });
        let atLeastOneSpecialty = checkedSpecialties > 0;

      if (!form.checkValidity() || !atLeastOneSpecialty) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script> -->
@endsection