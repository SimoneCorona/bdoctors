@extends('layouts.dashboard')

@section('content')

    EDIT PROFILO UTENTE
    <h1>Modifica Profilo</h1>

    @if ($errors->any())
    <div>
        <ul>
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
            <input type="text" id="name" name="name" value="{{ old('name') ? old('name') : $user->name }}">
        </div>
        <div>
            <label for="surname">Cognome</label>
            <input type="text" id="surname" name="surname" value="{{ old('surname') ? old('surname') : $user->surname }}">
        </div>
        <div>
            <label for="phone">Numero di telefono</label>
            <input type="phone" id="phone" name="phone" value="{{ old('phone') ? old('phone') : $user->phone }}">
        </div>
        <div>
            <label for="address">Indirizzo</label>
            <input type="text" id="address" name="address" value="{{ old('address') ? old('address') : $user->address }}">
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
                    <input class="form-check-input" type="checkbox" name="specialties[]" value="{{$specialty->id}}" id="specialty-{{$specialty->id}}" {{ ($user->specialties->contains($specialty) || in_array($user->id, old('specialties', []))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="specialty-{{ $specialty->id }}">
                        {{ $specialty->specialty_name }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        
        <div>
            <label for="cv">CV</label>
            <textarea type="text" id="cv" name="cv" value="{{ old('cv') ? old('cv') : $user->cv }}" rows="5" placeholder="Inserisci il tuo cv">{{$user->cv}}</textarea>
        </div>
        <button type="submit">Modifica</button>
    </form>
    <form action="{{ route('admin.users.destroy')}}" method="POST">
        @csrf
        @method("DELETE")
        <button class="btn btn-danger">Elimina</button>
    </form>
@endsection