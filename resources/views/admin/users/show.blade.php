@extends('layouts.dashboard')

@section('content')

    SHOW UTENTE
    <ul>
        <li>{{ $user->name}}</li>
        <li>{{ $user->surname}}</li>
        <li>
        @foreach($user->specialties as $specialty)
        {{ $specialty->specialty_name }}{{ $loop->last ? '' : ', ' }}
        @endforeach
        </li>
    </ul>
@endsection