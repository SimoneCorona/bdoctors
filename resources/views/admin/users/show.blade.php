@extends('layouts.dashboard')

@section('content')

SHOW UTENTE
<div id="showUtente">
    <ul>
        @if($user->photo)
        <li>
            <img src="{{ asset('storage/' . $user->photo) }}  alt="{{ $user->name }}">
        </li>
        @else
        <li>
            <img src="{{ asset('img/img-not-found.png') }}" alt="img-not-found">
        </li>
        @endif
        <li>{{ $user->name}}</li>
        <li>{{ $user->surname}}</li>
        <li>
        @foreach($user->specialties as $specialty)
        {{ $specialty->specialty_name }}{{ $loop->last ? '' : ', ' }}
        @endforeach
        </li>
    </ul>
</div>
@endsection


<style>

#showUtente {
    background-color: red;
}

</style>