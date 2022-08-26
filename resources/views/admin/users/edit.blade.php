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

    <form action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="POST">
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



        
        <div class="form-group">
            <h3 class="col-sm-2">Tag</h3>
            <div class="col-sm-10">
              <div class="form-check">
                @foreach ($specialties as $specialty)
                    <input type="checkbox" name="specialties[]" value="{{$specialty->id}}" id="{{$specialty->id}}" {{ $user->specialties->contains($specialty) ? 'checked' : '' }}>
                    <label for="{{$specialty->id}}">
                        {{ $specialty->specialty_name }}
                    </label>
                @endforeach
            </div>
        </div>
        <div>
            <label for="specialty_id">Specializzazione</label>
            <select name="specialty_id" name="specialty_id">
                <option value="">Nessuna</option>
                @foreach ($user->specialties as $specialty)
                    <option value="{{ $specialty->id }}" {{ $user->specialty &&  old('specialty_id', $user->specialty->id) == $specialty->id ? 'selected' : ''}}>{{ $specialty->name }}</option>
                @endforeach
            </select>
        </div>

        
        <div>
            <label for="cv">CV</label>
            <textarea type="text" id="cv" name="cv" value="{{ old('cv') ? old('cv') : $user->cv }}" rows="5" placeholder="Inserisci il tuo cv">{{$user->cv}}</textarea>
        </div>
        <button type="submit">Modifica</button>
    </form>

@endsection